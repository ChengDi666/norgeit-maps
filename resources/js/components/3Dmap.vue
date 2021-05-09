<template>
  <!-- <script src="https://webapi.amap.com/loca?key=eeb7e7e703b57e8d106f6f352563bd71&v=1.3.2"></script> -->
  <div class="my-amap-page" :field="field" id="myBigMap">
    <el-amap
        v-if="center.length"
        vid="amapDemo"
        :center="center"
        :zoom="zoom"
        :zooms="[7,18]"
        :amap-manager="amapManager"
        :viewMode="'3D'"
        class="amap-demo"
        :events="events"
    >
<!--  :skyColor="'#000000'"  :mapStyle="'amap://styles/dark'"  -->
    </el-amap>
    <div class="fullScreen" @click="screen">
      <svg t="1617183999617" v-if="fullscreen" class="icon" style="width: 32px;height: 32px;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1718" width="32" height="32"><path d="M749.248 704H864a32 32 0 1 0 0-64H672a32 32 0 0 0-32 32v192a32 32 0 1 0 64 0v-114.752l137.36 137.36a32 32 0 1 0 45.232-45.264L749.248 704zM320 749.248V864a32 32 0 1 0 64 0V672a32 32 0 0 0-32-32H160a32 32 0 1 0 0 64h114.752l-137.36 137.36a32 32 0 1 0 45.264 45.232L320 749.248zM749.248 320H864a32 32 0 1 1 0 64H672a32 32 0 0 1-32-32V160a32 32 0 1 1 64 0v114.752l137.36-137.36a32 32 0 1 1 45.232 45.264L749.248 320zM320 274.752V160a32 32 0 1 1 64 0v192a32 32 0 0 1-32 32H160a32 32 0 1 1 0-64h114.752l-137.36-137.36a32 32 0 1 1 45.264-45.232L320 274.752z" p-id="1719"></path></svg>
      <svg t="1617183175145" v-else class="icon" style="width: 32px;height: 32px;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1429" width="32" height="32"><path d="M237.248 192H352a32 32 0 1 0 0-64H160a32 32 0 0 0-32 32v192a32 32 0 1 0 64 0v-114.752l137.36 137.36a32 32 0 1 0 45.232-45.264L237.248 192zM832 237.248V352a32 32 0 1 0 64 0V160a32 32 0 0 0-32-32H672a32 32 0 1 0 0 64h114.752l-137.36 137.36a32 32 0 1 0 45.264 45.232L832 237.248zM237.248 832H352a32 32 0 1 1 0 64H160a32 32 0 0 1-32-32V672a32 32 0 1 1 64 0v114.752l137.36-137.36a32 32 0 1 1 45.232 45.264L237.248 832zM832 786.752V672a32 32 0 1 1 64 0v192a32 32 0 0 1-32 32H672a32 32 0 1 1 0-64h114.752l-137.36-137.36a32 32 0 1 1 45.264-45.232L832 786.752z" p-id="1430"></path></svg>
    </div>
    <my-charts v-if="cece" :myData="config" :hlDate="hlDate"></my-charts>
  </div>
</template>
<script>
import { AMapManager, lazyAMapApiLoaderInstance } from "vue-amap";
let amapManager = new AMapManager(); // 新建生成地图画布
import myCharts from './myCharts'


export default {
  components: { myCharts },
  data() {
    let self = this;
    return {
      userMessage: [],
      beiyong: {lat: "32.059358",lng: "118.796628"},
      amapManager,
      zoom: 12,
      center: [],
      position: [],
      values: {},
      layers: [],
      trucks: [],   //  所有车辆
      xiaoqu: [],
      MeshesList: [],
      textInfo: null,
      object3Dlayer: null,
      objectMeshId: 0,
      cece: true,
      config: {
        header: ['id', 'fullname'],
        data: [],
        columnWidth: [80],
        align: ['center']
      },

      statusRecord: {
        isshowSelect: true, // 显示选择界面
        types: "xianshi", // 展开菜单的类
        spots: true,  // 显示清运点
        transfers: true,  // 显示转运站
        community: true,  // 显示小区
        devices: true,  // 显示设备
      },
      client: {},
      infoWindows: {},
      fullscreen:false,
      myMap: {},
      hlDate: [],
      events: {
        init(o) {
          // 构造官方卫星、路网图层
          var layer1 = new AMap.TileLayer.Satellite({ opacity: 0.8 });  //  卫星
          var layer2 =  new AMap.TileLayer.RoadNet({ opacity: 0.5 });   //   路网
          var layers = [ layer1, layer2 ]
          // 添加卫星地图
          if(self.statusRecord.satellite) o.add(layers[0]);
          //  添加路网
          if(self.statusRecord.roadNet) o.add(layers[1]);
          self.layers = layers;
        },
        complete(o) {
          self.init_position();
          // console.log('地图加载完成');
          self.init_map();
          // self.init_mqtt();
          // self.init_lodingState(self.statusRecord);
        }
      },
    };
  },
  created() {
    this.userMessage = JSON.parse(localStorage.getItem("requestMarker")) ? JSON.parse(localStorage.getItem("requestMarker")) : [];
    this.values = JSON.parse(localStorage.getItem("GISInitPosition")) ? JSON.parse(localStorage.getItem("GISInitPosition")) : {};
    this.statusRecord = JSON.parse(localStorage.getItem('statusRecord')) ? JSON.parse(localStorage.getItem('statusRecord')) : this.statusRecord;
    // console.log(this.statusRecord)
  },
  watch: {
    fullscreen(val, newval) {
      // console.log(val)
      // console.log(newval)
      this.cece = false
      setTimeout(() => {
        this.cece = true
      }, 100)
    }
  },
  mounted() {
    //监听浏览器状态
    window.onresize = () => {
      if(!this.checkFull()){
        // 退出全屏后要执行的动作
        this.fullscreen = false;
      }
    }
    if(this.$route.params.lat == undefined) {   //  刷新
      if(this.values.lat == undefined) { //  没有缓存
        this.values = this.beiyong;
      }
    } else { //  点击传值
      this.values = this.$route.params;
      console.log(this.values);
      console.log(this.field);
      localStorage.setItem("GISInitPosition", JSON.stringify(this.values));
    }
    // console.log(this.values);
    let lng = this.values.lng, lat = this.values.lat;
    this.center = [lng, lat];
    this.position = [lng, lat];
  },

  methods: {
    add3D(position, myname) {
      // 创建Object3DLayer图层
      this.object3Dlayer = new AMap.Object3DLayer();
      this.myMap.add(this.object3Dlayer);
      let druckMeshes, cityMeshes, hefeiMeshes;
      this.myMap.plugin(["AMap.GltfLoader"], () => {
        // var urlCity = 'https://a.amap.com/jsapi_demos/static/gltf-online/shanghai/scene.gltf';
        // var urlDuck = 'https://hefei.ljfl.ltd/storage/residential_district/scene.gltf';
        var hefei = 'https://chengdi666.github.io/building/scene.gltf';
        // var urlDuck = '/storage/residential_district/scene.gltf';
        // var urlDuck = '/lou/scene.gltf';
        // var paramCity = {
        //   position: new AMap.LngLat(121.444971, 37.511301), // 必须
        //   scale: 3580, // 非必须，默认1
        //   height: 0,  // 非必须，默认0
        //   scene: 0, // 非必须，默认0
        // };

        // var paramDuck = {
        //   position: new AMap.LngLat(121.244971, 37.311301), // 必须
        //   scale: 100, // 非必须，默认1
        //   height: 0,  // 非必须，默认0
        //   scene: 0, // 非必须，默认0
        // };

        // var paramHefei = {
        //   position: new AMap.LngLat(121.344971, 37.411301), // 必须
        //   scale: 1, // 非必须，默认1
        //   height: 0,  // 非必须，默认0
        //   scene: 0, // 非必须，默认0
        // };

        var paramHefei = {
          position: new AMap.LngLat(position.lng, position.lat), // 必须
          scale: 0.5, // 非必须，默认1
          height: 0,  // 非必须，默认0
          scene: 0, // 非必须，默认0
        };

        var gltfObj = new AMap.GltfLoader();

        // gltfObj.load(urlCity, function (gltfCity) {
        //   cityMeshes = gltfCity;
        //   gltfCity.setOption(paramCity);
        //   gltfCity.rotateX(90);
        //   gltfCity.rotateZ(120);
        //   this.object3Dlayer.add(gltfCity);
        // });
        //
        // gltfObj.load(urlDuck, function (gltfDuck) {
        //   druckMeshes = gltfDuck;
        //   gltfDuck.setOption(paramDuck);
        //   gltfDuck.rotateX(90);
        //   gltfDuck.rotateZ(-20);
        //   this.object3Dlayer.add(gltfDuck);
        // });

        // gltfObj.load(hefei, function (gltfDuck) {
        //   druckMeshes = gltfDuck;
        //   gltfDuck.setOption(paramHefei);
        //   gltfDuck.rotateX(90);
        //   gltfDuck.rotateZ(90);
        //   this.object3Dlayer.add(gltfDuck);
        // });
        gltfObj.load(hefei, (gltfDuck) => {
          gltfDuck.mynames = myname;
          // gltfDuck.layerMesh[0].mynames = myname;
          hefeiMeshes = gltfDuck;
          gltfDuck.setOption(paramHefei);
          gltfDuck.rotateX(90);
          gltfDuck.rotateZ(-90);
          this.object3Dlayer.add(gltfDuck);
          console.log(gltfDuck);
          console.log(gltfDuck.layerMesh);
          console.log(gltfDuck['layerMesh']);
          console.log(gltfDuck.gltf);
          console.log(gltfDuck['gltf']);
          console.log(hefeiMeshes);
        });

      });
      // 给gltf模型绑定事件
      // this.myMap.on('click', (ev) => {
      //   var pixel = ev.pixel;
      //   var px = new AMap.Pixel(pixel.x, pixel.y);
      //   var obj = this.myMap.getObject3DByContainerPos(px, [this.object3Dlayer], false) || {};
      //   console.log(obj);
      //   if (obj && obj.object) {
      //     // console.log(pixel);
      //     // console.log(obj);
      //     console.log(hefeiMeshes);
      //     // var meshId = obj.object.id;
      //     // if(hefeiMeshes && hefeiMeshes.layerMesh){
      //     //   for(var i = 0; i < hefeiMeshes.layerMesh.length; i++) {
      //         // if(meshId === hefeiMeshes.layerMesh[i].id){
      //         //   console.log(hefeiMeshes);
      //         //   const position = {
      //         //     lat: hefeiMeshes.layerMesh[i].Sl.lat,
      //         //     lng: hefeiMeshes.layerMesh[i].Sl.lng
      //         //   }
      //         //   console.log(position);
      //         //   this.$toasted.show(myname, { type: 'success' })
      //         //   this.openInfo([position.lng, position.lat], myname);
      //           // openInfoWin(this.myMap, ev.originalEvent, {
      //           //   '位置': ev.rawData.coord
      //           // });
      //         // }
      //       // }
      //     // }
      //
      //       const position = {
      //         lat: obj.object.Sl.lat,
      //         lng: obj.object.Sl.lng
      //       }
      //       // console.log(position);
      //       this.$toasted.show(hefeiMeshes.mynames, { type: 'success' })
      //       this.openInfo([position.lng, position.lat], hefeiMeshes.mynames);
      //
      //   } else {
      //     console.log('空的');
      //     this.openInfo([]);
      //   }
      //
      // });

      // 给gltf模型绑定事件
      // this.myMap.on('click', function (ev) {
      //   var pixel = ev.pixel;
      //   var px = new AMap.Pixel(pixel.x, pixel.y);
      //   var obj = this.myMap.getObject3DByContainerPos(px, [object3Dlayer], false) || {};
      //   if (obj && obj.object) {
      //     var meshId = obj.object.id;
      //     if(druckMeshes && druckMeshes.layerMesh){
      //       for(var i = 0; i < druckMeshes.layerMesh.length; i++) {
      //         if(meshId === druckMeshes.layerMesh[i].id){
      //           return log.info("您点击了小黄鸭模型！");
      //         }
      //       }
      //     }
      //
      //     if(cityMeshes && cityMeshes.layerMesh){
      //       for(var i = 0; i < cityMeshes.layerMesh.length; i++) {
      //         if(meshId === cityMeshes.layerMesh[i].id){
      //           return log.info("您点击了陆家嘴模型！");
      //         }
      //       }
      //     }
      //
      //   }
      //
      // });
    },
    init3Ds() {
      this.object3Dlayer = new AMap.Object3DLayer();
      this.myMap.add(this.object3Dlayer);
      // let druckMeshes, cityMeshes, hefeiMeshes;
      this.myMap.plugin(["AMap.GltfLoader"], () => {
        // let hefei = 'https://chengdi666.github.io/building/scene.gltf';
        var gltfObj = new AMap.GltfLoader();
        this.gltfObj = gltfObj;
      })

    },
    addModole(position, myname) {
      let Meshes;
      let hefei = 'https://chengdi666.github.io/new_building/scene.gltf';
      let paramHefei = {
        position: new AMap.LngLat(position.lng, position.lat), // 必须
        scale: 34, // 非必须，默认1
        height: 0,  // 非必须，默认0
        scene: 0, // 非必须，默认0
      };
      this.gltfObj.load(hefei, (gltfDuck) => {
        gltfDuck.mynames = myname;
        // gltfDuck.layerMesh[0].mynames = myname;
        Meshes = gltfDuck;
        gltfDuck.setOption(paramHefei);
        gltfDuck.rotateX(90);
        gltfDuck.rotateZ(-90);
        this.object3Dlayer.add(gltfDuck);
        gltfDuck.setObjects = {}
        gltfDuck.setObjects.first = this.objectMeshId // 开始 ID
        this.objectMeshId += gltfDuck.layerMesh.length
        gltfDuck.setObjects.last = this.objectMeshId - 1 // 结束 ID
        gltfDuck.setObjects.position = position
        gltfDuck.setObjects.titleHeight = 1200
        this.MeshesList.push(gltfDuck)
        // console.log(gltfDuck);
        // console.log(gltfDuck.layerMesh);
        // console.log(gltfDuck['layerMesh']);
        // console.log(gltfDuck.gltf);
        // console.log(gltfDuck['gltf']);
        // console.log(Meshes);
      });

    },
    addDevice(position, myname) {
      let Meshes;
      let hefei = '/storage/iso-container/scene.gltf';
      let paramHefei = {
        position: new AMap.LngLat(position.lng, position.lat), // 必须
        scale: 0.5, // 非必须，默认1
        height: 0,  // 非必须，默认0
        scene: 0, // 非必须，默认0
      };
      this.gltfObj.load(hefei, (gltfDuck) => {
        gltfDuck.mynames = myname;
        // gltfDuck.layerMesh[0].mynames = myname;
        Meshes = gltfDuck;
        gltfDuck.setOption(paramHefei);
        gltfDuck.rotateX(90);
        gltfDuck.rotateZ(-90);
        this.object3Dlayer.add(gltfDuck);
        gltfDuck.setObjects = {}
        gltfDuck.setObjects.first = this.objectMeshId // 开始 ID
        this.objectMeshId += gltfDuck.layerMesh.length
        gltfDuck.setObjects.last = this.objectMeshId - 1 // 结束 ID
        gltfDuck.setObjects.position = position
        gltfDuck.setObjects.titleHeight = 120
        this.MeshesList.push(gltfDuck)
      });

    },
    dianji() {
      this.myMap.on('click', (ev) => {
        var pixel = ev.pixel;
        var px = new AMap.Pixel(pixel.x, pixel.y);
        var obj = this.myMap.getObject3DByContainerPos(px, [this.object3Dlayer], false) || {};
        console.log(obj);
        console.log(this.MeshesList);
        if (obj && obj.object) {
          // console.log(obj.object.o.meshObj);
          // console.log(pixel);
          const obgId = obj.object.id
          console.log(obgId);
          // console.log(hefeiMeshes);
          this.MeshesList
          for (let i=0;i<this.MeshesList.length;i++) {
            const item = this.MeshesList[i]
            if(item.first < obgId && obgId < item.last) {
              console.log('item', item);
              this.$toasted.show(item.mynames, { type: 'success' })
              this.openInfo(item.setObjects, item.mynames);
              return
            }
          }

          const position = {
            lat: obj.object.Sl.lat,
            lng: obj.object.Sl.lng
          }
          if (obj.object.o.meshObj.length > 1) { // 一个模型多个组成
            const objId = obj.object.id
            const itemLength = obj.object.o.meshObj.length
            // console.log('单位长: ', itemLength);
            // console.log('objId: ', objId);
            const clickKey = Math.floor(objId/itemLength)
            // console.log('点击-下标: ', clickKey);
            const clickItem = this.MeshesList[clickKey]
            console.log('点击-对象: ', clickItem);
            this.$toasted.show(clickItem.mynames, { type: 'success' })
            this.openInfo(clickItem.setObjects, clickItem.mynames);

            // const objId = obj.object.o.meshObj[0].id
            // console.log(obj.object.o.meshObj[0]);
            // console.log('obj: ', objId);
            // for (let i = 0; i < this.MeshesList.length; i++) {
            //   const itemid = this.MeshesList[i].layerMesh[0].id
            //   console.log(this.MeshesList[i].layerMesh[0]);
            //   console.log('item: ', itemid);
            //   if (objId == itemid) {
            //     console.log([position.lng, position.lat]);
            //     this.$toasted.show(this.MeshesList[i].mynames, { type: 'success' })
            //     this.openInfo([position.lng, position.lat], this.MeshesList[i].mynames);
            //   }
            // }
          } else {
            for (let i = 0; i < this.MeshesList.length; i++) {
              const itemid = this.MeshesList[i].layerMesh[0].id
              if (obj.object.id == itemid) {
                console.log([position.lng, position.lat]);
                this.$toasted.show(this.MeshesList[i].mynames, { type: 'success' })
                this.openInfo(this.MeshesList[i].setObjects, this.MeshesList[i].mynames);
              }
            }
          }

          // console.log(position);
          // this.$toasted.show(obj.object.type, { type: 'success' })
          // this.openInfo([position.lng, position.lat], obj.object.type);

        } else {
          this.openInfo([]);
          this.myMap.remove(this.textInfo);
          this.textInfo = null;
        }

      });
    },
    openInfo(data, name) {
      if(this.textInfo) {
        if (!data.length) {
          this.textInfo.hide();
        } else {
          this.textInfo.setPosition(data.position);
          this.textInfo.setText(name)
          this.textInfo.show();
        }
        return
      }
      //构建信息窗体中显示的内容
      this.textInfo = new AMap.Text({
        text: name,
        height: data.titleHeight,
        // height: 1200,
        anchor:'center', // 设置文本标记锚点
        cursor:'pointer',
        map: this.myMap,
        offset: new AMap.Pixel(40,0),
        style:{
          'padding': '.75rem 1.25rem',
          'border-radius': '.25rem',
          'background-color': 'white',
          'border-width': 0,
          'box-shadow': '0 2px 6px 0 rgba(114, 124, 245, .5)',
          'text-align': 'center',
          'font-size': '14px',
          'color': 'blue'
        },
        position: data.position
      });
    },
    checkFull(){
      //判断浏览器是否处于全屏状态 （需要考虑兼容问题）
      //火狐浏览器
      var isFull = document.mozFullScreen||
          document.fullScreen ||
          //谷歌浏览器及Webkit内核浏览器
          document.webkitIsFullScreen ||
          document.webkitRequestFullScreen ||
          document.mozRequestFullScreen ||
          document.msFullscreenEnabled
      if(isFull === undefined) isFull = false;
      return isFull;
    },
    screen(){
      // let element = document.documentElement;//设置后就是我们平时的整个页面全屏效果
      let element = document.getElementById('myBigMap');//设置后就是   id==con_lf_top_div 的容器全屏
      if (this.fullscreen) {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      } else {
        if (element.requestFullscreen) {
          element.requestFullscreen();
        } else if (element.webkitRequestFullScreen) {
          element.webkitRequestFullScreen();
        } else if (element.mozRequestFullScreen) {
          element.mozRequestFullScreen();
        } else if (element.msRequestFullscreen) {
          // IE11
          element.msRequestFullscreen();
        }
      }
      this.fullscreen = !this.fullscreen;
    },
    init_map() {  //  初始化地图
      this.myMap = amapManager.getMap();
      //绑定地图移动与缩放事件
      this.myMap.on('moveend', this.mapZoom);
      this.myMap.setZoom([7,20]);
      // console.log(this.beiyong);
      // console.log(this.userMessage);
      this.mapZoom();
      this.init3Ds();
      // this.add3D();
      this.ceshi();
      this.myMap.setZoomAndCenter(16, this.position);
      this.dianji();
      this.myMap.setCenter(new AMap.LngLat(117.227308,31.82057));
    },
    mapZoom() { // 地图缩放
      const zoom = this.myMap.getZoom();
      console.log('缩放： ', zoom);
      const bounds = this.myMap.getBounds();
      // console.log('东北(右上)角： ', bounds.northeast)
      // console.log('西南(左下)角： ', bounds.southwest)
      // this.getData(`/api/addresses/search?northeast={"lat": ${bounds.northeast.lat}, "lng": ${bounds.northeast.lng}}&southwest={"lat": ${bounds.southwest.lat}, "lng": ${bounds.southwest.lng}}&level=${zoom}`)
      //     .then(res => {
      //       // console.log(res)
      //       this.currentData = res.data;
      //       // zoom >= 17 ? this.detailMarker(res.data) : this.addPolymerize(res.data);
      //     });
    },
    ceshi () {
      this.xiaoqu = [
        // {
        //   fullname: "山东省烟台市莱山区黄海路街道黄海明珠山庄",
        //   id: 5,
        //   position: {
        //     lat: '37.512966',
        //     lng: '121.43834'
        //   }
        // }, {
        //   fullname: "山东省烟台市莱山区黄海路街道鹿鸣北区",
        //   id: 6,
        //   position: {
        //     lat: '37.512166',
        //     lng: '121.43034'
        //   }
        // },
        {
          fullname: "安徽省合肥市蜀山区新城国际1栋",
          id: 5,
          position: {
            lat: '31.815783',
            lng: '117.233417'
          }
        }, {
          fullname: "安徽省合肥市蜀山区新城国际2栋",
          id: 6,
          position: {
            lat: '31.815819',
            lng: '117.234403'
          }
        },
      ]
      let devices = [
        {
          fullname: "CESHI0001",
          id: 1,
          position: {
            lat: '31.820773',
            lng: '117.232629'
          }
        }, {
          fullname: "CESHI0002",
          id: 2,
          position: {
            lat: '31.817779',
            lng: '117.231585'
          }
        },
      ]
      // 117.233417,31.815783
      // 117.234403,31.815819
      axios.get('/api/addresses/5/children')
          .then(response => {
            console.log(response);
            let arr = [];
            for (let j = 0; j < response.data.data.length; j++) {
              const item = response.data.data[j];
              arr.push([item.id, item.fullname])
            }
            this.config.data = arr
            console.log(this.config)
            // const data = response.data;
            // let obj = {}
            // data.resources[0].fields.map(item => {
            //   obj[item.attribute] = item.value
            // })
            // console.log(obj)
            // this.xiaoqu = [obj]
            for (let i = 0;i < this.xiaoqu.length; i++) {
              this.addModole(this.xiaoqu[i].position, this.xiaoqu[i].fullname);
              this.addDevice(devices[i].position, devices[i].fullname);
              // this.add3D(this.xiaoqu[i].position, this.xiaoqu[i].fullname);
            }
          });

      axios.get('/api/ljfl')
          .then(response => {
            // console.log(response);
            let arr = [];
            for (const amapManagerKey in response.data.data) {
              const bigItem = response.data.data[amapManagerKey]
              for (let i = 0; i < bigItem.length; i++) {
                const item = bigItem[i];
                arr.push([item.date, item.value, item.type])
              }
              // console.log(arr)
            }
            this.hlDate = arr
            // console.log(this.hlDate)
          });


    },
    async init_position() {
      const gisPosition = localStorage.getItem("GISInitPosition");
      if(gisPosition == null) {
        // console.log('没有缓存');
        await axios.get('/nova-vendor/laravel-nova-configuration/getAllConfigurations')
            .then(response => {
              // console.log(response);
              response.data.map(item => {
                item.key == "LOCAL_LATITUDE" ? this.beiyong.lat = item.value : '';
                item.key == "LOCAL_LONGTITUDE" ? this.beiyong.lng = item.value : '';
              });
              // console.log(this.beiyong);
              if(this.myMap == null) {
                setTimeout(() => {
                  this.myMap.setCenter(new AMap.LngLat(this.beiyong.lng, this.beiyong.lat));
                }, 500);
              } else {
                this.myMap.setCenter(new AMap.LngLat(this.beiyong.lng, this.beiyong.lat));
              }
              localStorage.setItem("GISInitPosition", JSON.stringify(this.beiyong));
              // console.log('换地址了');
            });

      }
    },

  },

};
</script>

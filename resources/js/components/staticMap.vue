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
        class="amap-demo"
        :events="events"
    >
    </el-amap>
    <div class="component">
      <div class="satellite">
        <a class="layer_item" @click="showSelect($event,'satellite')"  v-bind:class="{'item_active': (statusRecord.types == 'satellite' && statusRecord.isshowSelect)}">
          <i>
            <svg t="1600237558301" class="icon" v-bind:class="{'item_active': (statusRecord.types == 'satellite' && statusRecord.isshowSelect)}" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3036" width="16" height="16">
              <path d="M434.265 769.871L270.338 605.944l308.546-308.546 163.927 163.927-308.546 308.546zM298.623 605.944l135.642 135.642 280.261-280.261-135.642-135.641-280.261 280.26zM752.081 452.055L588.154 288.128l43.024-43.024L795.105 409.03l-43.024 43.025zM616.439 288.128L752.081 423.77l14.739-14.739-135.641-135.642-14.74 14.739z" fill="#5A5B5B" p-id="3037"></path>
              <path d="M646.101 471.162l14.143 14.143-196.58 196.58-14.142-14.144zM770.246 644.932l14.142 14.143L639.772 803.69l-14.143-14.142zM845.907 722.928l14.143 14.142L715.432 881.69l-14.143-14.143zM713.77 458.725L581.484 326.439l36.416-36.416 132.285 132.285-36.415 36.417z m-104-132.286l104 104 8.131-8.131-104-104-8.131 8.131zM396.172 776.322L263.887 644.037l36.415-36.415 132.285 132.285-36.415 36.415z m-104-132.285l104 104 8.13-8.13-104-104-8.13 8.13z" fill="#5A5B5B" p-id="3038"></path>
              <path d="M363.552 786.962L253.247 676.657l36.415-36.415 110.305 110.305-36.415 36.415z m-82.02-110.305l82.02 82.02 8.13-8.13-82.02-82.02-8.13 8.13zM732.14 293.917l14.142 14.143-29.053 29.053-14.143-14.142z" fill="#5A5B5B" p-id="3039"></path>
              <path d="M308.403 717.66l14.142 14.143-29.052 29.052-14.143-14.142zM234.158 791.906l14.143 14.143-13.558 13.557-14.142-14.143zM749.689 313.983c-6.268 0-12.16-2.44-16.592-6.873-4.432-4.431-6.872-10.323-6.872-16.591s2.44-12.16 6.873-16.592c4.432-4.431 10.323-6.87 16.591-6.87s12.159 2.439 16.591 6.87c4.432 4.432 6.872 10.324 6.872 16.592s-2.44 12.16-6.872 16.591c-4.43 4.433-10.323 6.873-16.591 6.873z m0-36.925a13.375 13.375 0 0 0-9.521 3.942c-2.543 2.542-3.943 5.923-3.943 9.52s1.4 6.978 3.943 9.52c2.543 2.544 5.924 3.944 9.521 3.944s6.978-1.4 9.52-3.943c2.543-2.543 3.943-5.924 3.943-9.521s-1.4-6.978-3.942-9.521a13.378 13.378 0 0 0-9.521-3.941z" fill="#5A5B5B" p-id="3040"></path>
              <path d="M288.584 853.415l-101.79-101.79 3.723-3.879c0.224-0.239 0.448-0.479 0.681-0.712 13.625-13.625 31.733-21.126 50.994-21.126s37.369 7.501 50.988 21.121c13.62 13.619 21.121 31.728 21.121 50.988s-7.501 37.369-21.121 50.988c-0.238 0.238-0.478 0.463-0.717 0.687l-3.879 3.723z m-87.669-101.81l87.689 87.688c10.146-11.378 15.696-25.9 15.696-41.276 0-16.59-6.461-32.187-18.191-43.918-11.731-11.73-27.328-18.191-43.918-18.191-15.374 0-29.893 5.548-41.276 15.697zM595.003 594.99l46.928 46.929-14.143 14.143-46.928-46.928zM390.995 396.154l46.928 46.928-14.143 14.143-46.928-46.928z" fill="#5A5B5B" p-id="3041"></path>
              <path d="M780.724 958.798L545.815 723.891l158.762-158.762 234.908 234.908-158.761 158.761zM574.101 723.891l206.623 206.623L911.2 800.037 704.577 593.414 574.101 723.891z" fill="#5A5B5B" p-id="3042"></path>
              <path d="M666.456 617.385L887.22 838.148l-14.143 14.143-220.763-220.764zM621.263 672.908l220.764 220.764-14.143 14.142L607.12 687.051zM303.128 186.284l14.143 14.142-144.618 144.618-14.142-14.143zM383.954 259.112l14.143 14.143L253.48 417.873l-14.143-14.143z" fill="#5A5B5B" p-id="3043"></path>
              <path d="M313.606 500.143L78.698 265.235l158.762-158.76 234.908 234.907-158.762 158.761zM106.983 265.235l206.623 206.623 130.477-130.477L237.46 134.759 106.983 265.235z" fill="#5A5B5B" p-id="3044"></path>
              <path d="M199.34 158.736L420.102 379.5l-14.143 14.142L185.196 172.88zM154.145 214.26l220.763 220.763-14.142 14.142-220.764-220.763z" fill="#5A5B5B" p-id="3045"></path>
            </svg>
          </i>
          卫星
        </a>
      </div>
      <div class="settings"  v-show="(statusRecord.isshowSelect)" style="background: #fff;box-shadow: 0 0 5px #aaa;border-radius: 3px;font-size: 14px;line-height: 2rem;">
        <div v-if="statusRecord.types == 'satellite'" style="padding: 10px;">
          <div style="display: flex;flex-flow: row wrap;justify-content: space-between;width: 200px;">
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="satellite" @click="showChecked($event)" :checked='statusRecord.satellite' /> 卫星地图 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="roadNet" @click="showChecked($event)" :checked='statusRecord.roadNet' /> 路网 </label>
          </div>
        </div>
      </div>
    </div>
    <div class="fullScreen" @click="screen">
      <svg t="1617183999617" v-if="fullscreen" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1718" width="32" height="32"><path d="M749.248 704H864a32 32 0 1 0 0-64H672a32 32 0 0 0-32 32v192a32 32 0 1 0 64 0v-114.752l137.36 137.36a32 32 0 1 0 45.232-45.264L749.248 704zM320 749.248V864a32 32 0 1 0 64 0V672a32 32 0 0 0-32-32H160a32 32 0 1 0 0 64h114.752l-137.36 137.36a32 32 0 1 0 45.264 45.232L320 749.248zM749.248 320H864a32 32 0 1 1 0 64H672a32 32 0 0 1-32-32V160a32 32 0 1 1 64 0v114.752l137.36-137.36a32 32 0 1 1 45.232 45.264L749.248 320zM320 274.752V160a32 32 0 1 1 64 0v192a32 32 0 0 1-32 32H160a32 32 0 1 1 0-64h114.752l-137.36-137.36a32 32 0 1 1 45.264-45.232L320 274.752z" p-id="1719"></path></svg>
      <svg t="1617183175145" v-else class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1429" width="32" height="32"><path d="M237.248 192H352a32 32 0 1 0 0-64H160a32 32 0 0 0-32 32v192a32 32 0 1 0 64 0v-114.752l137.36 137.36a32 32 0 1 0 45.232-45.264L237.248 192zM832 237.248V352a32 32 0 1 0 64 0V160a32 32 0 0 0-32-32H672a32 32 0 1 0 0 64h114.752l-137.36 137.36a32 32 0 1 0 45.264 45.232L832 237.248zM237.248 832H352a32 32 0 1 1 0 64H160a32 32 0 0 1-32-32V672a32 32 0 1 1 64 0v114.752l137.36-137.36a32 32 0 1 1 45.232 45.264L237.248 832zM832 786.752V672a32 32 0 1 1 64 0v192a32 32 0 0 1-32 32H672a32 32 0 1 1 0-64h114.752l-137.36-137.36a32 32 0 1 1 45.264-45.232L832 786.752z" p-id="1430"></path></svg>
    </div>
  </div>
</template>
<script>
import { AMapManager, lazyAMapApiLoaderInstance } from "vue-amap";
let amapManager = new AMapManager(); // 新建生成地图画布
import mqtt from 'mqtt'

export default {
  props: ['field'],
  data() {
    let self = this;
    return {
      beiyong: {lat: "32.059358",lng: "118.796628"},
      amapManager,
      zoom: 12,
      center: [],
      position: [],
      values: {},
      layers: [],
      markerList: [], // 所有点
      trucks: [],   //  所有车辆
      statusRecord: {
        isshowSelect: true, // 显示选择界面
        types: "satellite", // 展开菜单的类
        spots: true,  // 显示清运点
        transfers: true,  // 显示转运站
        community: true,  // 显示小区
        devices: true,  // 显示设备
        satellite: false
      },
      infoWindows: {},
      fullscreen:false,
      myMap: {},
      showType: '',
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
          self.init_map();
        }
      },
    };
  },
  created() {
    this.values = JSON.parse(localStorage.getItem("GISInitPosition")) ? JSON.parse(localStorage.getItem("GISInitPosition")) : {};
    this.statusRecord = JSON.parse(localStorage.getItem('statusRecord')) ? JSON.parse(localStorage.getItem('statusRecord')) : this.statusRecord;
    // console.log(this.statusRecord)
  },
  mounted() {
    //监听浏览器状态
    window.onresize = () => {
      if(!this.checkFull()){
        // 退出全屏后要执行的动作
        this.fullscreen = false;
      }
    }
    const [type] = (this.$route.path.split('/')).slice(-1); // 当前类型
    this.showType = type;
    if(this.$route.params.lat == undefined) {   //  刷新
      if(this.values.lat == undefined) { //  没有缓存
        this.values = this.beiyong;
      }
    } else { //  点击传值
      this.values = this.$route.params;
      localStorage.setItem("GISInitPosition", JSON.stringify(this.values));
    }
    let lng = this.values.lng, lat = this.values.lat;
    this.center = [lng, lat];
    this.position = [lng, lat];
    this.getData(`/api/trucks`).then(res => {
      if (res.status == 200 && res.data && res.data.data) this.truckList = res.data.data
    })
  },

  methods: {
    addMarker (icon, lat, lng, url, content, text, id, name) {
      AMapUI.loadUI(['overlay/AwesomeMarker'], (AwesomeMarker) => {
        const marker = new AwesomeMarker({
          awesomeIcon: icon, // 可用的icons参见： http://fontawesome.io/icons/
          containerClassNames: 'my_icons', // 添加自定义的class
          iconLabel: {
            style: {
              color: '#333', // 设置颜色
              fontSize: '18px',
            }
          },
          iconStyle: 'blue', // 设置图标样式  #3CA0C8
          position: [lng, lat],
          extData: { id: id, text, name }
        })
        marker.myContent = content;
        marker.on("mouseover", this.infoWindowOpen);
        marker.emit("mouseover", { target: marker});
        marker.on("mouseout", this.infoWindowClose);
        marker.emit("mouseout", { target: marker});
        marker.on("dblclick", () => { //  左双击跳转
          window.location.href = `/resources/${url}`
        });
        marker.setMap(this.myMap);
        this.markerList.push(marker)
      })
    },
    init_echo () { // Echo
      let mqttName = '', type
      if (this.showType == 'truck') {
        mqttName = 'getTruckGPS'
        type = 'App\\Models\\User'
      }
      else if (this.showType == 'user') {
        mqttName = 'getUserGPS'
        type = 'App\\Models\\Truck'
      }
      else return
      this.client = mqtt.connect("ws://iot.norgeit.com:8083/mqtt", {
        username: "",
        password: ""
      });
      this.client.on("connect", e =>{
        console.log("连接成功");
        this.client.subscribe(mqttName, (err)=> {
          if (!err)  console.log("订阅成功:" + mqttName);
        });
      });
      this.client.on("message", (topic, message) => {
        // console.log(message)
        const data = JSON.parse(this.Utf8ArrayToStr(message))
        // console.log(data);
        data.subject_type = type
        this.echoPositionChange(data)
      });
      // 断开发起重连
      this.client.on('reconnect', (error) => {
          console.log('（mqtt）正在重连:', error, '时间:', new Date().toLocaleString())
      })
      // 链接异常处理
      this.client.on('error', (error) => {
          console.log('（mqtt）连接失败:', error)
      })
    },
    echoPositionChange (data) { // 位置变更
      if (data.subject_type === 'App\\Models\\User' && this.showType == 'user') {
        this.getData(`/api/users?user_id=${data.subject_id}`).then(res => {
          if (!res.data.data || res.data.data.length === 0) return
          let userMes = res.data.data[0]
          userMes.position = data.position
          this.updateMarker(userMes, 'users')
        })
        return
      }
      if (data.subject_type === 'App\\Models\\Truck' && this.showType == 'truck') {
        for (let index = 0; index < this.truckList.length; index++) {
          const element = this.truckList[index]
          if (element.licenseNO !== data.ChannelName) continue
          element.position = {
            lat: data.Latitude,
            lng: data.Longitude
          }
          this.updateMarker(element, 'trucks')
        }
      }
    },
    updateMarker (data, type) { // 更新点
      let text = data.name
      if (type === 'trucks') text = data.licenseNO
      for (const key in this.markerList) { // 是否存在点
        const element = this.markerList[key]
        const extData = element.getExtData()
        if (extData.text === type && extData.name === text) {
          const position = element.getPosition() // 点坐标
          if (position.lat === data.position.lat && position.lng === data.position.lng) return // 坐标不变
          element.setPosition(new AMap.LngLat(data.position.lng, data.position.lat)) // 更新点
          element.setMap(this.myMap)
          return
        }
      }
      this.manageData([data], type) // 创建点
    },
    init_map() {  //  初始化地图
      this.myMap = amapManager.getMap();
      this.myMap.setZoom([7,18]);
      this.getMessage(this.showType);
      this.getCurrentPositions(true)
    },
    showChecked(e) {
      if(e.target.checked) {
        if(e.target.value == 'satellite') {    //  开启卫星地图
          this.myMap.add(this.layers[0]);
          this.statusRecord.satellite = e.target.checked
        } else if(e.target.value == 'roadNet') {    //  开启路网
          this.myMap.add(this.layers[1])
          this.statusRecord.roadNet = e.target.checked
        } else {
          this.statusRecord[e.target.value] = e.target.checked
        }
      } else {
        if(e.target.value == 'satellite') {    //  关闭卫星地图
          this.myMap.remove(this.layers[0]);
          this.statusRecord.satellite = e.target.checked
        } else if(e.target.value == 'roadNet') {    //  关闭路网
          this.myMap.remove(this.layers[1])
          this.statusRecord.roadNet = e.target.checked
        } else {
          this.statusRecord[e.target.value] = e.target.checked
        }
      }
      localStorage.setItem('statusRecord', JSON.stringify(this.statusRecord));
    },
    getMessage(type) {
      if (type != 'transfer') type += 's'
      if (type == 'communityCounts') type = 'addresses/communityCounts'
      this.getData(`/api/${type}`)
        .then(res => {
          if(res.data.data && res.data.data.length) this.detailMarker(res.data.data);
        });
    },
    detailMarker(data) {
      if(this.showType == 'device') this.manageData(data, 'devices'); // 显示设备
      else if(this.showType == 'spot') this.manageData(data, 'spots'); // 显示清运点
      else if(this.showType == 'transfer')this.manageData(data, 'transfers'); // 显示转运站
      else if(this.showType == 'communityCount')this.manageData(data, 'addresses'); // 显示转运站
      else if(this.showType == 'user') { this.manageData(data, 'users'); this.init_echo() } // 显示用户
      else if(this.showType == 'truck') { this.manageData(data, 'trucks'); this.init_echo() } // 显示车辆
    },
    async manageData(data, text) { // 信息分类 添加点
      if (!data) return
      for (let i = 0; i < data.length; i++) {
        const item = data[i];
        if(!item.position || !item.position.lat) continue
        let url = `${text}/${item.id}`;
        let content, icon, name;
        if(text == 'users') {
          content = `<p>名称：${item.name}</p>`
          name = item.name
          icon = 'user'
        }
        else if(text == 'trucks') {
          content = `<p>车牌：${item.licenseNO}</p>`
          name = item.licenseNO
          icon = 'truck'
        }
        else if(text == 'devices') {
          content = `<p>名称：${item.deviceno}</p>`
          name = item.deviceno
          icon = 'trash'
        }
        else if(text == 'spots') {
          content = `<p>名称：${item.name}</p>`
          name = item.name
          icon = 'home'
        }
        else if(text == 'transfers') {
          content = `<p>名称：${item.name}</p>`
          name = item.name
          icon = 'exchange'
        }
        else if(text == 'addresses') {
          content = `<p>名称：${item.name}</p>`
          name = item.name
          icon = 'building'
        };
        this.addMarker(icon, item.position.lat, item.position.lng, url, content, text, item.id, name)
      }
    },
    infoWindowTable(data) { // 返回 统计显示 html
      if (!data) return
      let content = '<div class="myInfoWindowTable">'
      for (let i = 0; i < data.details.length; i ++) {
        const item = data.details[i];
        content += `<span>${item.name} : ${item.amount % 1 === 0 ? item.amount : (item.amount).toFixed(2)} ${item.type}</span>`
      }
      return content;
    },
    getStatistics(id, text) { // 获取 统计
      return this.getData(`/api/${text}/${id}/statistics`)
          .then(res => {
            // console.log(res);
            if(!res.data) return null
            return res.data
          })
    },
    getData(url) { // get 请求数据
      return axios.get(url).then(response => { return response }).catch(err => { return err });
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
    showSelect(e, type) {   //  显示 - 选择 GIS 类型显示
      if(type != this.statusRecord.types) { //  打开新的
        this.statusRecord.isshowSelect = true;
      } else {
        this.statusRecord.isshowSelect = !this.statusRecord.isshowSelect;
      }
      this.statusRecord.types = type;
      localStorage.setItem('statusRecord', JSON.stringify(this.statusRecord));
    },
    async infoWindowOpen(e) { //  鼠标悬停，打开信息窗
      if (e.lnglat === undefined) return; //  加载时，不显示
      var infoWindow = this.infoWindows;
      if(infoWindow.CLASS_NAME == undefined) {
        infoWindow = new AMap.InfoWindow({
          offset: new AMap.Pixel(30, 10),
          closeWhenClickMap: true,
          anchor: 'top-left'
        });
      }
      let content = e.target.myContent
      const data = e.target.getExtData()
      if(data.id && data.text !== 'users' && data.text !== 'trucks') {
        let tongji = await this.getStatistics(data.id, data.text)
        if(!tongji) {
          content += '<h3>部分信息获取错误，请稍后重试</h3>'
        } else if(data.text == 'addresses') {
          content += `<p>入住率：${tongji['入住率']}</p><p>参与率：${tongji['参与率']}</p>`
        } else {
          const table = await this.infoWindowTable(tongji.day);
          if (table) content += table
        }
      }
      infoWindow.setContent(content);
      infoWindow.open(this.myMap, e.target.getPosition());
      this.infoWindows = infoWindow;
    },
    infoWindowClose(e) { //  鼠标移除，关闭信息窗
      if (e.lnglat === undefined) return; //  加载时，不显示
      if (this.infoWindows.CLASS_NAME === undefined) return; //  空，不显示
      this.infoWindows.close();
    },
    getCurrentPositions (panToLocation) {
      AMap.plugin('AMap.Geolocation', () => {
        var geolocation = new AMap.Geolocation({
          enableHighAccuracy: true, // 是否使用高精度定位，默认:true
          timeout: 10000, // 超过10秒后停止定位，默认：5s
          buttonPosition: 'LB', // 定位按钮的停靠位置
          buttonOffset: new AMap.Pixel(10, 20), // 定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
          // showCircle: true, // 定位成功后用圆圈表示定位精度范围，默认：true
          panToLocation // 定位成功后将定位到的位置作为地图中心点，默认：true
          // zoomToAccuracy: false // 定位成功后是否自动调整地图视野到定位点
        })
        this.myMap.addControl(geolocation)
        geolocation.getCurrentPosition((status, result) => {
          // console.log(result)
          if (status === 'complete') {
            // this.position = result.position
          }
        })
      })
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
    Utf8ArrayToStr(array) {
      let out, i, len, c;
      let char2, char3;
      out = "";
      len = array.length;
      i = 0;
      while(i < len) {
        c = array[i++];
        switch(c >> 4)
        {
          case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
          // 0xxxxxxx
          out += String.fromCharCode(c);
          break;
          case 12: case 13:
          // 110x xxxx 10xx xxxx
          char2 = array[i++];
          out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
          break;
          case 14:
          // 1110 xxxx 10xx xxxx 10xx xxxx
            char2 = array[i++];
            char3 = array[i++];
            out += String.fromCharCode(((c & 0x0F) << 12) |
                ((char2 & 0x3F) << 6) |
                ((char3 & 0x3F) << 0));
            break;
        }
      }
      return out;
    },
    destroyConnection() { // 断开MQTT
      if (this.client && this.client.connected) {
        try {
          this.client.end()
          this.client = {
            connected: false,
          }
          console.log('已成功断开连接！')
        } catch (error) {
          console.log('断开连接失败 ', error.toString())
        }
      }
    }
  },
  beforeRouteLeave (to, form, next) {
    this.destroyConnection()
    next()
  }
};
</script>

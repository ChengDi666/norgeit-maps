<template>
    <div class="my-amap-page" :field="field" :card="card" :key="key" :lens="lens" :size="size">
      <el-amap
        v-if="center.length"
        vid="amapDemo"
        :center="center"
        :zoom="zoom"
        :amap-manager="amapManager"
        class="amap-demo"
        :events="events"
      >
        <!-- <el-amap style="height:100%;width:100%;min-height: 500px;"
                     :center="center"
                     :zoom="zoom" 
                     :amap-manager="amapManager"
        :events="events">-->
        <!-- <el-amap-marker v-if="position.length" vid="component-marker" :position="position"></el-amap-marker> -->
        <!-- <el-amap-marker
                vid="component-marker"
                v-for="(item,index) in userList"
                :key="index"
                :position="[item.lng,item.lat]"
        :extData="item" ></el-amap-marker>-->


        <!-- <el-amap-marker
          v-for="(marker, index) in markers"
          :vid="marker.vid"
          :key="index"
          :position="marker.position"
          :content="marker.content"
          :events="marker.events"
        ></el-amap-marker> -->


        <!-- <el-amap-info-window
          v-if="window"
          :position="window.position"
          :visible="window.visible"
          :offset="window.offset"
          :content="window.content"
        ></el-amap-info-window> -->
      </el-amap>
      <div class="satellite">
        <a class="layer_item" @click="Satellite()"  v-bind:class="{'item_active': isSatellite}">
          <i>
            <svg t="1600237558301" class="icon"  v-bind:class="{'item_active': isSatellite}" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3036" width="16" height="16">
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
      <div v-show="isSatellite" class="satellite wrapper">
        <div class="layer_item" @click="RoadNet()">
          <svg t="1600239865869" class="icon"  v-bind:class="{'item_active': isRoadNet}"  viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3889" width="16" height="16">
            <path d="M510.741333 63.096037c-247.523443 0-448.185602 200.658066-448.185602 448.186625 0 247.526513 200.657043 448.184579 448.185602 448.184579s448.186625-200.658066 448.186625-448.184579C958.927959 263.754103 758.269893 63.096037 510.741333 63.096037L510.741333 63.096037zM752.498446 396.689764 449.351148 699.837062c-5.982248 5.977132-16.356526 5.296633-23.175839-1.52268l-20.316721-20.316721c-0.005117-0.005117-0.010233-0.005117-0.010233-0.010233L270.029016 542.16809c-6.819313-6.819313-6.819313-17.874089 0-24.693402l37.040614-37.040614c6.819313-6.824429 17.873066-6.824429 24.693402 0L438.521498 587.193563l252.237815-252.237815c5.983271-5.982248 16.356526-5.301749 23.175839 1.517563l37.040614 37.040614C757.795079 380.338355 758.475578 390.71161 752.498446 396.689764L752.498446 396.689764zM752.498446 396.689764" p-id="3890" fill="#5f6477"></path>
          </svg>
          路网
        </div>
      </div>
    </div>
</template>
  <style>
/* .amap-demo {
  height: calc(100vh - 110px);
} */
</style>
<script>
import { AMapManager, lazyAMapApiLoaderInstance } from "vue-amap";
let amapManager = new AMapManager(); // 新建生成地图画布
let mqtt = require('mqtt');

export default {
  props: ["resource", "resourceName", "resourceId", "field"],
  data() {
    let self = this;
    return {
      userMessage: [],
      beiyong: {lat: "32.059358",lng: "118.796628"},
      // markers: [],
      markerRefs: [],
      amapManager,
      zoom: 12,
      center: [],
      position: [],
      clusters: {},
      userClusters: {},
      values: {},
      layers: [],
      isSatellite: true,
      isRoadNet: true,
      client: {},
      infoWindows: {},
      myMap: {},
      events: {
        init(o) {
          // 构造官方卫星、路网图层
          var layer1 = new AMap.TileLayer.Satellite({ opacity: 0.8 });  //  卫星
          var layer2 =  new AMap.TileLayer.RoadNet({ opacity: 0.5 });   //   路网
          var layers = [
              layer1,
              layer2
          ]
          // 添加到地图上
          if(self.isSatellite) {
            o.add(layers);
          }
          self.layers = layers;
          setTimeout(() => {
            self.init_mqtt();
            self.ceshi();
          }, 1000);
        },
      },
    };
  },
  created() {
    this.userMessage = JSON.parse(localStorage.getItem("requestMarker")) ? JSON.parse(localStorage.getItem("requestMarker")) : [];
    this.values = JSON.parse(localStorage.getItem("GISInitPosition")) ? JSON.parse(localStorage.getItem("GISInitPosition")) : {};
    this.isSatellite = JSON.parse(localStorage.getItem('isSatellite'));
  },
  mounted() {
    // this.init_mqtt();
    this.init_position();
    // console.log(this);
    // console.log('field  ' +this.field);
    // console.log(this.$route.params);
    setInterval(() => {
      this.regularCheck();
    }, 60000);

    if(this.$route.params.lat == undefined) {   //  刷新
      if(this.values.lat == undefined) {
        //  没有缓存
        this.values = this.beiyong;
        // console.log('没有缓存,要请求数据');
      }
      // console.log('刷新取值');
    } else {
      //  点击传值
      // console.log('点击传值');
      this.values = this.$route.params;
      localStorage.setItem("GISInitPosition", JSON.stringify(this.values));
    }
    // console.log(this.values);
    let lng = this.values.lng, lat = this.values.lat;
    this.center = [lng, lat];
    this.position = [lng, lat];
    let that = this;

  },

  methods: {
    init_mqtt(){
      this.client = mqtt.connect('wss://iot.ljfl.ltd:443/mqtt', {
          username: "test",
          password: "test"
      });
      //订阅后端给你发的字段 在on里面接收
      // console.log('准备开启mqtt链接');
      this.client.on('connect', () => {
        console.log('连接成功');
          this.client.subscribe('tttt', function (err) {
              if (!err) {
                  console.log("订阅成功:" + 'tttt');
              }
          })
      });
      this.client.on('message', (topic, message) => {
          // console.log('接受消息');
          if (topic === 'tttt') {
            //DOSOMETHING
            // console.log(message);
            const mes = this.Utf8ArrayToStr(message)
            // console.log(mes);
            if(mes) {
              const users = JSON.parse(mes)
              // console.log(users);
              if(users.lat != 0 && users.lng != 0) {
                users.time = new Date();
                this.addMarkers(users);
                // for (let index = 0; index < 5; index++) {
                //   this.addMarkers({
                //     id: users.id+index+1,
                //     lat: users.lat+Math.random(),
                //     lng: users.lng+Math.random(),
                //     name: users.name+index,
                //     time: users.time
                //   });
                // }
              } else {
                // console.log('下线了');
                // console.log(users);
                this.delMarker("DDY" + users.id);
                this.delCache(users.id);
              }
            }
          }
      })
      //连接断开
      // client.end()
    },
    addMarkers(data) {
      // console.log(data);
      this.delMarker(`DDY${data.id}`);
      let marker = new AMap.Marker({
        vid: `DDY${data.id}`,
        position: [data.lng, data.lat],
        title: `鼠标左键双击，查看用户详情`,
        clickable: true,
        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAClklEQVRYR+2WQWjTUBjH/1+2JN3JXSamFRxDStohCnOiIOhQUHSiIoooKIha8DTcwZNQT14G4k2nXvQgeHCiB72ovXlRQXFNO3Zbm+4gO7jD2qTLJ8lWqO3SvBFLUZZTePm/7/973/e990Lo8EMd9sdfAYhWkndBfBbAZhC+OVW+Pd+Ty4gsLjRA1Eo8AXCl0cyRpcF5ms4GQYQC0MqDR0ly3vqYTEvy4nCBCkutIMIBWMkJAo/7GUjs7Cyo+e//MUDrEsxI8uKutpbATW3UTr4D85E/0kz4SaDzRTn7vq1NWAuuVZIXQXyVCHECXvCy88CM5PNB5u73UE0oYhCkaQKI2okpME41TLxmKsZjd2wbJzTb4hSIRgEMBRkAWCBgloFHtRj1c5oAtHJijCTcqxd1MXbMqcaPAR7YVLZVt64ixs1szHdMNZcOAGg+XEzF8EBjVvIhg68LrNpX4izzSP0x3VyCSlwHdRl1Eb6YirFbs/QhAn0OY+41HeF+UTbGanGaAPq5P2LZPSUAvStdSpNFJZvSLH2CQL6nnjAY8WtTzp30BfD2tpX4BGCv+87gVEnJTUZtfQ5MW4WNfIQMZEqKMdISoHFurKqPskNv6ibdcIBzBBwMBCJOg3EAIM80EGALb+9DuXuwPrDULd0E84naWESu9C7Z6itxANoP4HAgQKysj7NEtwD0+a+MP5hK7pBmJT4KAzjSPtDKcd0yAyJBCbhcVIynIlpvEcRpdmgPEY4FAgRlgIBnRcW45AZaDwBAw2AcDwRwBWv1gDtuRapfF2j2V600bQMI7OpVwQbARgb+rQywFAf4wupt+LIoG2fWdRestTPcDIjsGCLOwMEMJDrt6R2eMtXc89AAIuYimo7/lP4Gi1g0MPX9g/AAAAAASUVORK5CYII=',
      });
      marker.content = `<p>用户名：${data.name}</p><p>手机：${data.phonenumber}</p>`;
      marker.on("mouseover", this.infoWindowOpen);
      marker.emit("mouseover", { target: marker});
      marker.on("mouseout", this.infoWindowClose);
      marker.emit("mouseout", { target: marker});      
      marker.on("dblclick", () => { //  左双击跳转
        window.location.href = '/resources/users/' + data.id
        // window.open("//www.baidu.com");    
      });
      let isOk = true;
      const arr = this.userMessage.map((item) => {
        if (data.id == item.id) {
          isOk = false;
          return data;
        }
        return item;
      });
      if (isOk) this.userMessage.push(data);
      else this.userMessage = arr;
      // console.log(this.userMessage);
      // this.myMap.add(marker);
      this.userClusters.addMarker(marker);
      localStorage.setItem("requestMarker", JSON.stringify(this.userMessage));
    },
    delMarker(id) {
      // const arr = this.myMap.getAllOverlays('marker');
      const arr = this.userClusters.kb;
      if(arr) {
        // console.log('所有的点');
        // console.log(arr);
        arr.forEach(element => {
          if(id === element.Ce.vid) { //  点存在删除
            // this.myMap.remove(element);
            // console.log('删除地图点');
            // console.log(element);
            this.userClusters.removeMarker(element);
          }
        });
      }
    },
    regularCheck() {  //  判断有效期
      const markerArr = JSON.parse(localStorage.getItem("requestMarker"));
      const thisTime = new Date();
      if (markerArr) {
        markerArr.map((item) => {
          if (thisTime - new Date(item.time) > 300000) {
            // console.log(item);
            console.log("DDY" + item.id + " 连接超时");
            this.delMarker("DDY" + item.id);
            this.delCache(item.id);
          }
        });
      }
    },
    delCache(id) {  //  清除指定缓存和存储数组
      this.userMessage.forEach((element, index) => { //  删除数组 和缓存 里的点信息
        if(id === element.id) {
          // console.log('删除的数据');
          // console.log(element);
          this.userMessage.splice(index, 1)
          // console.log(this.userMessage);
          localStorage.setItem("requestMarker", JSON.stringify(this.userMessage));
        }
      });
    },
    markerClick(e) {
      // console.log(e);
      let map = amapManager._map;
      var infoWindow = new AMap.InfoWindow({ offset: new AMap.Pixel(0, -30) });
      // console.log(infoWindow.getIsOpen());
      if (e.lnglat === undefined) return; //  加载点，不显示
      infoWindow.setContent(e.target.content);
      infoWindow.open(map, e.target.getPosition());
    },
    daxiao() {
      let map = amapManager._map;
      map.on("zoomchange", () => {
        var zoom = map.getZoom(); //获取当前地图级别
        this.zoom = zoom;
        // console.log(this.deviceClusters.getMarkers());
        // console.log(this.zoom);
      });
    },
    dellocalStorage() {
      localStorage.removeItem("requestMarker");
      this.userMessage = [];
    },

    ceshi() {
      let o = amapManager.getMap();
      this.myMap = o;
      // console.log(o);
      // console.log(this.markerRefs);
      let deviceClusters = new AMap.MarkerClusterer(o, this.markerRefs, {
        gridSize: 80,
        maxZoom: 16,
      });
      this.deviceClusters = deviceClusters;
      let userCluster = new AMap.MarkerClusterer(o, [], {
        gridSize: 80,
        maxZoom: 16,
        renderClusterMarker: this.cece
      });
      this.userClusters = userCluster;
      this.daxiao();
      // console.log(this.beiyong);
      this.init_courses();
      // console.log(this.userMessage);
      if (this.userMessage.length !== 0) {
        this.userMessage.map((item) => {
          this.addMarkers(item);
        });
      }
    },
    init_courses()
    {
      axios.get('/nova-api/devices?search=&filters=W10%3D&orderBy=&perPage=25&trashed=&page=1&relationshipType=')
      .then(response => {
        // console.log(response);
        let itemarr = (response.data.resources).map((item) => {
          let itemobj = {};
          for (const element  of item.fields) {
            itemobj[element.sortableUriKey] = element.value;
          }
          // console.log(itemobj);
          // itemarr.push(itemobj);
          return itemobj;
        });
        // console.log("转换值：");
        // console.log(itemarr);
        itemarr.map((item) => {
          this.addDevices(item);
        });
          // this.configurations = response.data
      });   
    },
    addDevices(data) {
      // console.log(data);
      let marker = new AMap.Marker({
        vid: `${data.id}`,
        position: [data.position.lng, data.position.lat],
        title: "鼠标左键双击，查看设备详情",
        clickable: true,
        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADWklEQVRYR9WWWWxMYRTH/+dOZzpFI2jsZFJNSxpUQiQEnSEifZHQGYkmVFBCQpDYE2JriHgQImKJJYgOIRLxYJmpB/uD2mJfi9JF0Wp1lr/cGa2OznrvQ/lev3PO/3f/3znfdwXtvKSd9fFvA3QtbpwkVFaoLo0aKjm7DYtMsRy7h8Hc65vruVbGu2psitmYV75UGiLlRXUgbVPTfCrYoyZPGi3Y2VSELkl1URnONEzEfm8hbj1gIM6gIOfzSlOZJoBuWzzFAFfqAaDQUbMq2akJIG2Lp4SgvRkgpeZ1rBMI7L83WFocgHBt9arkzZoAuhU3PQCRrSZn9Iu/X+saiIqq35Lkkeo1yTMTBrCsp/m7yROxeeKyIhh0vXq1aVRCAAUub/7XOg5895kbExAKGyqQuuwMLibl1fFco+vvoLC+Ti/1PBEgU694aL6cOzYuafL/AVBw1XMDxEiVtic+6jKiAr2C+cKjx8aaZsTlgBrEy/Y+VFCuSz1QCG8Um9OSUBM2B/td9h/qbaoTolSxOnM1AdBtLyMxJCqAwQz4GiOGkHLEYCtJ/B5QK/rd9tMgpoStnpoO6ZsH/vgI1JQB35+HH0PBBsl1rtPkgO+KY6sIl7dpnMwiIKUH8LMK/HIfkjYCaKwCXxxtoyOU2WIrOagJgK78OYTsa50sI3aAb88Cn66G1JT0AsCQDD4L1fKRE4y2U5e1AVzJH0+RSy3JnbMgmfPA20vD252zDry/DfD9ucHFr2TI+JMvtAFcmppOg9KSLJbAwwi+jvC69p8MfHsG1D5q1vMKKlPE6vZqAyCEbnt98yjKwAVghbu1QGhdFbD24Z994qVicw6INkUx39iQUewyBJJVBL47D7y/0LYHOlnAx7uBptrg5SdwSa7TphfgNH+PogzbCNADvjwRtLrVkuwlQH05qIp/uBg8KvCwwXqqUB+Ay7Gd4LIQsYxZgCkVoB9orATM3cGqW0DlzVCoGHdAwKVodIGvcDkWEtzVJs6YCnToDfh+BiG8aquELgHmiNV5QJ8DpY48+nk+Fmi4fZ8PE40TnMHziLBiO1A6bRD9/pa5SgREkpQsGXPyqT4AV6EZqL9DBH9O410CPAQ6DhfrocgvVTw9EK+g1riYR6C1cLx57Q7wCyGPSzCh+iY7AAAAAElFTkSuQmCC',
        offset: new AMap.Pixel(-13, -30),
        events: {
        },
      });
      marker.content = "<p>设备编号：" + data.deviceno + "</p><p>地址："+ data.address_id +"</p>";
      // marker.on("click", this.markerClick);
      // marker.emit("click", { target: marker });
      marker.on("mouseover", this.infoWindowOpen);
      marker.emit("mouseover", { target: marker});
      marker.on("mouseout", this.infoWindowClose);
      marker.emit("mouseout", { target: marker});      
      marker.on("dblclick", () => { //  左双击跳转
        window.location.href = '/resources/devices/' + data.id
        // window.open("//www.baidu.com");    
      });
      this.deviceClusters.addMarker(marker);
    },
    async init_position() {   
      const gisPosition = localStorage.getItem("GISInitPosition");
      // console.log('缓存 ', localStorage.getItem("GISInitPosition").length);
      // console.log(gisPosition);
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
          let map = amapManager.getMap();
          if(map == null) {
            setTimeout(() => {
              amapManager.getMap().setCenter(new AMap.LngLat(this.beiyong.lng, this.beiyong.lat));
            }, 500);
          } else {
            amapManager.getMap().setCenter(new AMap.LngLat(this.beiyong.lng, this.beiyong.lat));
          }
          localStorage.setItem("GISInitPosition", JSON.stringify(this.beiyong));
          // console.log('换地址了');
          
        });     

      }
    },
    Satellite() { //  卫星显示和隐藏
      this.isSatellite = !this.isSatellite;
      localStorage.setItem('isSatellite', this.isSatellite);
      // console.log(this.isSatellite);
      // console.log(this.layers);
      let map = amapManager.getMap();
      // console.log(map.getLayers());
      if(this.isSatellite) {
        map.add(this.layers);
        this.isRoadNet = true;
      } else map.remove(this.layers)
      // this.isSatellite ? map.add(this.layers) : map.remove(this.layers);
    },
    RoadNet() { //  路网显示和隐藏
      this.isRoadNet = !this.isRoadNet;
      let map = amapManager.getMap();
      this.isRoadNet ? map.add(this.layers[1]) : map.remove(this.layers[1]);
    },
    infoWindowOpen(e) { //  鼠标悬停，打开信息窗
      // console.log(e);
      if (e.lnglat === undefined) return; //  加载时，不显示
      var infoWindow = new AMap.InfoWindow({ offset: new AMap.Pixel(5, -30), closeWhenClickMap: true });
      // console.log('鼠标移入');
      infoWindow.setContent(e.target.content);
      infoWindow.open(amapManager.getMap(), e.target.getPosition());
      this.infoWindows = infoWindow;
      // console.log(infoWindow);

    },
    infoWindowClose(e) { //  鼠标移除，关闭信息窗
      // console.log(e);
      if (e.lnglat === undefined) return; //  加载时，不显示
      // console.log('鼠标移出');
      this.infoWindows.close();
    },
    Utf8ArrayToStr(array) { //  Utf8Array 转字符串
        var out, i, len, c;
        var char2, char3;
    
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
            // 110x xxxx   10xx xxxx
            char2 = array[i++];
            out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
            break;
          case 14:
            // 1110 xxxx  10xx xxxx  10xx xxxx
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
    cece(context) { //  用户聚合样式
      var count = this.userClusters.kb.length;
      var factor = Math.pow(context.count / count, 1 / 18);
      var div = document.createElement('div');
      var Hue = 180 - factor * 180;
      var bgColor = 'hsla(' + Hue + ',100%,50%,0.7)';
      var fontColor = 'hsla(' + Hue + ',100%,20%,1)';
      var borderColor = 'hsla(' + Hue + ',100%,40%,1)';
      var shadowColor = 'hsla(' + Hue + ',100%,50%,1)';
      div.style.backgroundColor = bgColor;
      var size = Math.round(15 + Math.pow(context.count / count, 1 / 5) * 20);
      div.style.width = div.style.height = size + 'px';
      div.style.border = 'solid 1px ' + borderColor;
      div.style.borderRadius = size / 2 + 'px';
      div.style.boxShadow = '0 0 1px ' + shadowColor;
      div.innerHTML = context.count;
      div.style.lineHeight = size + 'px';
      div.style.color = fontColor;
      div.style.fontSize = '14px';
      div.style.textAlign = 'center';
      context.marker.setOffset(new AMap.Pixel(-size / 2, -size / 2));
      context.marker.setContent(div)
    },
  },
    
};
</script>

<style>
/* Scoped Styles */
</style>

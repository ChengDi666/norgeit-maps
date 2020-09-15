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
        <el-amap-marker
          v-for="(marker, index) in markers"
          :vid="marker.vid"
          :key="index"
          :position="marker.position"
          :content="marker.content"
          :events="marker.events"
        ></el-amap-marker>
        <!-- <el-amap-info-window
          v-if="window"
          :position="window.position"
          :visible="window.visible"
          :offset="window.offset"
          :content="window.content"
        ></el-amap-info-window> -->
      </el-amap>
    </div>
</template>
  <style>
/* .amap-demo {
  height: calc(100vh - 110px);
} */
</style>
<script>
import Echo from "laravel-echo";
import io from "socket.io-client";
import { AMapManager, lazyAMapApiLoaderInstance } from "vue-amap";
let amapManager = new AMapManager(); // 新建生成地图画布

export default {
  props: ["resource", "resourceName", "resourceId", "field", "card"],
  data() {
    let self = this;
    return {
      cun: [],
      beiyong: {lat: "32.059358",lng: "118.796628"},
      markers: [],
      markerRefs: [],
      amapManager,
      zoom: 12,
      center: [],
      position: [],
      clusters: {},
      values: {},
      events: {
        init(o) {
          // 构造官方卫星、路网图层
          var layer1 = new AMap.TileLayer.Satellite();  //  卫星
          var layer2 =  new AMap.TileLayer.RoadNet();   //   路网
          var layers = [
              layer1,
              layer2
          ]
          // 添加到地图上
          o.add(layers);
          setTimeout(() => {
            self.ceshi();
          }, 1000);
        },
      },
    };
  },
  created() {
    this.cun = JSON.parse(localStorage.getItem("requestMarker")) ? JSON.parse(localStorage.getItem("requestMarker")) : [];
    this.values = JSON.parse(localStorage.getItem("GISInitPosition")) ? JSON.parse(localStorage.getItem("GISInitPosition")) : {};
  },
  mounted() {
    this.init_position();
    // console.log(this);
    // console.log('field  ' +this.field);
    // console.log(this.$route.params);
    setInterval(() => {
      this.dome();
    }, 200000);

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
    console.log(this.values);
    let lng = this.values.lng, lat = this.values.lat;
    this.center = [lng, lat];
    this.position = [lng, lat];
    let that = this;

    window.io = io;
    window.Echo = new Echo({
      broadcaster: "socket.io",
      host: "http://localhost:6001",
    });
    window.Echo.listen("test-event", ".sendLocation", (res) => {
      console.log(res);
      // console.log(this.markers);
      // console.log(this.clusters.getClustersCount());

      res.time = new Date();
      this.addMarkers(res);

      // console.log(this.clusters.getMarkers());
    });
  },

  methods: {
    markerClick(e) {
      // console.log(e);
      let map = amapManager._map;
      var infoWindow = new AMap.InfoWindow({ offset: new AMap.Pixel(0, -30) });
      // console.log(infoWindow.getIsOpen());
      if (e.lnglat === undefined) return; //  加载点，不显示
      infoWindow.setContent(e.target.content);
      infoWindow.open(map, e.target.getPosition());
    },
    upmarkers(vid) {
      const arr = this.clusters.getMarkers();
      arr.map((item) => {
        if (item.F.vid === vid) {
          console.log(item.F.vid);
          console.log(item.getPosition());
          // item.setPosition([121.426274 + 0.05, 37.513546 + 0.05]);
          this.clusters.removeMarker(item);
        }
      });
    },
    addMarkers(data) {
      this.upmarkers(`tj${data.id}`);
      data.lat = data.lat - (Math.random() - 0.5) * 0.02;
      data.lng = data.lng - (Math.random() - 0.5) * 0.02;
      let marker = new AMap.Marker({
        vid: `tj${data.id}`,
        position: [data.lng, data.lat],
        title: `这是测试的点 ${data.id}`,
        clickable: true,
        events: {
          // click: (o) => {
          //     console.log(o);
          //     alert('click marker');
          // },
        },
      });
      marker.content = "<p>ID：" + data.id + "</p><p>名称：测试</p>";
      marker.on("click", this.markerClick);
      marker.emit("click", { target: marker });
      let a = true;
      const arr = this.cun.map((item) => {
        if (data.id == item.id) {
          a = false;
          return data;
        }
        return item;
      });
      if (a) this.cun.push(data);
      else this.cun = arr;
      // console.log(this.cun);
      this.clusters.addMarker(marker);
      localStorage.setItem("requestMarker", JSON.stringify(this.cun));
    },
    dome() {//  判断有效期
      const markerArr = JSON.parse(localStorage.getItem("requestMarker"));
      const thisTime = new Date();
      if (markerArr) {
        markerArr.map((item) => {
          if (thisTime - new Date(item.time) > 300000) {
            // console.log(item);
            console.log(item.id + " 断开连接");
            this.upmarkers("tj" + item.id);
          }
        });
      }
    },
    daxiao() {
      let map = amapManager._map;
      map.on("zoomchange", () => {
        var zoom = map.getZoom(); //获取当前地图级别
        this.zoom = zoom;
        // console.log(this.clusters.getMarkers());
        // console.log(this.zoom);
      });
    },
    dellocalStorage() {
      localStorage.removeItem("requestMarker");
      this.cun = [];
    },

    ceshi() {
      let o = amapManager.getMap();
      // console.log(o);
      // console.log(this.markerRefs);
      let cluster = new AMap.MarkerClusterer(o, this.markerRefs, {
        gridSize: 80,
        maxZoom: 16,
      });
      this.clusters = cluster;
      this.daxiao();
      console.log(this.beiyong);
      this.init_courses();
      // console.log(this.cun);
      if (this.cun.length !== 0) {
        this.cun.map((item) => {
          this.addMarkers(item);
        });
      }
    },
    init_courses()
    {
      // axios.get('https://yantai.api.shlj.ltd/api/devices?position=').then((res) => {
      //   console.log(res);
      //   this.devices = res.data.data;
      //   // this.addDevices(res.data.data);
      // });
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
        this.addDevices(itemarr);
          // this.configurations = response.data
      });   
    },
    addDevices(device) {
      device.map((item) => {
        this.tianjia(item);
      });
    },
    tianjia(data) {
      // console.log(data);
      let marker = new AMap.Marker({
        vid: `${data.id}`,
        position: [data.position.lng, data.position.lat],
        title: `这是测试的点 ${data.id}`,
        clickable: true,
        icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADWklEQVRYR9WWWWxMYRTH/+dOZzpFI2jsZFJNSxpUQiQEnSEifZHQGYkmVFBCQpDYE2JriHgQImKJJYgOIRLxYJmpB/uD2mJfi9JF0Wp1lr/cGa2OznrvQ/lev3PO/3f/3znfdwXtvKSd9fFvA3QtbpwkVFaoLo0aKjm7DYtMsRy7h8Hc65vruVbGu2psitmYV75UGiLlRXUgbVPTfCrYoyZPGi3Y2VSELkl1URnONEzEfm8hbj1gIM6gIOfzSlOZJoBuWzzFAFfqAaDQUbMq2akJIG2Lp4SgvRkgpeZ1rBMI7L83WFocgHBt9arkzZoAuhU3PQCRrSZn9Iu/X+saiIqq35Lkkeo1yTMTBrCsp/m7yROxeeKyIhh0vXq1aVRCAAUub/7XOg5895kbExAKGyqQuuwMLibl1fFco+vvoLC+Ti/1PBEgU694aL6cOzYuafL/AVBw1XMDxEiVtic+6jKiAr2C+cKjx8aaZsTlgBrEy/Y+VFCuSz1QCG8Um9OSUBM2B/td9h/qbaoTolSxOnM1AdBtLyMxJCqAwQz4GiOGkHLEYCtJ/B5QK/rd9tMgpoStnpoO6ZsH/vgI1JQB35+HH0PBBsl1rtPkgO+KY6sIl7dpnMwiIKUH8LMK/HIfkjYCaKwCXxxtoyOU2WIrOagJgK78OYTsa50sI3aAb88Cn66G1JT0AsCQDD4L1fKRE4y2U5e1AVzJH0+RSy3JnbMgmfPA20vD252zDry/DfD9ucHFr2TI+JMvtAFcmppOg9KSLJbAwwi+jvC69p8MfHsG1D5q1vMKKlPE6vZqAyCEbnt98yjKwAVghbu1QGhdFbD24Z994qVicw6INkUx39iQUewyBJJVBL47D7y/0LYHOlnAx7uBptrg5SdwSa7TphfgNH+PogzbCNADvjwRtLrVkuwlQH05qIp/uBg8KvCwwXqqUB+Ay7Gd4LIQsYxZgCkVoB9orATM3cGqW0DlzVCoGHdAwKVodIGvcDkWEtzVJs6YCnToDfh+BiG8aquELgHmiNV5QJ8DpY48+nk+Fmi4fZ8PE40TnMHziLBiO1A6bRD9/pa5SgREkpQsGXPyqT4AV6EZqL9DBH9O410CPAQ6DhfrocgvVTw9EK+g1riYR6C1cLx57Q7wCyGPSzCh+iY7AAAAAElFTkSuQmCC',
        offset: new AMap.Pixel(-13, -30),
        events: {
        },
      });
      marker.content = "<p>设备编号：" + data.deviceno + "</p><p>地址："+ data.position.address +"</p>";
      marker.on("click", this.markerClick);
      marker.emit("click", { target: marker });
      this.clusters.addMarker(marker);
    },
    async init_position() {   
      const gisPosition = localStorage.getItem("GISInitPosition");
      // console.log('缓存 ', localStorage.getItem("GISInitPosition").length);
      // console.log(gisPosition);
      if(gisPosition == null) {
        // console.log('没有缓存');
        await axios.get('/nova-vendor/laravel-nova-configuration/getAllConfigurations')
        .then(response => {
          console.log(response);
          response.data.map(item => {
            item.key == "LOCAL_LATITUDE" ? this.beiyong.lat = item.value : '';
            item.key == "LOCAL_LONGTITUDE" ? this.beiyong.lng = item.value : '';
          });
          console.log(this.beiyong);
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
    }
  },
};
</script>

<style>
/* Scoped Styles */
</style>

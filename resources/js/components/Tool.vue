<template>

    <div>
        <div class="my-amap-page">
              <el-amap
                vid="amapDemo"  
                :center="center"
                :zoom="zoom"
                :amap-manager="amapManager"
                class="amap-demo"
                :events="events">
            <!-- <el-amap style="height:100%;width:100%;min-height: 500px;"
                     :center="center"
                     :zoom="zoom" 
                     :amap-manager="amapManager"
                     :events="events"> -->
                <!-- <el-amap-marker v-if="position.length" vid="component-marker" :position="position"></el-amap-marker> -->
                <!-- <el-amap-marker
                vid="component-marker"
                v-for="(item,index) in userList"
                :key="index"
                :position="[item.lng,item.lat]"
                :extData="item" ></el-amap-marker> -->
            <el-amap-marker v-for="(marker, index) in markers" :vid="marker.vid" :key="index" :position="marker.position" :content="marker.content" :events="marker.events"></el-amap-marker>
            <el-amap-info-window v-if="window" :position="window.position" :visible="window.visible" :offset="window.offset"  :content="window.content"></el-amap-info-window>
            </el-amap>
        </div>
    </div>
</template>
  <style>
    .amap-demo {
      height: 700px;
    }
  </style>
<script>
    import Echo from 'laravel-echo'
    import io from 'socket.io-client'
    import {AMapManager, lazyAMapApiLoaderInstance} from 'vue-amap'
    let amapManager = new AMapManager() // 新建生成地图画布

    export default {
        props: ["resource", "resourceName", "resourceId", "field"],
        data() {
        let self = this;
            return {
                cun: [],
                // center: [121.59996, 31.197646],
                markers: [],
                markerRefs: [],
                amapManager,
                zoom: 12,
                center: [],
                position: [],
                clusters: {},
                events: {
                    init(o) {
                        setTimeout(() => {
                            self.ceshi();
                        }, 1000);
                    }
                }
            };
        },
        
      created() {
        this.cun = JSON.parse(localStorage.getItem('res')) ? JSON.parse(localStorage.getItem('res')) : [];
      },
        mounted() {
            let lng = 121.436274,
                lat = 37.513546;
            setInterval(() => {
                this.dome();
            }, 200000);

            this.center = [lng, lat];
            this.position = [lng, lat];
            let that = this;

            window.io = io
            window.Echo = new Echo({
                broadcaster: 'socket.io',
                host: 'http://localhost:6001',
            });
            window.Echo.listen('test-event', '.sendLocation', (res) => {
                console.log(res);
                // console.log(this.markers);
                // console.log(this.clusters.getClustersCount());

                res.time = new Date();
                this.addMarkers(res);

                // console.log(this.clusters.getMarkers());
            })
        },

        methods: {
            markerClick(e) {
                // console.log(e);
                let map = amapManager._map;
                var infoWindow = new AMap.InfoWindow({offset: new AMap.Pixel(0, -30)});
                // console.log(infoWindow.getIsOpen());
                if (e.lnglat === undefined) return ;    //  加载点，不显示
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
                    }
                });
                marker.content = '<p>ID：' + data.id + '</p><p>名称：测试</p>';
                marker.on('click', this.markerClick);
                marker.emit('click', {target: marker});
                let a = true;
                const arr = this.cun.map((item) => {
                    if (data.id == item.id) {
                        a = false
                        return data;
                    }
                    return item;
                });
                if (a) this.cun.push(data);
                else this.cun = arr;
                // console.log(this.cun);
                this.clusters.addMarker(marker);
                localStorage.setItem('res', JSON.stringify(this.cun));
            },
            dome() {
                const markerArr = JSON.parse(localStorage.getItem('res'));
                const thisTime = new Date();
                if (markerArr) {
                    markerArr.map((item) => {
                        if (thisTime - new Date(item.time) > 300000) {
                            // console.log(item);
                            console.log(item.id + " 断开连接");
                            this.upmarkers('tj' + item.id);
                        }
                    });

                }
            },
            daxiao() {
                    let map = amapManager._map;
                    map.on('zoomchange',() => {
                        var zoom = map.getZoom(); //获取当前地图级别
                        this.zoom = zoom;
                        // console.log(this.clusters.getMarkers());
                    });
            },
            dellocalStorage() {
                localStorage.removeItem('res');
                this.cun = [];
            },

            ceshi() {
                let o = amapManager.getMap();
                // console.log(o);
                // console.log(this.markerRefs);
                let cluster = new AMap.MarkerClusterer(o, this.markerRefs,{
                    gridSize: 80,
                    maxZoom: 12,
                });
                this.clusters = cluster;
                this.daxiao();
                // console.log(this.cun);
                if (this.cun.length !== 0) {
                    this.cun.map((item) => {
                        this.addMarkers(item);
                    });
                }
            },
      }
    }
</script>

<style>
    /* Scoped Styles */
</style>

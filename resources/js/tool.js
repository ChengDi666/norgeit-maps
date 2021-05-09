import VueAMap from 'vue-amap';
const echarts = require('echarts');
import dataV from '@jiaminghi/data-view'
Nova.booting((Vue, router, store) => {

  router.addRoutes([
    {
      name: 'maps',
      path: '/maps',
      component: require('./components/tool')
    },
    // {
    //   name: 'maps3D',
    //   path: '/maps/3D',
    //   component: require('./components/3Dmap')
    // },
    {
      name: 'mapsCommunityCount',
      path: '/maps/communityCount',
      component: require('./components/staticMap')
    },
    {
      name: 'mapsUser',
      path: '/maps/user',
      component: require('./components/staticMap')
    },
    {
      name: 'mapsTruck',
      path: '/maps/truck',
      component: require('./components/staticMap')
    },
    {
      name: 'mapsSpot',
      path: '/maps/spot',
      component: require('./components/staticMap')
    },
    {
      name: 'mapsTransfer',
      path: '/maps/transfer',
      component: require('./components/staticMap')
    },
    {
      name: 'mapsDevice',
      path: '/maps/device',
      component: require('./components/staticMap')
    }
  ])
  Vue.use(VueAMap);
  Vue.use(echarts);
  Vue.use(dataV)
  Vue.prototype.$echarts = echarts
  VueAMap.initAMapApiLoader({
    key: 'eeb7e7e703b57e8d106f6f352563bd71',
    plugin: ['AMap.Scale', 'AMap.OverView', 'AMap.DistrictSearch', 'AMap.ToolBar', 'AMap.MapType', 'AMap.GltfLoader', 'Geocoder','Geolocation','MarkerClusterer', 'DragRoute'],
    uiVersion: '1.0' // 版本号
  });

 })

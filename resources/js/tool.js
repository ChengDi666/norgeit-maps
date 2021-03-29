import VueAMap from 'vue-amap';
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'maps',
      path: '/maps',
      component: require('./components/Tool')
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
    }
  ])

  Vue.use(VueAMap);
  VueAMap.initAMapApiLoader({
    key: 'eeb7e7e703b57e8d106f6f352563bd71',
    plugin: ['AMap.Scale', 'AMap.OverView', 'AMap.DistrictSearch', 'AMap.ToolBar', 'AMap.MapType','Geocoder','Geolocation','MarkerClusterer', 'DragRoute'],
    uiVersion: '1.0' // 版本号
  });

 })

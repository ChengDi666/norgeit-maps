{{--<GIS-List :lat='{{$lat}}' :lng="{{$lng}}"></GIS-List>--}}
<div @click="showMapNavList" style="user-select:none;">
{{--    <router-link tag="h3" :to="{name: 'maps', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'map'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline"--}}
{{--                >--}}
{{--        <!-- <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="var(--sidebar-icon)" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"/></svg> -->--}}
{{--        <svg class="sidebar-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1307"><path fill="var(--sidebar-icon)" d="M512.660032 64.021106c-150.943804 0-256.796644 104.943121-256.796644 255.842922 0 142.524041 38.32384 292.391327 202.794729 456.861192 32.138978 32.138978 54.001915 54.82363 54.001915 54.82363s21.868053-21.047362 55.644321-54.82363c164.469865-164.469865 199.243857-300.206316 199.243857-456.861192C767.54821 168.963203 663.570067 64.021106 512.660032 64.021106zM523.07729 731.497133c-3.324722 3.324722-6.53381 6.526647-9.619078 9.597589-3.072989-3.088338-6.268774-6.29231-9.572006-9.596566-70.794369-70.794369-119.487372-141.139507-148.862399-215.054961-24.013927-60.427254-35.198663-122.891911-35.198663-196.580191 0-56.58474 18.307971-104.706737 52.943816-139.16555 34.665521-34.487465 83.039251-52.716642 139.892097-52.716642 56.580646 0 104.537891 18.147312 138.687666 52.479235 34.175357 34.358529 52.239781 82.563414 52.239781 139.402957C703.58748 462.552821 673.39176 581.184709 523.07729 731.497133z" p-id="1308"></path><path d="M511.706311 191.942567c-70.64906 0-127.921461 57.272401-127.921461 127.921461s57.272401 127.921461 127.921461 127.921461 127.921461-57.272401 127.921461-127.921461S582.355371 191.942567 511.706311 191.942567zM511.706311 383.823736c-35.32453 0-63.960731-28.636201-63.960731-63.960731s28.636201-63.960731 63.960731-63.960731c35.32453 0 63.960731 28.636201 63.960731 63.960731S547.030841 383.823736 511.706311 383.823736z" p-id="1309"></path><path d="M959.426309 920.401504l0.004093 0.001023 0.001023-4.02671-64.443731-256.539794 0 0c-2.28095-11.498892-12.422937-20.169365-24.592095-20.169365L728.662575 639.666658c-13.848403 0-25.075095 11.226692-25.075095 25.075095l0 13.81054c0 13.848403 11.226692 25.075095 25.075095 25.075095l102.362342 0 48.095391 191.882192L144.291291 895.509581l48.095391-191.882192 102.362342 0c13.848403 0 25.075095-11.226692 25.075095-25.075095l0-13.81054c0-13.848403-11.226692-25.075095-25.075095-25.075095L153.017022 639.666658c-12.169157 0-22.311145 8.670473-24.592095 20.169365l0 0L63.981197 916.375817l0 3.332908 0.022513-0.007163c-0.010233 0.293689-0.022513 0.586354-0.022513 0.88209l0 13.81054c0 13.848403 11.226692 25.075095 25.075095 25.075095l845.299015 0c13.848403 0 25.075095-11.226692 25.075095-25.075095l0-13.81054C959.430402 920.523277 959.426309 920.462902 959.426309 920.401504z" p-id="1310"></path></svg>--}}
{{--        <span class="sidebar-label">--}}
{{--        GIS--}}
{{--    </span>--}}
{{--    </router-link>--}}
    <h3 class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
        <svg class="sidebar-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1307"><path fill="var(--sidebar-icon)" d="M512.660032 64.021106c-150.943804 0-256.796644 104.943121-256.796644 255.842922 0 142.524041 38.32384 292.391327 202.794729 456.861192 32.138978 32.138978 54.001915 54.82363 54.001915 54.82363s21.868053-21.047362 55.644321-54.82363c164.469865-164.469865 199.243857-300.206316 199.243857-456.861192C767.54821 168.963203 663.570067 64.021106 512.660032 64.021106zM523.07729 731.497133c-3.324722 3.324722-6.53381 6.526647-9.619078 9.597589-3.072989-3.088338-6.268774-6.29231-9.572006-9.596566-70.794369-70.794369-119.487372-141.139507-148.862399-215.054961-24.013927-60.427254-35.198663-122.891911-35.198663-196.580191 0-56.58474 18.307971-104.706737 52.943816-139.16555 34.665521-34.487465 83.039251-52.716642 139.892097-52.716642 56.580646 0 104.537891 18.147312 138.687666 52.479235 34.175357 34.358529 52.239781 82.563414 52.239781 139.402957C703.58748 462.552821 673.39176 581.184709 523.07729 731.497133z" p-id="1308"></path><path d="M511.706311 191.942567c-70.64906 0-127.921461 57.272401-127.921461 127.921461s57.272401 127.921461 127.921461 127.921461 127.921461-57.272401 127.921461-127.921461S582.355371 191.942567 511.706311 191.942567zM511.706311 383.823736c-35.32453 0-63.960731-28.636201-63.960731-63.960731s28.636201-63.960731 63.960731-63.960731c35.32453 0 63.960731 28.636201 63.960731 63.960731S547.030841 383.823736 511.706311 383.823736z" p-id="1309"></path><path d="M959.426309 920.401504l0.004093 0.001023 0.001023-4.02671-64.443731-256.539794 0 0c-2.28095-11.498892-12.422937-20.169365-24.592095-20.169365L728.662575 639.666658c-13.848403 0-25.075095 11.226692-25.075095 25.075095l0 13.81054c0 13.848403 11.226692 25.075095 25.075095 25.075095l102.362342 0 48.095391 191.882192L144.291291 895.509581l48.095391-191.882192 102.362342 0c13.848403 0 25.075095-11.226692 25.075095-25.075095l0-13.81054c0-13.848403-11.226692-25.075095-25.075095-25.075095L153.017022 639.666658c-12.169157 0-22.311145 8.670473-24.592095 20.169365l0 0L63.981197 916.375817l0 3.332908 0.022513-0.007163c-0.010233 0.293689-0.022513 0.586354-0.022513 0.88209l0 13.81054c0 13.848403 11.226692 25.075095 25.075095 25.075095l845.299015 0c13.848403 0 25.075095-11.226692 25.075095-25.075095l0-13.81054C959.430402 920.523277 959.426309 920.462902 959.426309 920.401504z" p-id="1310"></path></svg>
        <span class="sidebar-label flex flex-1 items-center">
            地图监管
        </span>
        <svg id="gisMapListHide" style="margin-right: 0; width: 1rem; height:1rem; display: none;" t="1602317232981" class="sidebar-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8364">
            <path d="M275.2 6.4c6.4 0 19.2 0 25.6 6.4l473.6 473.6c6.4 6.4 6.4 12.8 6.4 25.6 0 6.4-6.4 19.2-6.4 25.6l-473.6 473.6c-12.8 12.8-32 12.8-44.8 0-12.8-12.8-12.8-32 0-44.8L704 512 256 64C243.2 51.2 243.2 32 256 19.2c0-12.8 12.8-12.8 19.2-12.8z" fill="var(--sidebar-icon)" p-id="8365">
            </path>
        </svg>

        <svg id="gisMapListShow" style="margin-right: 0; width: 1rem; height:1rem;" t="1602317859146" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8509">
            <path d="M512 680.521143l-374.491429-411.794286a36.571429 36.571429 0 0 0-55.588571 47.616l404.918857 447.268572a36.571429 36.571429 0 0 0 57.563429-2.56l399.652571-447.195429a36.571429 36.571429 0 1 0-59.538286-42.569143L512 680.521143z" fill="var(--sidebar-icon)" p-id="8510">
            </path>
        </svg>
    </h3>
</div>
<div id="showMapListID" style="user-select:none;">
    <router-link tag="p" :to="{name: 'maps', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'map'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-4 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">监控轨迹</span>
    </router-link>
    <router-link tag="p" :to="{name: 'mapsUser', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'user'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-4 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">作业人员</span>
    </router-link>
    <router-link tag="p" :to="{name: 'mapsDevice', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'device'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-4 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">设备</span>
    </router-link>
    <router-link tag="p" :to="{name: 'mapsTruck', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'truck'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-4 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">作业车</span>
    </router-link>
    <router-link tag="p" :to="{name: 'mapsSpot', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'spot'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-4 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">收集站</span>
    </router-link>
    <router-link tag="p" :to="{name: 'mapsTransfer', params: { lat: '{{$lat}}', lng: '{{$lng}}', type: 'transfer'}}" class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
        <span class="sidebar-icon"></span>
        <span class="sidebar-label text-sm">中转站</span>
    </router-link>
</div>

<script>
    this.showMapList = true
    this.showMapNavList = () => {
        this.showMapList = !this.showMapList
        const gisMapListHide = document.getElementById('gisMapListHide')
        const gisMapListShow = document.getElementById('gisMapListShow')
        const showMapList = document.getElementById('showMapListID')
        if(this.showMapList) {
            showMapList.style.display = 'block'
            gisMapListShow.style.display = 'block'
            gisMapListHide.style.display = 'none'
        } else {
            showMapList.style.display = 'none'
            gisMapListShow.style.display = 'none'
            gisMapListHide.style.display = 'block'
        }
    }
</script>
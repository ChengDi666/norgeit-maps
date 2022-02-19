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
        <div class="satellite">
          <div class="layer_item" @click="showSelect($event, 'xianshi')"  v-bind:class="{'item_active': (statusRecord.types == 'xianshi' && statusRecord.isshowSelect)}" style="line-height: 18px;">
            显示
          </div>
        </div>
      </div>
      <div class="settings"  v-show="(statusRecord.isshowSelect)" style="background: #fff;padding: 10px;box-shadow: 0 0 5px #aaa;border-radius: 3px;font-size: 14px;line-height: 2rem;">
        <div v-if="statusRecord.types == 'xianshi'">
          <div style="display: flex;flex-flow: row wrap;justify-content: space-between;width: 200px;">
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="spots"  @click="showChecked($event)" :checked='statusRecord.spots' /> 收集点 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="transfers"  @click="showChecked($event)" :checked='statusRecord.transfers' /> 中转站 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="community"  @click="showChecked($event)" :checked='statusRecord.community' /> 小区 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="devices"  @click="showChecked($event)" :checked='statusRecord.devices' /> 投放点 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="users" @click="showChecked($event)" :checked='statusRecord.users' /> 作业人员 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="trucks"  @click="showChecked($event)" :checked='statusRecord.trucks' /> 作业车辆 </label>
          </div>
        </div>
        <div v-else-if="statusRecord.types == 'satellite'">
          <div style="display: flex;flex-flow: row wrap;justify-content: space-between;width: 200px;">
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="satellite" @click="showChecked($event)" :checked='statusRecord.satellite' /> 卫星地图 </label>
            <label style="padding: 0 5px;width: 6rem;cursor: pointer;"> <input type="checkbox" value="roadNet" @click="showChecked($event)" :checked='statusRecord.roadNet' /> 路网 </label>
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
      userMessage: [],
      beiyong: {lat: "32.059358",lng: "118.796628"},
      amapManager,
      zoom: 12,
      center: [],
      position: [],
      values: {},
      layers: [],
      trucks: [],   //  所有车辆
      iconList: {
        //  车辆图标
        truck: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAFFElEQVRoQ+2YDUwbZRjH/+/RD9oCpZQPB2MbH8sSNBo/UBeNsBHFsZFYgambEpiJmUM348dQxxjIlrlpsgwVNTqdi1M3cM4s2rkAss1oohuZxhEdRkRHEZOuUGgLLb3X3LGWWq7cweEGSS8hzeV5nv/9f89zL/feEczxg8xx/wgDXO0JhicQnoDMDoRvIZkNlF0enoDsFsoUkDyB0Y2mwwBKXEMuOB0uGJPi4HF7YLcNIsYQDaVKCWvfJWh1GmiiNLDb7PC4R/k8X40vT9wzbVDUH60Qz4O0J7HPvE9w2DWCSI2aP+XMcYa5wz3sBhPBQKFUwDvq5f9UkSo+NuIagfpyTaAxClobbJQCx1T1R8/OCECweSmiU8lR1H8m+S4Q0p20+P82zxnqqD7oDTbWOeApLcrQfySlESEBpmrevXAJCAWUf/4q5br+nLbNBzDkYfnzFJ0SWdEKdNg9A9lJulgpQoIAUsyz6Vlwp2UBhPC/o8mL+OspLH9A1dUBUMr/Mr93TOpjTXEDeqyD0GrU0GojsT5Nh7viVTjR4yg3ZRr2i0FMAJBinl+Uuw6JafNxdeUDUwJIUDPYe70eHXZ3f3ZSlEHsIhMBnjR9DYJcsUJqSICt4mUgghFOpYBh77MgA9YpAXDJvim09g4+VphufGcygWkDcKLWJ3bBqzcK6jODNsTXPyfWBwTfQlyBfwoD7oHsa6ImXQuyAGxlL8KTki5oUmnpguH9HaIAlWvfxAWbC9GqCKTpI/35q5K10CsZdA8NV6xYFNcQSkgWwEDxBowsuUlQW33hHPSNr4sC/LPlXdEcQshrqghaZTQa7cHJsgAG89fCdcsyQQOa9jZEmz8UNScFwCdCWbY2ZV5CTaCoLADHHSvhyDUJmtSd+hy608dmN8DwDXfCvqpM0GT0Fx9Ac+707AZwZ1yH/gefEjQZe6geqt9+mt0AnDt+DZCgZwGl0JxpFTXPJVzVNSDJoUjSFQcYpUC/F4hXzIT9KziBvz3Ae1YGp4YIKIBEBVCoZ7HawJ2NHfusDL51EFx0A4vVFDlRFCUBcSFkbgI2Wz8OHPwEXV3dcDidWJA6H3fn5eL227L/UzLtf6MuFtjwVwQsnokWOIBHjSxKuyPQJxAviKHYlDi2XRY6fnn8FWx65nnBWFnpGuQty/HHpg3wsY1gvzXEpg3A5iQWu/tCx2vmsViqG59UoNs9Gfk4/lVzSMC339gDrVbLx6cN8IKFQbtz7JmXmZGGh1YXoW7nq/6LroihMNvHn4k7XtqKLdV1/vj6eBamWGGAda5U9PRY+FxOl9MP1N5eW4WFC1LlATx9kbl0fpjEhQLIiWItJ4eYZJ/jYIBH4mjnwwa2R6jN5c75N1t6e6NDAVRXVf6wODPDwU/A6z055a0E99Xg3k7FIAjGWx7khDLs/YRljoS6DyhFfqu56YRQfHlBcQ0BtgnWEpx3akn2d42NrlDaE/ZC3o33bWMDPrco64/WoKaGyfv+5zMAbpwgRFHdYm6qy1tZvA8U64LjFGx565dHQr4aFhYWap1e9TfC2uTaFnPjpO+kkj9p5OeXxHkYdjsIKSZAAghpJyz7VrP5U/8b0/KCop0EhNvdLSHAWUpxuMXctDvkCr0cuMdkSvSOKBpA2VtBSCwIfiRebG0+3tQmVisZIFBoaUmJZrKxil10JuPTAphJA3K1wgByOyi3PjwBuR2UWx+egNwOyq0PT0BuB+XWz/kJ/AuWtRhPbVcMgQAAAABJRU5ErkJggg==',
        //  清运点图标
        spots: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAjRQTFRFAAAAEpbbEpbbEpbbEZXaEZTXEpbbEpbbEpbbEpXaEZPYEpXaEpbaEpXaEpbaEpbbEpXbEZPYEpXZEZXaEpbbEpbaEZbbEpbaEpbbEpbbEZXbEpXZEpXZEpbbEpXZEpbbEZXaEZbaEJXbEpXaEpXaEZXbEZbbEZXaEpXaEZbZEZXaEZTaEZXaEJPXEpbbEpbaAICAEpXaEpbaEpbbEZTaEpbaEpLWEYrKD4C7ClN6AAAAAAAAEpbaEpXZEY3ODW+iCU90BjJIAQoPAAAAAAAAAAAAEpbbEIbFClV8Ag4UAAICAAAAAAAAAAAAAAAAAAAAEpPXC1iBAxYgAQcLAxsoAx0qAAAAAAAAAAAAAAAAAAAAEpXaEpbbBB8tAAIDAxUfC1+KDn65AAAAAAAAAAAAAAAAEZXbEpbbD3+5AhMcAxsnDnKmEJXaAAAAAAAAAAAAAAAAEZbbEpbbEpTYEIXDAhYgAAABAxUeC1qDC1d+AAAAAAAAAAAAAAAAAAAAEpXZEpbbEZHTBSs+AAUHAQYJAx0qAg0UAAAAAAAAAAAAAAAAEJXaEpbbClR6AAAAAAAADZTbEpbbEpbaD322BzlTAAAAAAAAAAAAAAAAEI/PEpbaEpPWDnetBCExAQYIAAAAAAAAAAAAEZXaEIrJCVB1AhMcAAAAAAAAAAAAAAAAEZXaEZHUDnivCEZnBB8tAAAAAAAAAAAAAAAAEJTbEpbbEYzNC2CLBSxAAhQdAAAAAAAAAAAACZDskwAAALx0Uk5TAG2ZeyAl+//9eA2S1aq48doaFFLVh0Bj4+qEHDP4VcZVORxuppPgcrVXkjZmG/lPAUDr3jTM///VOwoBs//////ollEfBJT//////++lKwP//////+TD6vWIHVz+/////5A0t99QTPb/////bhakaAg85v///////3FEuexcBS7Y///////JwOnOPh3H//mQEbv////90kUGBKb/////12wMh////P7zlzBq////8diWVBAfVVhqipCViT89xI8DAAABcklEQVR4nGNgIA4wMqECZhZUeVY2dlTAwYkiz8UNEebh5eXl4wczBQQR0kLCIlB9omJiYuISELaklDRMgQxMnl1WUlKSH26NHFyBvCRWoAC3QlEMK1BCcqUyLzpQQfWmKjs6UENVoI6hQANVgSaGAi1UBdoYCnRQFeiiy+vpoyow4EBTIGmIqoDBCE2BsQmaAlMUaTNzC0sraxQFNkjStnb2Do5Ozi6uyArckBS4e3h6eXv7+Pr5IylgRsgHBAYFh4SGhUdERiEpiI6BW2AeGxefkJiU7J2SimRJWjrcgIxM76zsnNw8b5/8AoSCwiKYguKS0rLyisqqau+a2jqEgvoGuBsam5pbWtvaO7w7u5B82t0DV1Dcm+kNAn39LkiOnDARrmDS5ClxQPmp06bPQFIwcxbCn7PnzJ3nPXX+goUoQbkIKSQXL1m6bPmKlSghybAKoWD1mrXrfNZv2LgJRcHmLXCwddv2HTt35e9GtYJ8AAD0qmL/+sUz4AAAAABJRU5ErkJggg==',
        //  转运站图标
        transfers: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAS9QTFRFAAAAEpjcEpbaEpbaE5fbE5fcEpbcEpbbEpbbEpbbEZbbEJXaEpbbEpbbEpbbEpbbEpbbEZbaEpXbEpbbEpbbEpbbEpbbEpbbE5fcEpbbEpbbEpbbE5baEpXaE5bcEpbbEpbbD5bhEpXaEpXbEZbbEpbcEpXbEpbbEpbbEpfaFZjdEpfbEpbbEpbbEpbbE5bcEpXZEpbbEpbbEpTbEpbbEZXbEpjeEJPcEpXaE5XbEpbbEpbbEpfbEpbcE5bZEpbbEpbbEpbbEpbbEZbbEZbbEZbbEpbbEpbbEpbbEpbbEpbcE5bdEpbbEpbbEpbbEpbbEpbbEpbbEpbbEpbbEpfbEpfaEpbcEpbaEZbbEpbbEZbbEpbaEZbaEpbbEpbbEpfbEZbbEpbbEZXbFJfcEpXc3LoIBAAAAGV0Uk5TABmEhigksvX5zzULY+T/7YQUFpLv+KUgB0TS5VsMd+iPCDm8x0pT3ONcCCOr/LUiH7GgDp9FHBI1iuHiSAsJRtjZMiqz56ZDcuyTCC/LaAlMoevNLAmYdkHgrjA0291LSY06GkP2V+noAAAA+UlEQVR4nGNgoDJgZGJmwSfPysbOwcmFU5qbh5cPCPgFBLHLCwmL8IGBqJg4FmkJSSk+OJCWkcVQICfPhwT4FRRRpZWU+dCAiiqyvJo6ujwfn4amFkxaWwdTGgh09fQh8gaGWOWBwMgYbgdEgNfE1MzcwtIKwkNxJFjE2sYWxLazd8CuwNGJwdnFVd3N3cMTuwIvbx9fcBiIYrXC04+Bwd8P2YnoJngGMPhBzOYL9MRqhWcgRBpoVoAnVl9AgZ8/A9gsLAo4gkBkcEhoGPZw4A+PEIt0jYpmiInFriAu3g7Etk3QwBGSfNaJSebJKSa8uIIaDdBbwYACABH+LOwMrvOZAAAAAElFTkSuQmCC',
        //  用户图标
        user: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAClklEQVRYR+2WQWjTUBjH/1+2JN3JXSamFRxDStohCnOiIOhQUHSiIoooKIha8DTcwZNQT14G4k2nXvQgeHCiB72ovXlRQXFNO3Zbm+4gO7jD2qTLJ8lWqO3SvBFLUZZTePm/7/973/e990Lo8EMd9sdfAYhWkndBfBbAZhC+OVW+Pd+Ty4gsLjRA1Eo8AXCl0cyRpcF5ms4GQYQC0MqDR0ly3vqYTEvy4nCBCkutIMIBWMkJAo/7GUjs7Cyo+e//MUDrEsxI8uKutpbATW3UTr4D85E/0kz4SaDzRTn7vq1NWAuuVZIXQXyVCHECXvCy88CM5PNB5u73UE0oYhCkaQKI2okpME41TLxmKsZjd2wbJzTb4hSIRgEMBRkAWCBgloFHtRj1c5oAtHJijCTcqxd1MXbMqcaPAR7YVLZVt64ixs1szHdMNZcOAGg+XEzF8EBjVvIhg68LrNpX4izzSP0x3VyCSlwHdRl1Eb6YirFbs/QhAn0OY+41HeF+UTbGanGaAPq5P2LZPSUAvStdSpNFJZvSLH2CQL6nnjAY8WtTzp30BfD2tpX4BGCv+87gVEnJTUZtfQ5MW4WNfIQMZEqKMdISoHFurKqPskNv6ibdcIBzBBwMBCJOg3EAIM80EGALb+9DuXuwPrDULd0E84naWESu9C7Z6itxANoP4HAgQKysj7NEtwD0+a+MP5hK7pBmJT4KAzjSPtDKcd0yAyJBCbhcVIynIlpvEcRpdmgPEY4FAgRlgIBnRcW45AZaDwBAw2AcDwRwBWv1gDtuRapfF2j2V600bQMI7OpVwQbARgb+rQywFAf4wupt+LIoG2fWdRestTPcDIjsGCLOwMEMJDrt6R2eMtXc89AAIuYimo7/lP4Gi1g0MPX9g/AAAAAASUVORK5CYII=',
        // 投放点
        devices: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADWklEQVRYR9WWWWxMYRTH/+dOZzpFI2jsZFJNSxpUQiQEnSEifZHQGYkmVFBCQpDYE2JriHgQImKJJYgOIRLxYJmpB/uD2mJfi9JF0Wp1lr/cGa2OznrvQ/lev3PO/3f/3znfdwXtvKSd9fFvA3QtbpwkVFaoLo0aKjm7DYtMsRy7h8Hc65vruVbGu2psitmYV75UGiLlRXUgbVPTfCrYoyZPGi3Y2VSELkl1URnONEzEfm8hbj1gIM6gIOfzSlOZJoBuWzzFAFfqAaDQUbMq2akJIG2Lp4SgvRkgpeZ1rBMI7L83WFocgHBt9arkzZoAuhU3PQCRrSZn9Iu/X+saiIqq35Lkkeo1yTMTBrCsp/m7yROxeeKyIhh0vXq1aVRCAAUub/7XOg5895kbExAKGyqQuuwMLibl1fFco+vvoLC+Ti/1PBEgU694aL6cOzYuafL/AVBw1XMDxEiVtic+6jKiAr2C+cKjx8aaZsTlgBrEy/Y+VFCuSz1QCG8Um9OSUBM2B/td9h/qbaoTolSxOnM1AdBtLyMxJCqAwQz4GiOGkHLEYCtJ/B5QK/rd9tMgpoStnpoO6ZsH/vgI1JQB35+HH0PBBsl1rtPkgO+KY6sIl7dpnMwiIKUH8LMK/HIfkjYCaKwCXxxtoyOU2WIrOagJgK78OYTsa50sI3aAb88Cn66G1JT0AsCQDD4L1fKRE4y2U5e1AVzJH0+RSy3JnbMgmfPA20vD252zDry/DfD9ucHFr2TI+JMvtAFcmppOg9KSLJbAwwi+jvC69p8MfHsG1D5q1vMKKlPE6vZqAyCEbnt98yjKwAVghbu1QGhdFbD24Z994qVicw6INkUx39iQUewyBJJVBL47D7y/0LYHOlnAx7uBptrg5SdwSa7TphfgNH+PogzbCNADvjwRtLrVkuwlQH05qIp/uBg8KvCwwXqqUB+Ay7Gd4LIQsYxZgCkVoB9orATM3cGqW0DlzVCoGHdAwKVodIGvcDkWEtzVJs6YCnToDfh+BiG8aquELgHmiNV5QJ8DpY48+nk+Fmi4fZ8PE40TnMHziLBiO1A6bRD9/pa5SgREkpQsGXPyqT4AV6EZqL9DBH9O410CPAQ6DhfrocgvVTw9EK+g1riYR6C1cLx57Q7wCyGPSzCh+iY7AAAAAElFTkSuQmCC',
        // 小区
        community: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAA+0lEQVRYR+2WwQ2CMBSG/4cLmM5AJ9C7OITcPdop3MHIEDKEDqADmF4cwNQRMD2QVEPgkbaBQ3shgZfXj+/9SUuYeNHE+2OeAKLSdwCrATu1UbL0NdhpQFS64TQ2SnobnDdABlq/Vf5wbSxPusgWuNp30Q1MDjCUg9aAT2iDZMAntL0A3BFEAwBQGiVrdxSi0jsAFzeEDgCr3u0XdARcY9EAuKEdA8BSGi0DXKUpA9FGwA1VAkgGghkQ5+exoWxDQDEUQPu9AW72OaaeiF7mkO/b/j9nAfdPOHB9Ne5N6h/AnnL2tIu2rLWPkttOA9F27Wnsfa32hU4AycAXi2DUIUyrJxgAAAAASUVORK5CYII=',
      },
      statusRecord: {
        isshowSelect: true, // 显示选择界面
        types: "xianshi", // 展开菜单的类
        spots: true,  // 显示清运点
        transfers: true,  // 显示转运站
        community: true,  // 显示小区
        devices: true,  // 显示投放点
        users: true,  // 显示人员
        trucks: true,  // 显示车辆
      },
      client: {},
      infoWindows: {},
      fullscreen:false,
      myMap: {},
      markerList: [],
      clearMarkers: [],
      truckList: [],
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
        }
      },
    };
  },
  created() {
    this.userMessage = JSON.parse(localStorage.getItem("requestMarker")) ? JSON.parse(localStorage.getItem("requestMarker")) : [];
    this.values = JSON.parse(localStorage.getItem("GISInitPosition")) ? JSON.parse(localStorage.getItem("GISInitPosition")) : {};
    this.statusRecord = JSON.parse(localStorage.getItem('statusRecord')) ? JSON.parse(localStorage.getItem('statusRecord')) : this.statusRecord;
  },
  mounted() {
    setInterval(() => { this.regularCheck(); }, 60000); //  一分钟检测一次
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
      localStorage.setItem("GISInitPosition", JSON.stringify(this.values));
    }
    let lng = this.values.lng, lat = this.values.lat;
    this.center = [lng, lat];
    this.position = [lng, lat];
    this.markerList['trucks'] = []
    this.markerList['users'] = []
    this.getData(`/api/trucks?lastPosition=true`).then(res => {
      if (res.status == 200 && res.data && res.data.data) this.truckList = res.data.data
    })
    this.init_mqtt()
  },
  methods: {
    addMarker (icon, lat, lng, url, content, text, id) {
      AMapUI.loadUI(['overlay/AwesomeMarker'], (AwesomeMarker) => {
        // eslint-disable-next-line no-new
        const marker = new AwesomeMarker({
          awesomeIcon: icon, // 可用的icons参见： http://fontawesome.io/icons/
          containerClassNames: 'my_icons',
          iconLabel: {
            style: {
              color: '#333', // 设置颜色
              fontSize: '18px'
            }
          },
          iconStyle: 'blue', // 设置图标样式  #3CA0C8
          position: [lng, lat],
          extData: { id: id, text }
        })
        marker.myContent = content;
        marker.on("mouseover", this.infoWindowOpen);
        marker.emit("mouseover", { target: marker});
        marker.on("mouseout", this.infoWindowClose);
        marker.emit("mouseout", { target: marker});
        marker.on("dblclick", () => { //  左双击跳转
          window.location.href = `/resources/${url}`
        });
        if (text === 'users' || text === 'trucks') { // 处理设置为隐藏
          this.markerList[text].push(marker)
        }
        marker.setMap(this.myMap);
        if (text === 'users') return // 不添加到清除
        this.clearMarkers.push(marker)
      })
    },
    init_mqtt () { // mqtt
      const url = document.location.protocol == 'http:' ? 'ws://iot.norgeit.com:8083/mqtt' : 'wss://iot.norgeit.com:8084/mqtt'
      let mqttName = 'getTruckGPS'
      let type = 'App\\Models\\Truck'
      this.client = mqtt.connect(url, {
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
      if (data.subject_type === 'App\\Models\\User') {
        this.getData(`/api/users?user_id=${data.subject_id}`).then(res => {
          if (!res.data.data || res.data.data.length === 0) return
          let userMes = res.data.data[0]
          userMes.position = data.position
          this.updateMarker(userMes, 'users')
        })
        return
      }
      if (data.subject_type === 'App\\Models\\Truck') {
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
      for (const key in this.markerList[type]) { // 是否存在点
        const element = this.markerList[type][key]
        if (element.Ce.extData.text === text) {
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
      //绑定地图移动与缩放事件
      this.myMap.on('moveend', this.mapZoom);
      this.myMap.setZoom([7,18]);
      this.mapZoom();
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
      if (!this.statusRecord.users) this.myMap.remove(this.markerList['users']) // 隐藏-移除人员
      else this.myMap.add(this.markerList['users']) // 显示-添加人员
      localStorage.setItem('statusRecord', JSON.stringify(this.statusRecord));
      const zoom = this.myMap.getZoom();
      this.detailMarker(this.currentData)
    },
    regularCheck() {  //  判断有效期
      const markerArr = JSON.parse(localStorage.getItem("requestMarker"));
      const thisTime = new Date();
      if (markerArr) {
        markerArr.map((item) => {
          if (thisTime - new Date(item.time) > 300000) {
            console.log("user_" + item.id + " 连接超时");
            this.delCache(item.id);
          }
        });
      }
    },
    delCache(id) {  //  清除指定缓存和存储数组
      this.userMessage.forEach((element, index) => { //  删除数组 和缓存 里的点信息
        if(id === element.id) {
          // console.log('删除的数据');
          this.userMessage.splice(index, 1)
          localStorage.setItem("requestMarker", JSON.stringify(this.userMessage));
        }
      });
    },
    mapZoom() { // 地图缩放
      const zoom = this.myMap.getZoom();
      const bounds = this.myMap.getBounds();
      // console.log('东北(右上)角： ', bounds.northeast)
      // console.log('西南(左下)角： ', bounds.southwest)
      this.getData(`/api/addresses/search?northeast={"lat": ${bounds.northeast.lat}, "lng": ${bounds.northeast.lng}}&southwest={"lat": ${bounds.southwest.lat}, "lng": ${bounds.southwest.lng}}&level=${zoom}`)
        .then(res => {
          // console.log(res)
          this.currentData = res.data;
          this.detailMarker(res.data)
      });
    },
    detailMarker(data) {
      this.myMap.remove(this.clearMarkers) // 清除原覆盖物
      this.clearMarkers = []
      if(this.statusRecord.devices) this.manageData(data.devices, 'devices'); // 显示投放点
      if(this.statusRecord.spots) this.manageData(data.spots, 'spots'); // 显示清运点
      if(this.statusRecord.transfers) this.manageData(data.transfers, 'transfers'); // 显示转运站
      if(this.statusRecord.community) this.manageData(data.communities, 'addresses'); // 显示小区
      if(this.statusRecord.users) this.manageData(data.users, 'users'); // 显示人员
      if(this.statusRecord.trucks && this.truckList.length) this.manageData(this.truckList, 'trucks'); // 显示车辆
    },
    async manageData(data, text) { // 信息分类 添加点
      if (!data) return
      for (let i = 0; i < data.length; i++) {
        const item = data[i];
        const url = `${text}/${item.id}`;
        let content, icon;
        if(text == 'addresses') {
          content = `<p>小区：${item.name}</p>`
          icon = this.iconList.community
          icon = 'building'
        }
        else if(text == 'devices') {
          content = `<p>投放点编号：${item.deviceno}</p><p>备注：${item.memo}</p>`
          icon = this.iconList['devices']
          icon = 'trash'
        }
        else if(text == 'spots') {
          content = `<p>名称：${item.name}</p>`
          icon = this.iconList['spots']
          icon = 'home'
        }
        else if(text == 'transfers') {
          content = `<p>名称：${item.name}</p>`
          icon = this.iconList['transfers']
          icon = 'exchange'
        } else if (text === 'users') {
          content = `<p>名称：${item.name}</p>`
          icon = 'user'
        } else if (text === 'trucks') {
          content = `<p>车辆：${item.licenseNO}</p>`
          if (item.lastPosition || item.lastPosition.length) item.position = item.lastPosition
          icon = 'truck'
        }
        if(!item.position || !item.position.lat) continue
        this.addMarker(icon, item.position.lat, item.position.lng, url, content, text, item.id)
      }
    },
    infoWindowTable(data) { // 返回 统计显示 html
      let content = '<div class="myInfoWindowTable">'
      for (let i = 0; i < data.details.length; i ++) {
        const item = data.details[i];
        content += `<span>${item.name} : ${item.amount % 1 === 0 ? item.amount : (item.amount).toFixed(2)} ${item.type}</span>`
        // content += `<span>${item.name} : ${parseInt(item.amount).toFixed(2)} ${item.type}</span>`
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
          offset: new AMap.Pixel(10, 10),
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
          content += table
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
    getCurrentPositions (panToLocation) { // 定位
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
    checkFull () { //判断浏览器是否处于全屏状态 （需要考虑兼容问题）
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
    screen () {
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

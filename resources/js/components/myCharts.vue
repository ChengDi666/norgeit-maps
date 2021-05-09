<template>
  <div class="chartsComposer" style="position: absolute;top: 0;width: 100%;">
    <div class="dataTop" style="position: absolute;top: 10px; width: 100%; text-align: center;">
      <h2 style="color: #fff;" :style="{color: themes ? '#fff' : '#000'}">生活垃圾分类监管平台</h2>
      <dv-decoration-5 style="height:70px;position: absolute;top: 0;" />
    </div>

    <div class="dataLeft" style="position: absolute;top: 100px;left: 10px;width: 25%;">
      <div class="biankuang" style="width: 100%;height: calc(20vh);margin-bottom: 10px;">
        <dv-border-box-10>
          <div id="myChart" :style="{width: '90%', height: '90%', top: '5%', left: '5%'}"></div>
        </dv-border-box-10>
      </div>
      <div class="biankuang" style="width: 100%;height: calc(25vh);margin-bottom: 10px;">
        <dv-border-box-10>
          <div id="myChart1" :style="{width: '100%', height: '90%', top: '5%', position: 'relative'}"></div>
        </dv-border-box-10>
      </div>
      <div class="biankuang" style="width: 100%;height: calc(25vh);margin-bottom: 10px;">
        <div id="myChart2" :style="{width: '100%', height: '90%', top: '5%'}"></div>
      </div>
    </div>

<!--    <div class="dataLeft" style="position: absolute;top: 100px;left: 10px;width: 25%;">-->
<!--      <div class="biankuang" style="width: 100%;height: calc(20vh);margin-bottom: 10px;">-->
<!--        <dv-border-box-1>-->
<!--          <div id="myChart" :style="{width: '90%', height: '90%', top: '5%', left: '5%'}"></div>-->
<!--        </dv-border-box-1>-->
<!--      </div>-->
<!--      <div class="biankuang" style="width: 100%;height: calc(25vh);margin-bottom: 10px;">-->
<!--        <dv-border-box-2>-->
<!--          <div id="myChart1" :style="{width: '100%', height: '90%', top: '5%', position: 'relative'}"></div>-->
<!--        </dv-border-box-2>-->
<!--      </div>-->
<!--      <div class="biankuang" style="width: 100%;height: calc(25vh);margin-bottom: 10px;">-->
<!--        <div id="myChart2" :style="{width: '100%', height: '90%', top: '5%'}"></div>-->
<!--      </div>-->
<!--    </div>-->

    <div class="dataRight" style="position: absolute;top: 100px;right: 10px;width: 25%;">
      <div class="biankuang" style="width: 100%;height: calc(25vh);margin-bottom: 10px;">
        <dv-border-box-8>
          <div id="myChart3" :style="{width: '100%', height: '90%', top: '5%'}"></div>
        </dv-border-box-8>
      </div>
      <dv-border-box-11 v-if="config.data.length" title="今日投放" style="padding: 65px 25px 25px;" >
        <dv-scroll-board :config="config" :headerBGC="'#1f33a24d'" style="height:220px;" />
      </dv-border-box-11>
      <button style="color: #fff;" @click="showBorder">选择边框</button>
    </div>
    <div v-if="borders" class="dataContent" style="position: absolute;top: 100px;left: 30%;width: 20%;">
      <dv-border-box-3 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-3</dv-border-box-3>
      <dv-border-box-4 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-4</dv-border-box-4>
      <dv-border-box-4 style="height: 150px;margin: 0 10px 10px 0;" :reverse="true">dv-border-box-4</dv-border-box-4>
      <dv-border-box-5 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-5</dv-border-box-5>
      <dv-border-box-5 style="height: 150px;margin: 0 10px 10px 0;" :reverse="true">dv-border-box-5</dv-border-box-5>
    </div>
    <div v-if="borders" class="dataContent" style="position: absolute;top: 100px;left: 50%;width: 20%;">
      <dv-border-box-6 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-6</dv-border-box-6>
      <dv-border-box-7 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-7</dv-border-box-7>
      <dv-border-box-9 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-9</dv-border-box-9>
      <dv-border-box-10 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-10</dv-border-box-10>
      <dv-border-box-12 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-12</dv-border-box-12>
      <dv-border-box-13 style="height: 150px;margin: 0 10px 10px 0;">dv-border-box-13</dv-border-box-13>
    </div>
  </div>
</template>
<script>

export default {
  name: 'myCharts',
  props: [
      'myData',
      'hlDate'
  ],
  data() {
    return {
      xiaoqu: [],
      MeshesList: [],
      textInfo: null,
      object3Dlayer: null,
      config: {
        header: ['id', 'fullname'],
        data: [
          ['行1列1', '行1列2', '行1列3'],
        ],
        columnWidth: [80],
        align: ['center']
      },
      borders: false,
      themes: null, // dark

    };
  },
  created() {
    console.log('myData', this.myData);
    console.log('hlDate', this.hlDate);
    this.config = this.myData
  },
  mounted() {
    this.drawLine();
    this.myChart1();
    this.myChart2();
    this.myChart3();
  },

  methods: {
    showBorder() {
      this.borders = !this.borders
    },
    drawLine(){
      // 基于准备好的dom，初始化echarts实例
      let myChart = this.$echarts.init(document.getElementById('myChart'), this.themes)
      // 绘制图表
      myChart.setOption({
        title: {
          text: '本月分类统计',
          left: 'center'
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {            // 坐标轴指示器，坐标轴触发有效
            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
          }
        },
        backgroundColor: 'rgba(0, 0, 0, 0.0)',
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        xAxis: {
          data: ["可回收","有害","厨余","其他"],
          axisTick: {
            alignWithLabel: true
          }
        },
        yAxis: {
          type: 'value'
        },
        series: [{
          name: '本月分类统计',
          type: 'bar',
          barWidth: '60%',
          data: [500, 120, 3000, 210]
        }]
      });
    },
    myChart1() {
      let myChart1 = this.$echarts.init(document.getElementById('myChart1'), this.themes)
      // 绘制图表
      myChart1.setOption({
        tooltip: {},
        legend: {
          left: 5,
          data: ['本周', '上周']
        },
        backgroundColor: 'rgba(0, 0, 0, 0.0)',
        radar: {
          // shape: 'circle',
          name: {
            textStyle: {
              color: '#fff',
              backgroundColor: '#999',
              borderRadius: 3,
              padding: [3, 5]
            }
          },
          indicator: [
            { name: '可回收', max: 650},
            { name: '有害', max: 16},
            { name: '厨余', max: 5200},
            { name: '其他', max: 25}
          ]
        },
        series: [{
          name: '本周 vs 上周',
          type: 'radar',
          // areaStyle: {normal: {}},
          data: [
            {
              value: [430, 10, 5000, 19],
              name: '本周'
            },
            {
              value: [500, 14, 4200, 20],
              name: '上周'
            }
          ]
        }]
      })
    },
    myChart2() {
      let myChart2 = this.$echarts.init(document.getElementById('myChart2'), this.themes)
      // 绘制图表
      myChart2.setOption({
        title: {
          text: '垃圾分类环形图',
          left: 'center',
          top: 'bottom'
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b}: {c} ({d}%)'
        },
        legend: {
          top: '2%',
          left: 'center'
        },
        backgroundColor: 'rgba(0, 0, 0, 0.0)',
        series: [
          {
            name: '垃圾回收比例',
            type: 'pie',
            radius: ['40%', '70%'],
            selectedMode: 'single',
            avoidLabelOverlap: false,
            label: {
              show: false,
              position: 'center'
            },
            emphasis: {
              label: {
                show: true,
                fontSize: '18',
                fontWeight: 'bold'
              }
            },
            labelLine: {
              show: false
            },
            data: [
              {value: 30, name: '可回收', selected: true},
              {value: 6, name: '有害'},
              {value: 50, name: '厨余'},
              {value: 14, name: '其他'}
            ]
          }
        ]
      })
    },
    myChart3() {
      let myChart3 = this.$echarts.init(document.getElementById('myChart3'), this.themes)
      // 绘制图表
      myChart3.setOption({
        title: {
          text: '垃圾分类河流图',
          left: 'center',
          top: 'bottom'
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'line',
            lineStyle: {
              color: 'rgba(0,0,0,0.2)',
              width: 1,
              type: 'solid'
            }
          }
        },

        backgroundColor: 'rgba(0, 0, 0, 0.0)',
        legend: {
          data: ['可回收', '厨余', '有害', '其他']
        },

        singleAxis: {
          top: 50,
          bottom: 50,
          axisTick: {},
          axisLabel: {},
          type: 'time',
          axisPointer: {
            animation: true,
            label: {
              show: true
            }
          },
          splitLine: {
            show: true,
            lineStyle: {
              type: 'dashed',
              opacity: 0.2
            }
          }
        },

        series: [
          {
            type: 'themeRiver',
            emphasis: {
              itemStyle: {
                shadowBlur: 20,
                shadowColor: 'rgba(0, 0, 0, 0.8)'
              }
            },
            data: this.hlDate
            // data: [['2015/11/08',10,'可回收'],['2015/11/09',15,'可回收'],['2015/11/10',35,'可回收'],
            //   ['2015/11/11',38,'可回收'],['2015/11/12',22,'可回收'],['2015/11/13',16,'可回收'],
            //   ['2015/11/14',7,'可回收'],['2015/11/15',2,'可回收'],['2015/11/16',17,'可回收'],
            //   ['2015/11/17',33,'可回收'],['2015/11/18',40,'可回收'],['2015/11/19',32,'可回收'],
            //   ['2015/11/20',26,'可回收'],['2015/11/21',35,'可回收'],['2015/11/22',40,'可回收'],
            //   ['2015/11/23',32,'可回收'],['2015/11/24',26,'可回收'],['2015/11/25',22,'可回收'],
            //   ['2015/11/26',16,'可回收'],['2015/11/27',22,'可回收'],['2015/11/28',10,'可回收'],
            //   ['2015/11/08',21,'厨余'],['2015/11/09',25,'厨余'],['2015/11/10',27,'厨余'],
            //   ['2015/11/11',23,'厨余'],['2015/11/12',24,'厨余'],['2015/11/13',21,'厨余'],
            //   ['2015/11/14',35,'厨余'],['2015/11/15',39,'厨余'],['2015/11/16',40,'厨余'],
            //   ['2015/11/17',36,'厨余'],['2015/11/18',33,'厨余'],['2015/11/19',43,'厨余'],
            //   ['2015/11/20',40,'厨余'],['2015/11/21',34,'厨余'],['2015/11/22',28,'厨余'],
            //   ['2015/11/23',26,'厨余'],['2015/11/24',37,'厨余'],['2015/11/25',41,'厨余'],
            //   ['2015/11/26',46,'厨余'],['2015/11/27',47,'厨余'],['2015/11/28',41,'厨余'],
            //   ['2015/11/08',10,'有害'],['2015/11/09',15,'有害'],['2015/11/10',35,'有害'],
            //   ['2015/11/11',38,'有害'],['2015/11/12',22,'有害'],['2015/11/13',16,'有害'],
            //   ['2015/11/14',7,'有害'],['2015/11/15',2,'有害'],['2015/11/16',17,'有害'],
            //   ['2015/11/17',33,'有害'],['2015/11/18',40,'有害'],['2015/11/19',32,'有害'],
            //   ['2015/11/20',26,'有害'],['2015/11/21',35,'有害'],['2015/11/22',40,'有害'],
            //   ['2015/11/23',32,'有害'],['2015/11/24',26,'有害'],['2015/11/25',22,'有害'],
            //   ['2015/11/26',16,'有害'],['2015/11/27',22,'有害'],['2015/11/28',10,'有害'],
            //   ['2015/11/08',10,'其他'],['2015/11/09',15,'其他'],['2015/11/10',35,'其他'],
            //   ['2015/11/11',38,'其他'],['2015/11/12',22,'其他'],['2015/11/13',16,'其他'],
            //   ['2015/11/14',7,'其他'],['2015/11/15',2,'其他'],['2015/11/16',17,'其他'],
            //   ['2015/11/17',33,'其他'],['2015/11/18',40,'其他'],['2015/11/19',32,'其他'],
            //   ['2015/11/20',26,'其他'],['2015/11/21',35,'其他'],['2015/11/22',4,'其他'],
            //   ['2015/11/23',32,'其他'],['2015/11/24',26,'其他'],['2015/11/25',22,'其他'],
            //   ['2015/11/26',16,'其他'],['2015/11/27',22,'其他'],['2015/11/28',10,'其他']]
          }
        ]
      })
    },

  },

};
</script>

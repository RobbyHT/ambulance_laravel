<style scoped>
  @import '/css/analysis.css';
</style>
<template>
  <div class="main">
    <div class="contentDiv">
      <div class="text-center">
        <span class="title">統計分析</span>
      </div>
      <div class="row mt-3">
        <div class="col-2 mt-1 mb-1"></div>
        <div class="col-4 mt-1 mb-1 text-center">
          <legend>開始日期</legend>
          <input type="date" class="form-control formInput" v-model="start_date">
        </div>
        <div class="col-4 mt-1 mb-1 text-center">
          <legend>結束日期</legend>
          <input type="date" class="form-control formInput" v-model="end_date">
        </div>
        <div class="col-2 mt-1 mb-1"></div>
        <div class="col-3 mt-1 mb-1"></div>
        <div class="col-6 mt-1 mb-1 text-left">
          <fieldset>
            <legend>Step1. 統計項目</legend>
            <div class="pl-5 ml-1">
              <label for="item-1">員工總車趟</label>
              <input type="radio" name="item" id="item-1" value="user" v-model="item" checked>
              <label for="item-2">月份總車趟</label>
              <input type="radio" name="item" id="item-2" value="month" v-model="item">
            </div>
          </fieldset>
        </div>
        <div class="col-3 mt-1 mb-1"></div>
        <div class="col-3 mt-1 mb-1"></div>
        <div class="col-6 mt-1 mb-1 text-left">
          <fieldset>
            <legend>Step2. 呈現圖表</legend>
            <div class="pl-5 ml-1">
              <label for="chart-1">直條圖</label>
              <input type="radio" name="chart" id="chart-1" value="bar" v-model="chart" checked>
              <label for="chart-2">折線圖</label>
              <input type="radio" name="chart" id="chart-2" value="line" v-model="chart">
              <label for="chart-3">雷達圖</label>
              <input type="radio" name="chart" id="chart-3" value="radar" v-model="chart">
            </div>
          </fieldset>
        </div>
        <div class="col-3 mt-1 mb-1"></div>
        <div class="col-12 mt-3 mb-4 text-center">
          <button type="button" class="btn btn-primary" style="width:200px;height:40px;" @click="resetData">繪製圖表</button>
        </div>
      </div>
      <!--<div id="show_container"></div>-->
      <VueHighcharts
        type="chart"
        :options="chartOptions"
        :redrawOnUpdate="true"
        @rendered="onRender"/>
    </div>
  </div>
</template>
<script>
  import VueHighcharts from 'vue3-highcharts';
  import HighCharts from 'highcharts';
  import HighchartsMore from 'highcharts/highcharts-more';
  import 'jquery-ui-dist/jquery-ui.min.css'
  import 'jquery-ui-dist/jquery-ui.min.js'

  HighchartsMore(HighCharts);
  export default {
    components: {
      VueHighcharts
    },
    data() {
      return {
        start_date: "",
        end_date: "",
        item: "user",
        chart: "bar",
        chartOptions: {
          chart: { 
            polar: false,
            type: 'line'
          },
          title: { 
            text: '車趟統計', 
          },
          xAxis: { 
            categories: [],
            tickmarkPlacement: ''
          },
          yAxis: { 
            title: {
              text: '趟數',
            },
            gridLineInterpolation: ''
          },
          series: [{
            name: '趟數',
            data: [],
          }],
          credits: {
            enabled: false
          },
        }
      }
    },
    methods: {
      resetData: function() {
        var vm = this;
        axios.post('/api/dispatchCount', {
          start_date: vm.start_date,
          end_date: vm.end_date,
          item: vm.item,
          chart: vm.chart,
          c_id: vm.$cId
        })
        .then(function (resp) {
          var categoryData = [];
          var seriesData = [];
          switch (vm.chart) {
            case 'bar':
              vm.chartOptions.chart.type = 'column';
              vm.chartOptions.chart.polar = false;
              vm.chartOptions.yAxis.title.text = '趟數';
              break;
            case 'line':
              vm.chartOptions.chart.type = 'areaspline';
              vm.chartOptions.chart.polar = false;
              vm.chartOptions.yAxis.title.text = '趟數';
              break;
            case 'radar':
              vm.chartOptions.chart.type = 'line';
              vm.chartOptions.chart.polar = true;
              vm.chartOptions.yAxis.title.text = '';
              break;
          }
          resp.data.forEach(element => {
            categoryData.push(element.key);
            seriesData.push(element.count);
          });
          vm.chartOptions.xAxis.categories = categoryData;
          vm.chartOptions.series[0].data = seriesData;
          vm.$loader.hide();
        })
        .catch(function (error) {
          console.log(error);
        });
        //this.chartOptions.series[0].data = [100, 200, 30, 15];
      },
      onRender() {
        console.log('Chart rendered');
      }
    },
    mounted() {
      this.resetData();
      $('input[type="radio"]').checkboxradio();
    }, 
  }
</script>
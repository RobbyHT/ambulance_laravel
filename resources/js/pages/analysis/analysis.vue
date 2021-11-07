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
          開始日期
          <input type="date" class="form-control formInput" v-model="start_date">
        </div>
        <div class="col-4 mt-1 mb-1 text-center">
          結束日期
          <input type="date" class="form-control formInput" v-model="end_date">
        </div>
        <div class="col-2 mt-1 mb-1"></div>
        <div class="col-12 mt-1 mb-1 text-center">
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

  export default {
    components: {
      VueHighcharts
    },
    data() {
      return {
        start_date: "",
        end_date: "",
        chartOptions: {
          chart: { 
            type: 'line', 
          },
          title: { 
            text: '車趟統計', 
          },
          xAxis: { 
            categories: [],
          },
          yAxis: { 
            title: {
              text: '趟數',
            },
          },
          series: [{
            name: '趟數',
            data: [],
          }],
        }
      }
    },
    methods: {
      resetData: function() {
        var vm = this;
        axios.post('/api/dispatchCount', {
          start_date: vm.start_date,
          end_date: vm.end_date
        })
        .then(function (resp) {
          var categoryData = [];
          var seriesData = [];
          resp.data.forEach(element => {
            categoryData.push(element.d_date);
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
    }, 
  }
</script>
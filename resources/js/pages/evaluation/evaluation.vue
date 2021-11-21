<style scoped>
  @import '/css/evaluation.css';
</style>
<template>
  <div class="main">
    <div class="item-row">
      <div class="col-lg-12">
        <div class="evaMain text-center">
          <div class="eva-row">
            <div class="col-lg-12">
              <span class="title">評鑑管理</span>
            </div>
            <div class="evaLeft col-3 mt-3 text-center">
              <div class="content">
                <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="exportUser">匯出員工清單</button>
              </div>
              <div class="content">
                <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="exportCar">匯出車輛清單</button>
              </div>
              <div class="content">
                <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="exportEquipment">匯出設備清單</button>
              </div>
            </div>
            <div class="evaRight col-9 mt-3 text-center">
              <div class="item-row content">
                <div class="col-1 mt-1 mb-1"></div>
                <div class="col-5 mt-1 mb-1 text-center">
                  <legend>開始日期</legend>
                  <input type="date" class="form-control formInput" v-model="start_date">
                </div>
                <div class="col-5 mt-1 mb-1 text-center">
                  <legend>結束日期</legend>
                  <input type="date" class="form-control formInput" v-model="end_date">
                </div>
                <div class="col-1 mt-1 mb-1"></div>
                <div class="col-12 content">
                <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="exportDispatch">匯出車趟報表</button>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    components: {
      //
    },
    data() {
      return {
        
      }
    },
    methods: {
      download: function(url, name){
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `${name}.xlsx`);
        document.body.appendChild(link);
        link.click();
      },
      exportUser: function () {
        var vm = this;
        axios.post('/api/exportUser', {
          c_id: vm.$cId
        })
        .then(resp => {
          vm.download(resp.data, '員工清單')
        })
        .catch(err => console.log(err.response.data));
      },
      exportCar: function () {
        var vm = this;
        axios.post('/api/exportCar', {
          c_id: vm.$cId
        })
        .then(resp => {
          vm.download(resp.data, '車輛清單')
        })
        .catch(err => console.log(err.response.data));
      },
      exportEquipment: function () {
        var vm = this;
        axios.post('/api/exportEquipment', {
          c_id: vm.$cId
        })
        .then(resp => {
          vm.download(resp.data, '設備清單')
        })
        .catch(err => console.log(err.response.data));
      },
      exportDispatch: function () {
        var vm = this;
        axios.post('/api/exportDispatch', {
          c_id: vm.$cId
        })
        .then(resp => {
          vm.download(resp.data, '車趟報表')
        })
        .catch(err => console.log(err.response.data));
      },
    },
    mounted() {        
      //
    }, 
  }
</script>
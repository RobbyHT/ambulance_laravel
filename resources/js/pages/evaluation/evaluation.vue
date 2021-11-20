<style scoped>
  @import '/css/evaluation.css';
</style>
<template>
  <div class="main">
    <div class="item-row">
      <div class="col-lg-12">
        <div class="evaMain text-center">
          <span class="title">評鑑管理</span>
          <div class="content">
            <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="exportUser">匯出員工清單</button>
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
      exportUser: function () {
        axios.post('/api/exportUser', {
            c_id: this.$cId
        })
        .then(resp => {
            const url = resp;
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', '員工資料.xlsx');
            document.body.appendChild(link);
            link.click();
        })
        .catch(err => console.log(err.response.data));
      },
    },
    mounted() {        
      //this.getAllNews();
      //this.getEvents();
    }, 
  }
</script>
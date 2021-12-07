<style scoped>
  @import '/css/evaluation.css';
</style>
<template>
  <div class="main">
    <div class="evaMain">
      <div class="text-center">
        <span class="title">金鑰管理</span>
      </div>
      <div class="mt-3 pl-5 pr-5 text-left" style="word-break: break-all; min-height: 60vmin;">
        <p id="key">{{c_key}}</p>
        <button id="copy" class="btn btn-success" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Copied！" @click="copyKey">copy</button>
      </div>
      <div class="text-center">
        <button type="button" class="btn btn-primary" style="width:150px;height:40px;" @click="updCompanyKey">更新金鑰</button>
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
        c_key: ""
      }
    },
    methods: {
      getCompanyKey: function () {
        var vm = this;
        axios.post('/api/getCompanyKey', {
          c_id: vm.$cId
        })
        .then(resp => {
          vm.c_key = resp.data.c_key;
        })
        .catch(err => console.log(err.response.data));
      },
      updCompanyKey: function () {
        var vm = this;
        axios.post('/api/updateCompanyKey', {
          c_id: vm.$cId
        })
        .then(resp => {
          this.getCompanyKey();
        })
        .catch(err => console.log(err.response.data));
      },
      copyKey: function () {
        const range = document.createRange();
        const texts = document.querySelector('#key');
        console.log(texts);
        range.selectNode(texts);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        
        document.execCommand('copy');
        selection.removeAllRanges();
        setTimeout(function () {
          $('#copy').tooltip('hide');
        }, 2000);
      }
    },
    mounted() {
      this.getCompanyKey();
      $('#copy').tooltip({
        trigger: 'click',
        delay: { show: 100 }
      });
    }, 
  }
</script>
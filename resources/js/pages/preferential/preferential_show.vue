<template>
  <div class="card">
    <div class="col-md-12">
      <div class="people mb-2">
        <span id="errorMsg" style="color: red; font-size: 1.1rem;"></span>
        <div class="tabs">
          <ul class="tab-links"></ul>
          <div class="tab-content">
            <div class="tab template-content">
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  名稱：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.name }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  地址：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.address }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  電話：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.telphone }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  優惠項目：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.preferential.name }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  備註：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.remark }}
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
    props: ["customerId"],
    data() {
      return {
        data: []
      }
    },
    methods: {
      getCustomer: function() {
        var vm = this;
        axios.get(`/api/customer/${vm.customerId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    mounted: function() {
      this.getCustomer();
    }
  }
</script>
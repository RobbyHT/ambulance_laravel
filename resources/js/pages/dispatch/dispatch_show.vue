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
                  日期：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.d_date }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  時間：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.d_time }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  起點：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.start }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  終點：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.end }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  車程距離：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.distance }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  車程時間：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.duration }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  預估車資：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.totalPay }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  司機：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.driver_id }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  氧氣：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.o2 }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  電梯：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.elevator }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  特護：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.special }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  患者體重：
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.weight }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  聯絡電話：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.phone }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="content" class="col-sm-3 col-form-label text-right">
                  備註：
                  <span class="text-danger">*</span>
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
    props: ["dispatchId"],
    data() {
      return {
        data: []
      }
    },
    methods: {
      getDispatch: function() {
        var vm = this;
        axios.get(`/api/dispatch/${vm.dispatchId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    mounted: function() {
      this.getDispatch();
    }
  }
</script>
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
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.name" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  地址：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.address" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  電話：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.telphone" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  優惠項目：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <select v-model="data.preferential_id" class="form-control">
                    <option v-for="preferential in preferentialData" 
                      :key="preferential.id" 
                      :value="preferential.id">
                      {{ preferential.title }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  備註：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <textarea class="form-control" rows="5" v-model="data.remark"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4" @click="addCustomer">建立</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        preferentialData: [],
        data: {
          name: '',
          address: '',
          telphone: '',
          preferential_id: '',
          remark: '',
        }
      }
    },
    methods: {
      getPreferential: function() {
        var vm = this;
        axios.get(`/api/preferential`)
          .then(function (resp) {
            vm.preferentialData = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      addCustomer: function() {
        var vm = this;
        axios.post(`/api/customer`, {
          data: vm.data
        })
        .then(function (resp) {
          vm.$swal.fire({
            title: '新增成功！',
            icon: "success",
            confirmButtonClass: 'btn btn-success',
          })
          $('#customerModal').modal('hide');
          vm.$parent.getAllCustomer();
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },
    mounted: function() {
      this.getPreferential();
    }
  }
</script>
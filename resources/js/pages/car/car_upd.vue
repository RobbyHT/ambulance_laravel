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
                  車牌：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.plate" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  所屬司機：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <select v-model="data.driver_id" class="form-control">
                    <option v-for="user in userData" 
                      :key="user.id" 
                      :value="user.id">
                        {{ user.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  出廠日期：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label">
                  <input type="date" class="form-control" v-model="data.factory_date" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  報廢日期：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.expiry_date = data.factory_date != '' ? $moment($moment(data.factory_date).add(10, 'years')).format("yyyy-MM-DD") : '' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4" @click="updCar">儲存</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ["carId"],
    data() {
      return {
        data: [],
        userData: []
      }
    },
    methods: {
      getUser: function() {
        var vm = this;
        axios.get(`/api/userTake/driver`)
          .then(function (resp) {
            vm.userData = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      getCar: function() {
        var vm = this;
        axios.get(`/api/car/${vm.carId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      updCar: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認修改？',
          icon: 'warning',
          showCancelButton: true,
            confirmButtonText: '確認',
            cancelButtonText: '取消',
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/car/${vm.carId}`, {
              _method: 'PUT',
              data: vm.data
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '修改成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              $('#carModal').modal('hide');
              vm.$parent.getAllCar();
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        });
      }
    },
    mounted: function() {
      this.getUser();
      this.getCar();
    }
  }
</script>
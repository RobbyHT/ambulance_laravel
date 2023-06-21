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
                  設備名稱：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.name" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  數量：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="number" class="form-control" v-model="data.amount" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4" @click="updEquipment">儲存</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ["equipmentId"],
    data() {
      return {
        data: [],
        equipmentData: []
      }
    },
    methods: {
      getEquipment: function() {
        var vm = this;
        axios.get(`/api/equipment/${vm.equipmentId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      updEquipment: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認修改？',
          icon: 'warning',
          showCancelButton: true,
            confirmButtonText: '確認',
            cancelButtonText: '取消',
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/equipment/${vm.equipmentId}`, {
              _method: 'PUT',
              data: vm.data
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '修改成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              $('#equipmentModal').modal('hide');
              vm.$parent.getAllEquipment();
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        });
      }
    },
    mounted: function() {
      this.getEquipment();
    }
  }
</script>
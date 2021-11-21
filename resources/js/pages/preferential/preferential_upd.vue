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
                  項目名稱：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.title" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  折扣：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.discount" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  說明：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <textarea class="form-control" rows="5" v-model="data.content"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4" @click="updPreferential">儲存</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ["preferentialId"],
    data() {
      return {
        data: [],
        preferentialData: []
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
      getPreferential: function() {
        var vm = this;
        axios.get(`/api/preferential/${vm.preferentialId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      updPreferential: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認修改？',
          icon: 'warning',
          showCancelButton: true,
            confirmButtonText: '確認',
            cancelButtonText: '取消',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/preferential/${vm.preferentialId}`, {
              _method: 'PUT',
              data: vm.data
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '修改成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              $('#preferentialModal').modal('hide');
              vm.$parent.getAllPreferential();
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        });
      }
    },
    mounted: function() {
      this.getPreferential();
    }
  }
</script>
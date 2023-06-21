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
                  權限：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label">
                  <select v-model="data.permission" class="form-control">
                    <option value="admin" :selected="data.permission == 'admin'">系統管理者</option>
                    <option value="unit" :selected="data.permission == 'unit'">單位管理者</option>
                    <option value="driver" :selected="data.permission == 'driver'">司機</option>
                    <option value="EMT" :selected="data.permission == 'EMT'">救護員</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  帳號：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.account }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  Email：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.email }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  姓名：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.name" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  性別：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="c_gender_m" name="gender" value="M" :checked="data.gender == 'M'">
                    <label class="label" for="c_gender_m">男</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="c_gender_f" name="gender" value="F" :checked="data.gender == 'F'">
                    <label class="label" for="c_gender_f">女</label>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  生日：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="date" class="form-control" v-model="data.birther" />
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  身分證字號：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.perid }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="content" class="col-sm-3 col-form-label text-right">
                  電話：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  <input type="text" class="form-control" v-model="data.telphone" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4" @click="updUser">儲存</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ["userId"],
    data() {
      return {
        /*data: {
          permission: '',
          account: '',
          email: '',
          name: '',
          gender: '',
          birther: '',
          perid: '',
          telphone: '',
        },*/
        data: []
      }
    },
    methods: {
      getUser: function() {
        var vm = this;
        axios.get(`/api/user/${vm.userId}`)
          .then(function (resp) {
            vm.data = resp.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      updUser: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認修改？',
          icon: 'warning',
          showCancelButton: true,
            confirmButtonText: '確認',
            cancelButtonText: '取消',
        }).then(function (result) {
          if (result.value) {
            axios.post(`/api/user/${vm.userId}`, {
              _method: 'PUT',
              data: vm.data
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '修改成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              $('#userModal').modal('hide');
              vm.$parent.getAllUser();
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
    }
  }
</script>
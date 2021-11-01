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
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.permission }}
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
                  {{ data.name }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  性別：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.gender }}
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  生日：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label text-left">
                  {{ data.birther }}
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
                  {{ data.telphone }}
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
    props: ["userId"],
    data() {
      return {
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
      }
    },
    mounted: function() {
      this.getUser();
    }
  }
</script>
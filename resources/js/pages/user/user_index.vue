<style scoped>
  @import '/css/user.css';
</style>
<template>
  <div class="main">
    <div class="tableDiv">
      <div class="dialog-bottom col-12">
        <div class="col-4 dialog-title">
          人員管理
        </div>
        <div class="col-8" style="margin-left: auto; order: 2; display: inline-flex; align-items: center;">
          <div class="col-6 input-wrapper">
            <input type="search" class="form-control light-table-filter" data-table="table" placeholder="請輸入關鍵字" @keyup="searchTab">
          </div>
          <div class="col-3 text-center"></div>
          <div class="col-3 text-center">
            <a href="javascript:void(0);" @click="delUser">
              <img  src="/img/人員管理-刪除Icon.png" class="iconImg-4" alt="刪除" title="刪除">
              <span class="userDelBtn">刪除</span>
            </a>
          </div>
        </div>
      </div>
      <table class="table table-hover" id="userTab">
        <thead>
          <tr>
            <th style="width: 5%;">
              <input type="checkbox" @change="selectAll" style="vertical-align:sub;zoom:150%;">
            </th>
            <th style="width: 8%;">編號</th>
            <th style="width: 10%;">姓名</th>
            <th style="width: 22%;">信箱</th>
            <th style="width: 25%;">所屬公司</th>
            <th style="width: 14%;">權限</th>
            <th style="width: 8%;">編輯</th>
            <th style="width: 8%;">檢視</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in userData" :key="user.id">
            <td>
              <input type="checkbox" :id="'user'+index" name="user[]" :value="user.id" style="vertical-align:sub;zoom:150%;">
            </td>
            <td align="center">{{index+1}}</td>
            <td align="center">{{user.name}}</td>
            <td align="center">{{user.email}}</td>
            <td align="center">{{user.c_name}}</td>
            <td align="center">
              <div class="select">
                <select :name="'userPermission'+index" :id="'userPermission'+index" class="form-control" :value="user.permission" @change="updPermission(user.id, user.permission, $event)">
                  <option value="admin" :selected="user.permission == 'admin'">系統管理者</option>
                  <option value="unit" :selected="user.permission == 'unit'">單位管理者</option>
                  <option value="driver" :selected="user.permission == 'driver'">司機</option>
                  <option value="EMT" :selected="user.permission == 'EMT'">救護員</option>
                </select>
              </div>
            </td>
            <td align="center">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#userModal" @click="userView = 'upd'; userId = user.id;">
                <img src="/img/人員管理-編輯Icon.png" class="iconImg-4" alt="編輯" title="編輯">
              </a>
            </td>
            <td align="center">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#userModal" @click="userView = 'show'; userId = user.id;">
                <img src="/img/人員管理-檢視Icon.png" class="iconImg-4" alt="檢視" title="檢視">
              </a>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="8">
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title col-form-label" id="exampleModalCenterTitle">人員管理</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="user-body">
          <UserUpd v-if="userView === 'upd'" :userId="userId" :key="userId" />
          <UserShow v-if="userView === 'show'" :userId="userId" :key="userId" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import "datatables.net-dt/js/dataTables.dataTables"
  import "datatables.net-dt/css/jquery.dataTables.min.css"
  import UserUpd from './user_upd.vue'
  import UserShow from './user_show.vue'

  export default {
    components: {
      UserUpd,
      UserShow
    },
    data() {
      return {
        userView: "",
        userId: "",
        userData: [],
        userTab: null,
        data: {
          permission: "",
        }
      }
    },
    methods: {
      getAllUser: async function() {
        var vm = this;
        vm.$loader.show({
          container: this.$refs.root
        });
        await axios.get('/api/user')
        .then(function (resp) {
          vm.userData = resp.data;
          vm.$loader.hide();
        })
        .catch(function (error) {
          console.log(error);
        });

        vm.userTab = $('#userTab').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "ordering": true,
            "bAutoWidth":false,
            "destroy": true,
            "retrieve": true,
            "language": {
              sProcessing: "處理中…",
              sZeroRecords: "尚無資料",
              infoFiltered: "(從 _MAX_ 項結果中過濾)",
              sInfo: "共 _TOTAL_ 筆",
              sInfoEmpty: "共 0 筆",
              oPaginate: {
                sFirst: "首頁",
                sPrevious: "上頁",
                sNext: "下頁",
                sLast: "尾頁"
              },
              paginate: {
                next: '>',
                previous: '<'
              }
            }
          });
          $("#userTab_filter").hide();
          $('#userTab').removeClass('no-footer');
          $('tfoot>tr>td').append($('#userTab_info').get());
          $('tfoot>tr>td').append($('#userTab_paginate').get());
      },
      searchTab: function(event) {
        this.userTab.search( event.target.value ).draw();
      },
      updPermission: function(id, oldPermission, event) {
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
          vm.data.permission = event.target.value;
          if (result.value) {
            axios.post(`/api/user/${id}`, {
              _method: 'PUT',
              data: vm.data
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '修改成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              vm.getAllUser();
            })
            .catch(function (error) {
              console.log(error);
            });
          }else{
            event.target.value = oldPermission;
          }
        });
      },
      delUser: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認刪除？',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: '確認',
          cancelButtonText: '取消',
          confirmButtonClass: 'btn btn-warning',
          cancelButtonClass: 'btn btn-danger ml-1',
        }).then(function (result) {
          if (result.value) {
            var checked = []
            $("input[name='user[]']:checked").each(function ()
            {
              if($(this).val() != 0){
                checked.push(parseInt($(this).val()));
              }
            });

            axios.post(`/api/user/0`, {
              _method: 'DELETE',
              id: checked
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '刪除成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              }).then(function (result) {
                if (result.value) {
                  location.reload();
                }
              });
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        });
      },
      selectAll: function(event) {
        var rows = this.userTab.rows({ search: 'applied' }).nodes();
        $("input[name='user[]']", rows).prop('checked', event.target.checked);
      }
    },
    mounted() {
      this.getAllUser();
    }, 
  }
</script>
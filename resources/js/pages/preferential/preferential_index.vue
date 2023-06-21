<style scoped>
  @import '/css/car.css';
</style>
<template>
  <div class="main">
    <div class="tableDiv">
      <div class="dialog-bottom col-12">
        <div class="col-4 dialog-title">
          優惠管理
        </div>
        <div class="col-8" style="margin-left: auto; order: 2; display: inline-flex; align-items: center;">
          <div class="col-6 input-wrapper">
            <input type="search" class="form-control light-table-filter" data-table="table" placeholder="請輸入關鍵字" @keyup="searchTab">
          </div>
          <div class="col-3 text-center">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#preferentialModal" @click="preferentialView = 'add';">
              <img src="/img/人員管理-新增Icon.png" class="iconImg-4" alt="新增" title="新增">
              <span class="userInsBtn">新增</span>
            </a>
          </div>
          <div class="col-3 text-center">
            <a href="javascript:void(0);" @click="delPreferential">
              <img  src="/img/人員管理-刪除Icon.png" class="iconImg-4" alt="刪除" title="刪除">
              <span class="userDelBtn">刪除</span>
            </a>
          </div>
        </div>
      </div>
      <table class="table table-hover" id="preferentialTab">
        <thead>
          <tr>
            <th style="width: 5%;">
              <input type="checkbox" @change="selectAll" style="vertical-align:sub;zoom:150%;">
            </th>
            <th style="width: 10%;">編號</th>
            <th style="width: 30%;">項目名稱</th>
            <th style="width: 15%;">折扣</th>
            <th style="width: 30%;">最後更新日期</th>
            <th style="width: 10%;">編輯</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(preferential, index) in preferentialData" :key="preferential.id">
            <td>
              <input type="checkbox" :id="'preferential'+index" name="preferential[]" :value="preferential.id" style="vertical-align:sub;zoom:150%;">
            </td>
            <td align="center">{{index+1}}</td>
            <td align="center">{{preferential.title}}</td>
            <td align="center">{{preferential.discount}}</td>
            <td align="center">{{preferential.updated_at}}</td>
            <td align="center">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#preferentialModal" @click="preferentialView = 'upd'; preferentialId = preferential.id;">
                <img src="/img/人員管理-編輯Icon.png" class="iconImg-4" alt="編輯" title="編輯">
              </a>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6">
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="modal fade" id="preferentialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title col-form-label" id="exampleModalCenterTitle">優惠管理</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="preferential-body">
          <PreferentialAdd v-if="preferentialView === 'add'" />
          <PreferentialUpd v-if="preferentialView === 'upd'" :preferentialId="preferentialId" :key="preferentialId" />
          <PreferentialShow v-if="preferentialView === 'show'" :preferentialId="preferentialId" :key="preferentialId" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import "datatables.net-dt/js/dataTables.dataTables"
  import "datatables.net-dt/css/jquery.dataTables.min.css"
  import PreferentialAdd from './preferential_add.vue'
  import PreferentialUpd from './preferential_upd.vue'
  import PreferentialShow from './preferential_show.vue'

  export default {
    components: {
      PreferentialAdd,
      PreferentialUpd,
      PreferentialShow
    },
    data() {
      return {
        preferentialView: "",
        preferentialId: "",
        preferentialData: [],
        preferentialTab: null
      }
    },
    methods: {
      getAllPreferential: async function() {
        var vm = this;
        let loader = this.$loader.show({
          container: this.$refs.root
        });
        await axios.get('/api/preferential', {
                  params: {
                    user_id: vm.$userId
                  }
                })
        .then(function (resp) {
          vm.preferentialData = resp.data;
          loader.hide();
        })
        .catch(function (error) {
          console.log(error);
        });

        vm.preferentialTab = $('#preferentialTab').DataTable({
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
          $("#preferentialTab_filter").hide();
          $('#preferentialTab').removeClass('no-footer');
          $('tfoot>tr>td').append($('#preferentialTab_info').get());
          $('tfoot>tr>td').append($('#preferentialTab_paginate').get());
      },
      searchTab: function(event) {
        this.preferentialTab.search( event.target.value ).draw();
      },
      delPreferential: function() {
        var vm = this;
        vm.$swal.fire({
          title: '確認刪除？',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: '確認',
          cancelButtonText: '取消',
        }).then(function (result) {
          if (result.value) {
            var checked = []
            $("input[name='preferential[]']:checked").each(function ()
            {
              if($(this).val() != 0){
                checked.push(parseInt($(this).val()));
              }
            });

            axios.post(`/api/preferential/0`, {
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
        var rows = this.preferentialTab.rows({ search: 'applied' }).nodes();
        $("input[name='preferential[]']", rows).prop('checked', event.target.checked);
      }
    },
    mounted() {
      this.getAllPreferential();
    }, 
  }
</script>
<style scoped>
  @import '/css/car.css';
</style>
<template>
  <div class="main">
    <div class="tableDiv">
      <div class="dialog-bottom col-12">
        <div class="col-4 dialog-title">
          設備管理
        </div>
        <div class="col-8" style="margin-left: auto; order: 2; display: inline-flex; align-items: center;">
          <div class="col-6 input-wrapper">
            <input type="search" class="form-control light-table-filter" data-table="table" placeholder="請輸入關鍵字" @keyup="searchTab">
          </div>
          <div class="col-3 text-center">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#equipmentModal" @click="equipmentView = 'add';">
              <img src="/img/人員管理-新增Icon.png" class="iconImg-4" alt="新增" title="新增">
              <span class="userInsBtn">新增</span>
            </a>
          </div>
          <div class="col-3 text-center">
            <a href="javascript:void(0);" @click="delEquipment">
              <img  src="/img/人員管理-刪除Icon.png" class="iconImg-4" alt="刪除" title="刪除">
              <span class="userDelBtn">刪除</span>
            </a>
          </div>
        </div>
      </div>
      <table class="table table-hover" id="equipmentTab">
        <thead>
          <tr>
            <th style="width: 5%;">
              <input type="checkbox" @change="selectAll" style="vertical-align:sub;zoom:150%;">
            </th>
            <th style="width: 10%;">編號</th>
            <th style="width: 50%;">設備名稱</th>
            <th style="width: 20%;">數量</th>
            <th style="width: 25%;">編輯</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(equipment, index) in equipmentData" :key="equipment.id">
            <td>
              <input type="checkbox" :id="'equipment'+index" name="equipment[]" :value="equipment.id" style="vertical-align:sub;zoom:150%;">
            </td>
            <td align="center">{{index+1}}</td>
            <td align="center">{{equipment.name}}</td>
            <td align="center">{{equipment.amount}}</td>
            <td align="center">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#equipmentModal" @click="equipmentView = 'upd'; equipmentId = equipment.id;">
                <img src="/img/人員管理-編輯Icon.png" class="iconImg-4" alt="編輯" title="編輯">
              </a>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5">
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="modal fade" id="equipmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title col-form-label" id="exampleModalCenterTitle">設備管理</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="equipment-body">
          <EquipmentAdd v-if="equipmentView === 'add'" />
          <EquipmentUpd v-if="equipmentView === 'upd'" :equipmentId="equipmentId" :key="equipmentId" />
          <EquipmentShow v-if="equipmentView === 'show'" :equipmentId="equipmentId" :key="equipmentId" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import "datatables.net-dt/js/dataTables.dataTables"
  import "datatables.net-dt/css/jquery.dataTables.min.css"
  import EquipmentAdd from './equipment_add.vue'
  import EquipmentUpd from './equipment_upd.vue'
  import EquipmentShow from './equipment_show.vue'

  export default {
    components: {
      EquipmentAdd,
      EquipmentUpd,
      EquipmentShow
    },
    data() {
      return {
        equipmentView: "",
        equipmentId: "",
        equipmentData: [],
        equipmentTab: null
      }
    },
    methods: {
      getAllEquipment: async function() {
        var vm = this;
        vm.$loader.show({
          container: this.$refs.root
        });
        await axios.get('/api/equipment')
        .then(function (resp) {
          vm.equipmentData = resp.data;
          vm.$loader.hide();
        })
        .catch(function (error) {
          console.log(error);
        });

        vm.equipmentTab = $('#equipmentTab').DataTable({
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
          $("#equipmentTab_filter").hide();
          $('#equipmentTab').removeClass('no-footer');
          $('tfoot>tr>td').append($('#equipmentTab_info').get());
          $('tfoot>tr>td').append($('#equipmentTab_paginate').get());
      },
      searchTab: function(event) {
        this.equipmentTab.search( event.target.value ).draw();
      },
      delEquipment: function() {
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
            $("input[name='equipment[]']:checked").each(function ()
            {
              if($(this).val() != 0){
                checked.push(parseInt($(this).val()));
              }
            });

            axios.post(`/api/equipment/0`, {
              _method: 'DELETE',
              id: checked
            })
            .then(function (resp) {
              vm.$swal.fire({
                title: '刪除成功！',
                icon: "success",
                confirmButtonClass: 'btn btn-success',
              })
              vm.getAllEquipment();
            })
            .catch(function (error) {
              console.log(error);
            });
          }
        });
      },
      selectAll: function(event) {
        var rows = this.equipmentTab.rows({ search: 'applied' }).nodes();
        $("input[name='equipment[]']", rows).prop('checked', event.target.checked);
      }
    },
    mounted() {
      this.getAllEquipment();
    }, 
  }
</script>
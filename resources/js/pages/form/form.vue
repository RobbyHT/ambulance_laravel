<style>
  .stepTitle  {
    font-size: 14px;
    font-weight: bold;
  }
  .inputDiv {
    font-size: 16px;
    font-weight: bold;
    text-align: start;
    margin-bottom: 10px;
    color: #02294d;
  }
</style>
<template>
  <form-wizard step-size="xs" backButtonText="上一步" nextButtonText="下一步" finishButtonText="提交">
    <tab-content title="基本資料">
      <div class="inputDiv">
        帶隊人員姓名
        <input type="text" class="form-control newsTitle" />
      </div>
      <div class="inputDiv">
        手機
        <input type="text" class="form-control newsTitle" />
      </div>
      
    </tab-content>
    <tab-content title="協勤內容">
      My second tab content
    </tab-content>
    <tab-content title="參與人員">
      Yuhuuu! This seems pretty damn simple
    </tab-content>
  </form-wizard>
</template>
<script>
import {FormWizard, TabContent} from 'vue3-form-wizard'
import 'vue3-form-wizard/dist/style.css'
  export default {
    components: {
      FormWizard,
      TabContent
    }
  }
</script>
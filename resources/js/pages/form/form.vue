<style>
  .stepTitle  {
    font-size: 14px;
    font-weight: bold;
  }
  .main-block {
    font-size: 16px;
    font-weight: bolder;
    text-align: start;
    margin-bottom: 10px;
    color: #02294d;
  }
  .main-title {
    font-size: 18px;
  }
  .w-60px {
    width: 60px;
  }
  .w-100px {
    width: 100px;
  }
  .div-inline {
    display: flex;
    width: 100%;
    align-items: center;
  }
</style>
<template>
  <form-wizard step-size="xs" backButtonText="上一步" nextButtonText="下一步" finishButtonText="提交" start-index="3">
    <tab-content title="出勤">
      <button type="button" class="btn btn-primary btn-lg btn-block" style="height: 80px;">出勤</button>
      <button type="button" class="btn btn-primary btn-lg btn-block mt-5" style="height: 80px;" disabled>到達現場</button>
    </tab-content>
    <tab-content title="地點&人數">
      <div class="main-block">
        <label class="main-title">發生地點</label>
        <fieldset class="form-group">
          <div class="div-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="place0" :value="0" v-model="place" required>
              <label class="custom-control-label" for="place0">台七乙線</label>
            </div>
            <div class="custom-control custom-radio ml-4">
              <input type="radio" class="custom-control-input" id="place1" :value="1" v-model="place" required>
              <label class="custom-control-label" for="place1">其他</label>
            </div>
          </div>
			  	<div class="div-inline" v-show="place===0">
            <input type="number" class="form-control" />
            <span class="px-1" style="white-space: nowrap;">公里，</span>
            <select name="" id="" class="form-control">
              <option value="上">上</option>
              <option value="下">下</option>
            </select>
            <span class="px-1" style="white-space: nowrap;">方向。</span>
          </div>
          <div class="div-inline" v-show="place===1">
            <input type="number" class="form-control" />
          </div>
			  </fieldset>
      </div>
      <div class="main-block">
        <label class="main-title">傷病人數</label>
        <fieldset class="form-group">
          <div class="div-inline">
            <input type="text" class="form-control" />
            <span class="px-1" style="white-space: nowrap;">人</span>
          </div>
			  </fieldset>
      </div>
    </tab-content>
    <tab-content title="傷患資料">
      <div class="main-block">
        <label class="main-title">姓名</label>
        <fieldset class="form-group">
          <input type="text" class="form-control" v-model="patientName" />
			  </fieldset>
      </div>
      <div class="main-block">
        <label class="main-title">身分證字號</label>
        <fieldset class="form-group">
          <input type="text" class="form-control" v-model="patientIDNumber" />
			  </fieldset>
      </div>
      <div class="main-block">
        <label class="main-title">性別</label>
        <fieldset class="form-group">
          <div class="div-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="genderm" value="m" v-model="patientGender">
              <label class="custom-control-label" for="genderm">男</label>
            </div>
            <div class="custom-control custom-radio ml-4">
              <input type="radio" class="custom-control-input" id="genderf" value="f" v-model="patientGender">
              <label class="custom-control-label" for="genderf">女</label>
            </div>
            <div class="custom-control custom-radio ml-4">
              <input type="radio" class="custom-control-input" id="gendern" value="n" v-model="patientGender">
              <label class="custom-control-label" for="gendern">其他</label>
            </div>
          </div>
			  </fieldset>
      </div>
      <div class="main-block">
        <label class="main-title">連絡電話</label>
        <fieldset class="form-group">
          <input type="number" class="form-control" v-model="patientPhone" />
			  </fieldset>
      </div>
      <div class="main-block">
        <label class="main-title">年齡</label>
        <fieldset class="form-group">
          <input type="number" class="form-control" v-model="patientAge" />
			  </fieldset>
      </div>
    </tab-content>
    <tab-content title="傷患狀況">
      <div class="main-block">
        <label class="main-title">症狀</label>
        <fieldset class="form-group">
          <div class="row">
            <div class="custom-control custom-checkbox ml-4" v-for="(item, index) in symptoms" :key="index" :class="index==7||index==8 ? 'col-10' : 'col-5'">
              <input type="checkbox" class="custom-control-input" :id="'symptom'+index">
              <label class="custom-control-label" :for="'symptom'+index">{{item}}</label>
            </div>
          </div>
          <div class="div-inline" v-show="place===1">
            <input type="number" class="form-control" />
          </div>
			  </fieldset>
      </div>
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
    },
    data() {
        return {
          symptoms: [
            "呼吸急症", "呼吸道問題", "心血管疾病", "神經/腦血管疾病", "昏迷(意識不清)", "抽搐/筋攣", "噁心/嘔吐", "頭痛/頭暈/昏倒/暈厥",  "到院前心肺功能停止(OHCA)",
            "胸痛/悶", "腹痛", "發燒", "吐血", "擦傷", "撕裂傷", "挫傷(發炎、血腫)", "肢體無力/疼痛", "穿刺傷", "燒燙傷", "墜落傷", "其他"
          ],
          dispatchTime: null,
          arriveTime: null,
          placeType: null,
          place: null,
          patientName: null,
          patientIDNumber: null,
          patientPhone: null,
          patientAge: null,
          patientGender: null,
        }
    },
  }
</script>
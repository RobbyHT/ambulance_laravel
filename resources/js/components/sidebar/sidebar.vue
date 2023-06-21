<style>
  :root {
    --sidebar-bg-color: #394867;
    --sidebar-item-hover: rgb(0, 0, 0, 0.3);
    --sidebar-item-active: rgb(155, 164, 180, 0.8);
    /*
    #15006c
      #000747
      #38a169
      #276749
      -------------------
      #2F4BBE
      #3f5e8d
      #234271 
    */
  }
</style>
<style scoped>
  .sidebar {
    color: white;
    background-color: var(--sidebar-bg-color);
    float: left;
    position: fixed;
    z-index: 1;
    top: 80px;
    left: 0;
    bottom: 0;
    padding: 0.5em;
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  .sidebar h1 {
    height: 2.5em;
  }
  .collapse-icon {
    position: absolute;
    bottom: 0;
    padding: 0.75em;
    color: rgba(255, 255, 255, 0.7);
    transition: 0.2s linear;
  }
  .rotate-180 {
    transform: rotate(180deg);
    transition: 0.2s linear;
  }
</style>
<template>
  <div class="sidebar" :style="{ width: sidebarWidth }" @mouseover="hoverSidebar" @mouseout="hoverOutSidebar">
    <!--<h1>
      <span v-if="collapsed">
        <div>選</div>
        <div>單</div>
      </span>
      <span v-else>選單列</span>
    </h1>-->
    <SidebarLink to="/" icon="fas fa-home">首頁</SidebarLink>
    <SidebarLink to="/userAdmin" icon="fas fa-user">員工管理</SidebarLink>
    <SidebarLink to="/carAdmin" icon="fas fa-ambulance">車輛管理</SidebarLink>
    <SidebarLink to="/equipment" icon="fas fa-first-aid">設備管理</SidebarLink>
    <SidebarLink to="/preferential" icon="fas fa-user-tag">優惠管理</SidebarLink>
    <SidebarLink to="/customer" icon="fas fa-id-card">客戶管理</SidebarLink>
    <SidebarLink to="/evaluation" icon="fas fa-file-medical">評鑑管理</SidebarLink>
    <SidebarLink to="/analysisAdmin" icon="fas fa-chart-line">統計分析</SidebarLink>
    <SidebarLink to="/companyKey" icon="fas fa-key">金鑰管理</SidebarLink>

    <span
      class="collapse-icon"
      :class="{ 'rotate-180': collapsed }"
      @click="toggleSidebar"
    >
      <i class="fas fa-angle-double-left" />
    </span>
  </div>
</template>

<script>
  import SidebarLink from './sidebarLink'
  import { collapsed, toggleSidebar, hoverSidebar, hoverOutSidebar, sidebarWidth } from './state'
  export default {
    props: {},
    components: { SidebarLink },
    setup() {
      return { collapsed, toggleSidebar, hoverSidebar, hoverOutSidebar, sidebarWidth }
    }
  }
</script>
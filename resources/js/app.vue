<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }
  #nav {
    padding: 30px;
  }
  #nav a {
    font-weight: bold;
    color: #2c3e50;
  }
  #nav a.router-link-exact-active {
    color: #42b983;
  }
</style>

<template>
  <Navbar />
  <Sidebar />
  <div :style="{ 'margin-left': sidebarWidth }">
    <router-view />
  </div>

</template>

<script>
  import '/css/menu.css'
  import '/css/main.css'
  import Navbar from './components/navbar/navbar.vue'
  import Sidebar from './components/sidebar/sidebar.vue'
  import { sidebarWidth } from './components/sidebar/state'
  export default {
    name: 'app',
    components: {
      Navbar,
      Sidebar
    },
    setup() {
      return { sidebarWidth }
    }
  }
</script>
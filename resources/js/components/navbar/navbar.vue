<template>
  <div>
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center" >
              <ul class="nav navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" style="width: 10em;" href="/">
                    <img src="/img/new_logo.png" width="100%" alt=" logo">
                  </a>
                </li>
              </ul>          
            </div>
            <ul class="nav navbar-nav float-right" style="color:#000; font-size: x-large !important; font-family: Microsoft JhengHei !important;font-weight:bold;">
              <li class="nav-item d-lg-block text-center" style="position: relative;">
                <a href="javascript:void(0)" class="dropdown-toggle" @click="isShow=!isShow" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">
                  仁光救護車有限公司<span class="caret"></span>
                </a>
                <br/>
                <span class="mr-1">林昊霆</span>
                <transition name="logoutMenuTra">
                  <ul class="logoutMenu" v-show="isShow">
                    <li>              
                      <button @click="logout" style="font-weight: bold; color:red; border: 0; background-color:#ffffff;">
                        登出
                      </button>
                    </li>
                  </ul>
                </transition>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'navbar',
  data() {
    return {
      isShow: false
    }
  },
  methods: {
    logout() {
      axios.post("logout").then(response => { 
        location.reload();
        console.log(response);
      })
      .catch(error => {
        console.log(error);
      });
    }
  }
}
</script>
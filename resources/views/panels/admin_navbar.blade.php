{{-- navabar  --}}
<div id="mySidenav" class="sidenav">
  <div class="inner">
    <div>
      <nav id="menu">
        <ul>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/人員後台管理Icon.png') }}" alt="人員後臺管理" title="人員後臺管理">
              網路XR人員管理
            </span>
            <ul>
              <li><a href="/user-admin">人員後臺管理</a></li>
              <li><a href="/training-admin">受訓報名管理</a></li>
            </ul>
          </li>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/XR操作計時Icon.png') }}" alt="XR操作計時" title="XR操作計時">
              XR操作計時系統管理
            </span>
            <ul>
              <li><a href="/">XR連線管理</a></li>
              <li><a href="/">XR操作計時(線上)</a></li>
              <li><a href="/">計時訓練成績管理</a></li>
            </ul>
          </li>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/遠距學習Icon.png') }}" alt="遠距學習" title="遠距學習">
              VR遠距教學管理
            </span>
            <ul>
              <li><a href="/vr-class-admin">遠距課程管理</a></li>
              <li><a href="/vr-teachFile-admin">教學材料管理</a></li>
            </ul>
          </li>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/課程開發Icon.png') }}" alt="課程開發" title="課程開發">
              課程開發
            </span>
            <ul>
              <li><a href="/class-admin">課程管理</a></li>
              <li><a href="/">單元管理</a></li>
            </ul>
          </li>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/受訓報名Icon.png') }}" alt="受訓報名" title="受訓報名">
              評分系統
            </span>
            <ul>
              <li><a href="/test-admin">線上測驗</a></li>
              <li><a href="/topic-pool-admin">題庫管理</a></li>
            </ul>
          </li>
          <li>
            <span class="opener" style="color: #068000;">
              <img width="30px" src="{{ asset('images/xr/測驗系統Icon.png') }}" alt="測驗系統" title="測驗系統">
              成績統計分析
            </span>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu" 
data-bgcolor="@if(isset($configData['navbarBgColor'])){{$configData['navbarBgColor']}}@endif">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center" >
          <ul class="nav navbar-nav">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link" href="/">
                <img class="img-fluid" src="{{asset('img/logo.png')}}" width="70%" style="padding: 1.5rem 0.75rem 1.15rem 0.75rem;" alt=" logo">
              </a>
            </li>
          </ul>          
        </div>
        <ul class="nav navbar-nav float-right" style="color:#000; font-size: x-large !important; font-family: Microsoft JhengHei !important;font-weight:bold;">           
          <li class="nav-item d-lg-block"><a class="nav-link" href="/user-admin" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">網路XR人員管理</a></li>
          <li class="nav-item d-lg-block"><a class="nav-link" href="/operation-admin-search" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">XR操作計時系統管理</a></li>
          <li class="nav-item d-lg-block"><a class="nav-link" href="/vr-class-admin" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">VR遠距教學管理</a></li>
          <li class="nav-item d-lg-block"><a class="nav-link" href="/class-admin" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">課程開發</a></li>
          <li class="nav-item d-lg-block"><a class="nav-link" href="/topic-pool-admin" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">評分系統</a></li>
          <li class="nav-item d-lg-block"><a class="nav-link" href="/analysis-admin" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">成績統計分析</a></li>
          <li class="nav-item d-lg-block dropdown text-center">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-target="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 1.5rem 1rem 1.15rem 1rem;font-weight:bold;">
              系統管理員<span class="caret"></span>
            </a>
            <br/>
            <span class="mr-1">{{$user->name}}</span>
            <ul class="dropdown-menu logoutMenu" id="dropdon-menu">
              <li>
                <form method="POST" action="{{route('logout')}}">                
                  <button type="submit" style="font-weight: bold; color:red; border: 0; background-color:#ffffff;">
                    登出
                  </button>
                </form>
              </li>
            </ul>
            {{--<form method="POST" action="{{route('logout')}}">                
              <button type="submit" class="" style="padding: 1.5rem 1.5rem 1.15rem 1.5rem;font-weight:bold;color:red;border: 0;background-color: #ffffff;">
                登出
              </button>
            </form>--}}
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

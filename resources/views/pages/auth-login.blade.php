@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Login Page')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-6">    
  </div>
  <div class="col-xl-3 col-11">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->        
        <div class="col-md-12 col-12 px-0" >
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center" style="background: rgba(220, 220, 220, 1) !important; color:#FFF; font-family: Microsoft JhengHei !important;">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-left mb-2" style="font-family: Microsoft JhengHei !important;" >
                <img src="{{asset('images/iosh/logo/h_bar.png')}}" />登入
              </h4>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <!--<div class="d-flex flex-md-row flex-column justify-content-around">
                  <a href="#" class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                    <i class="bx bxl-google font-medium-3"></i>
                    <span class="pl-50 d-block text-center">Google</span>
                  </a>
                  <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                    <i class="bx bxl-facebook-square font-medium-3"></i>
                    <span class="pl-50 d-block text-center">Facebook</span>
                  </a>
                </div>-->
                <!--<div class="divider">
                  <div class="divider-text text-uppercase text-muted">
                    <small>or login with email</small>
                  </div>
                </div>-->
                <form method="POST" action="{{route('login')}}">
                  <div class="form-group mb-50">
                    <!--<label class="text-bold-600" for="exampleInputEmail1">Email address</label>-->
                    <input type="text" class="form-control" id="name" name="name" placeholder="帳號">
                  </div>
                  <div class="form-group">
                    <!--label class="text-bold-600" for="exampleInputPassword1">Password</label>-->
                    <input type="password" class="form-control" id="password" name="password" placeholder="密碼">
                  </div>
                  <!--<div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                    <div class="text-left">
                      <div class="checkbox checkbox-sm">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="checkboxsmall" for="exampleCheck1">
                          <small>Keep me logged in</small>
                        </label>
                      </div>
                    </div>
                    <div class="text-right">
                      <a href="{{asset('auth-forgot-password')}}" class="card-link"><small>Forgot Password?</small></a>
                    </div>
                  </div>-->
                  <button type="submit" class="btn btn-block btn-primary" style="background: rgba(37, 113, 52, 1) !important; color:#FFF;">
                    登入<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                  </button>                    
                  </a>
                </form>
                <hr>
                <div class="text-center">
                  <!--<small class="mr-25">Don't have an account?</small>-->
                  <a href="{{asset('auth-register')}}"><small>註冊</small></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <!--<div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <div class="card-content">
            <img class="img-fluid" src="{{asset('images/pages/login.png')}}" alt="branding logo">
          </div>
        </div>-->
      </div>
    </div>
  </div>
</section>
<!-- login page ends -->
@endsection
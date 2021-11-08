@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Forgot Password')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
@endsection

@section('content')
<!-- forgot password start -->
  <section class="row justify-content-center body-content">
    <div class="col-xl-7 col-md-9 col-10  px-0">
      <div class="card bg-authentication mb-0">
        <div class="row m-0">
          <!-- left section-forgot password -->
          <div class="col-md-6 col-12 px-0">
            <div class="card disable-rounded-right mb-0 p-2">
              <div class="card-header pb-1">
                <div class="card-title">
                  <h4 class="text-center mb-2">忘記密碼?</h4>
                </div>
              </div>
              <div class="form-group d-flex justify-content-between align-items-center mb-2">
                <div class="text-left">
                    <div class="ml-3 ml-md-2 mr-1"><a href="{{asset('login')}}"  class="card-link btn btn-outline-primary text-nowrap">登入</a></div>
                </div>
                <div class="mr-3">
                  <a href="{{asset('auth-register')}}" class="card-link btn btn-outline-primary text-nowrap">註冊</a>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="text-muted text-center mb-2"><small>輸入您註冊時使用的電子郵件，當您完成送出後，我們會發送臨時密碼給您!!</small></div>
                  <span style="color:red;">
                    <strong>{{session()->get('message') ?? ' '  }}</strong>
                    <strong>{{session()->get('status') ?? ' '  }}</strong>
                    <strong>{{$errors->first('email') ?? ' '  }}</strong>
                  </span>


                  <form class="mb-2" method="POST" action="/forgotpass" novalidate>
                    <div class="form-group mb-2">
                      <label class="text-bold-600" for="email">Email</label>
                      <div class="controls">
                      <input type="email" class="form-control" id="email" name="email" placeholder="輸入您的Email"  required
                          data-validation-required-message="電子郵件為必填">
                      </div>
                    </div>
                    <button class="btn btn-primary glow position-relative w-100">送出
                      <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                      </button>
                  </form>
                  <div class="text-center mb-2">
                    <a href="{{asset('login')}}"><small class="text-muted">回登入頁</small></a>
                  </div>
                  <!-- <div class="divider mb-2">
                      <div class="divider-text">Or Sign in as</div>
                  </div>
                  <div class="d-flex flex-md-row flex-column">
                    <a href="#" class="btn btn-social btn-google btn-block font-small-3 mb-1 mb-sm-1 mb-md-0 mr-md-1 text-center">
                      <i class="bx bxl-google font-medium-3"></i><span class="pl-1">Google</span>
                    </a>
                    <a href="#" class="btn btn-social btn-facebook btn-block font-small-3 text-center mt-0">
                      <i class="bx bxl-facebook-square font-medium-3"></i><span class="pl-1">Facebook</span>
                    </a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <!-- right section image -->
          <div class="col-md-6 d-md-block d-none text-center align-self-center">
            <img class="img-fluid" src="{{asset('images/pages/forgot-password.png')}}" alt="branding logo" width="300">
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- forgot password ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/validation/form-validation.js')}}"></script>
@endsection
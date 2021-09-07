@extends('layouts.loginLayout')

@section('content')
<div class="container">
  <div class="row justify-content-center body-content">
    <div class="col-md-6">
      <div class="card bg-authentication mb-0">
        @csrf
        <div class="row m-0">    
          <div class="col-md-12 col-12 px-0" >
            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center card-text">
              <div class="card-header pb-1">
                <div class="card-title">
                  <h1 class="text-bold-600 text-center">
                    登入
                  </h1>
                  <h4 class="text-left mb-2" style="font-family: Microsoft JhengHei !important;" >
                    <span style="color:red;">{{ strlen(session()->get('msg')) > 0 ? session()->get('msg') : ''}}
                      {{ strlen($errors->first('captcha')) > 0 ? '驗證碼錯誤' : '' }}
                      {{ strlen($errors->first('account')) > 0 ? '帳號/密碼有誤' : '' }}
                    </span>
                  </h4>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form id="myForm" method="POST" action="{{--route('login')--}}" onsubmit="return qq(this);">
                    <div class="form-group mb-50">
                      <label class="text-bold-600" for="account" style="font-size: 24px;">帳號</label>
                      <div class="input_container">
                        <img src="{{asset('img/登入帳號Icon.png')}}" class="input_img">
                        <input type="text" class="form-control inputAccount" id="account" name="account" placeholder="帳號" 
                        required data-validation-required-message="請填入帳號">
                      </div>
                    </div>
                    <div class="form-group mb-50">
                      <label class="text-bold-600" for="account" style="font-size: 24px;">密碼</label>
                      <div class="input_container">
                        <img src="{{asset('img/登入密碼Icon.png')}}" class="input_img">
                        <input type="password" class="form-control inputPassword" id="password" name="password" placeholder="密碼" 
                        required data-validation-required-message="請填入密碼">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="text-bold-600" for="captcha" style="font-size: 24px;">驗證碼</label>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                          <input type="text" class="form-control inputCaptcha" id="captcha" name="captcha" placeholder="驗證碼" required>                        
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <img class="img-fluid" src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()"  alt="checkCode">
                      </div>
                    </div>
                    <div class="text-center mt-1">
                      <button type="submit" class="btn btn-block loginBtn">
                        登入
                      </button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <!--<small class="mr-25">Don't have an account?</small>-->
                    {{--<a href="{{ route('register') }}"><small>註冊申請</small></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('password.request') }}"><small>忘記密碼</small></a>--}}
                    <a href="{{asset('auth-register')}}"><small>註冊申請</small></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{asset('auth-forgot-password')}}"><small>忘記密碼</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

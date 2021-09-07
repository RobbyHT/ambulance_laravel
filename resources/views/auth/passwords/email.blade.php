@extends('layouts.loginLayout')

@section('content')
<section class="flexbox-container body-content">
  <div class="col-xl-5 col-md-9 col-10  px-0">
    <div class="card bg-authentication mb-0" style="background: rgba(200, 220, 204, 0.2) !important;border: 6px rgba(0, 0, 0, 0.4) solid; border-radius: 20px;">
      <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center card-text" >
        <div class="card-header pb-1">
          <div class="card-title">
          <h2 class="text-bold-600 text-center mb-2">忘記密碼?</h2>
          </div>
        </div>
        <div class="form-group d-flex justify-content-between align-items-center mb-2 mt-2">
          <div class="text-left">
            <div class="ml-3 ml-md-2 mr-1"><a href="{{asset('login')}}"  class="card-link btn btn-outline-primary text-nowrap">登入</a></div>
          </div>
          <div class="mr-3">
          <a href="{{asset('register')}}" class="card-link btn btn-outline-primary text-nowrap">註冊</a>
          </div>
        </div>
        <div class="card-content">
          <div class="card-body">
          <div class="text-muted text-center mb-2"><h4>輸入您註冊時使用的電子郵件，當您完成送出後，我們會發送臨時密碼給您!!</h4></div>
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
            <a href="{{asset('login')}}"><small>回登入頁</small></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
{{--<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Send Password Reset Link') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>--}}
@endsection

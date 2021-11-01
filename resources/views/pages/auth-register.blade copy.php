@extends('layouts.fullLayoutMaster')

{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

@endsection

@section('content')
<!-- register section starts -->
<form class="form-horizontal" method="POST" action="{{ route('register') }}" novalidate>
  {{ csrf_field() }}
<section class="row justify-content-center body-content">
  <div class="col-xl-10 col-10">
    <div class="card bg-authentication mb-0" style="background: rgba(200, 255, 255, 0.3) !important;border: 6px rgba(0, 0, 0, 0.4) solid; border-radius: 20px;">
      <div class="row m-0">      
        <!-- register section left -->
        <div class="col-md-12 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center card-text">
            <div class="card-header pb-1">
              <div class="card-title">
                <h1 class="text-bold-600 text-center">
                  註冊申請
                </h1>
                <h4 class="text-left mb-2 font-large-1" style="font-family: Microsoft JhengHei !important;" >
                  <span style="color:red;">
                    {{ strlen($errors->regdata->first('email')) > 0 ? 'Email已註冊' : '' }}&nbsp;
                    {{ strlen($errors->regdata->first('account')) > 0 ? '帳號已註冊' : '' }}&nbsp;
                    {{ strlen($errors->regdata->first('perid')) > 0 ? '身分證已註冊' : '' }}&nbsp;
                    <span>
                </h4>
              </div>
            </div>
            <!--<div class="text-center">
              <p> <small> Please enter your details to sign up and be part of our great community</small>
              </p>
            </div>-->
            <div class="card-content">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="account"><span class="text-danger">(*)</span>帳號</label>
                      <div class="controls">
                        <input type="text" name="account"  class="form-control" id="account" maxlength="10"
                          placeholder="請填入註冊帳號"
                          data-validation-required-message="帳號為必填"
                          required>
                      </div>
                    </div>
                    
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="email"><span class="text-danger">(*)</span>電子郵件</label>
                      <div class="controls">
                        <input type="email" name="email" class="form-control" id="email" maxlength="50"
                          placeholder="註冊後臨時密碼將寄到此信箱，請務必填寫正確"  required
                        data-validation-required-message="電子郵件為必填">
                      </div>
                    </div>
                    
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>手耭號碼</label>
                      <div class="controls">
                        <input type="text" name="telphone" class="form-control" id="telphone" maxlength="15"
                          placeholder="請填入註冊人手機號碼" data-validation-containsnumber-regex="^\(?(\d{2})\)?[\s\-]?(\d{3,4})\-?(\d{4})$"
                            data-validation-containsnumber-message="請輸入正確電話格式"
                            data-validation-required-message="手機號碼為必填"
                            required>
                      </div>
                    </div>

                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>身分證字號</label>
                      <div class="controls">
                        <input type="text" name="perid" class="form-control" maxlength="10" id="perid"
                          placeholder="請填入註冊人身份證字號"  data-validation-containsnumber-regex="^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$"
                            data-validation-containsnumber-message="請輸入正確身份證格式"
                            data-validation-required-message="身份證字號為必填" required>
                      </div>
                    </div>

                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="name"><span class="text-danger">(*)</span>姓名</label>
                      <div class="controls">
                        <input type="text" name="name"  class="form-control" id="name" maxlength="10"
                          placeholder="請填入註冊人姓名" 
                          data-validation-required-message="姓名為必填"
                          required>
                      </div>
                    </div>

                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="born"><span class="text-danger">(*)</span>出生日期</label>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control pickadate-translations" id="born" name="born" value="2000/01/01" placeholder="選擇出生年月" required>
                        <div class="form-control-position">
                          <i class='bx bx-calendar'></i>
                        </div>
                      </fieldset>                      
                    </div>

                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="gender"><span class="text-danger">(*)</span>性別</label>
                      <div class="col-sm-9 custom-control-inline">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="radio" id="gender_m" name="gender" value="M">
                          <label class="label" for="gender_m">男</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="radio" id="gender_f" name="gender" value="F">
                          <label class="label" for="gender_f">女</label>
                        </div>
                      </div>
                      {{--<ul class="list-unstyled mb-0">
                        <li class="d-inline-block mr-2 mb-1">
                          <fieldset>
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input bg-primary" name="gender" id="customColorRadio1" value="m" data-validation-required-message="性別為必填" required>
                              <label class="custom-control-label" for="customColorRadio1">男</label>
                            </div>
                          </fieldset>
                        </li>
                        <li class="d-inline-block mr-2 mb-1">
                          <fieldset>
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input bg-primary" name="gender" id="customColorRadio2" value="f"> 
                              <label class="custom-control-label" for="customColorRadio2">女</label>
                            </div>
                          </fieldset>
                        </li>
                      </ul>--}}                    
                    </div>
                  </div>             
                  <div class="col-md-6">
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="name"><span class="text-danger">(*)</span>產業別</label>
                      <div class="controls">
                        <select class="form-control" name="industry" id="industry" data-validation-required-message="產業別為必填" required>
                          <option value="">請選擇產業別...</option>
                          {{--@foreach ($industries as $industry)
                            <option value="{{$industry->id}}">{{$industry->groups}}</option>
                          @endforeach--}}
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="company"><span class="text-danger">(*)</span>公司名稱</label>
                      <div class="controls">
                        <input type="text" name="company" class="form-control" id="company" maxlength="50"
                            placeholder="請填入註冊人公司名稱" data-validation-required-message="公司為必填" required>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="department"><span class="text-danger">(*)</span>單位</label>
                      <div class="controls">
                        <input type="text" name="department"  class="form-control" id="department" maxlength="50"
                            placeholder="請填入註冊人部門單位" data-validation-required-message="單位為必填" required>
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <label class="text-bold-600 font-medium-5" for="job_title"><span class="text-danger">(*)</span>職稱</label>
                      <div class="controls">
                        <input type="text" name="job_title"  class="form-control" id="job_title" maxlength="50"
                            placeholder="請填入註冊人單位職稱" data-validation-required-message="職稱為必填" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center form-group mb-0">                  
                  <ul class="list-unstyled mb-0">
                    <li class="d-inline-block mr-1 mb-0">
                      <fieldset>
                        <div class="custom-control custom-checkbox" >
                            <input type="checkbox" class="custom-control-input bg-primary" name="agreecheck" id="agreecheck" value="ok">
                            <label class="custom-control-label font-medium-3" for="agreecheck">同意接受本站之<a target="_blank" href="/file/隱私權政策.pdf">隱私權政策</a>
                              <button type="submit" id="registBtn" class="btn btn-block btn-primary font-medium-1 btn-light-primary mb-1 block-element text-nowrap" disabled="disabled" style="background: rgba(37, 113, 52, 1) !important; color:#FFF;">註冊</button>
                            </label>
                        </div>
                      </fieldset>
                    </li>
                  </ul>              
                </div>
                <div class="text-center"><small class="mr-25">已有帳號嗎?</small>
                  <a href="{{asset('login')}}"><small>回登入頁</small> </a>
                </div>
              </div>
            </div>
          </div>
        </div>      
      </div>
    </div>
  </div>
</section>
</form>

<!-- register section endss -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/legacy.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script src="{{asset('vendors/js/ui/blockUI.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{asset('js/scripts/iosh/picker-date-time.js')}}"></script>    
<script src="{{asset('js/scripts/iosh/register.js')}}"></script>    
<script src="{{asset('js/scripts/extensions/ext-component-block-ui.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
@endsection
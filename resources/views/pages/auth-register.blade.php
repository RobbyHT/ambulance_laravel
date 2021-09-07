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
  <div class="container register">
  <div class="row">
    <div class="col-md-3 register-left">
      <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
      <h2>註冊申請</h2>
      <p>歡迎使用醫指派網頁平台，註冊分為公司註冊與個人註冊，若 貴公司為初次使用，需要先以公司名義申請單位管理員帳號，認證通過後，使用者可依公司金鑰註冊。</p>
      <input type="button" onclick="location.href='/login'" value="登入"/><br/>
    </div>
    <div class="col-md-9 register-right">
      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">個人</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">公司</a>
        </li>
      </ul>
      {{--個人註冊--}}
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <h3 class="register-heading">個人註冊</h3>
          <div class="row register-form">
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
            </div>
            <div class="col-md-6">
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
                <label class="text-bold-600 font-medium-5" for="gender"><span class="text-danger">(*)</span>性別</label>
                <div class="">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="gender_m" name="gender" value="男">
                    <label class="label" for="gender_m">男</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="gender_f" name="gender" value="女">
                    <label class="label" for="gender_f">女</label>
                  </div>
                </div>
              </div>
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="company"><span class="text-danger">(*)</span>公司金鑰</label>
                <div class="controls">
                  <input type="text" name="company" class="form-control" id="company" maxlength="50"
                      placeholder="請填入公司金鑰" data-validation-required-message="公司金鑰為必填" required>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <div class="col-md-12 text-center">
                <input type="checkbox" class="custom-control-input bg-primary" name="agreecheck" id="agreecheck" value="ok">
                <label class="custom-control-label font-medium-3" for="agreecheck">同意接受本站之<a target="_blank" href="/file/隱私權政策.pdf">隱私權政策</a>
                  <button type="submit" id="registBtn" class="btn btn-block btnRegister" disabled="disabled">註冊</button>
                </label>
              </div>
            </div>
          </div>
        </div>
        {{--公司註冊--}}
        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <h3 class="register-heading">公司註冊</h3>
          <div class="row register-form">
            <div class="col-md-6">
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
                <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>身分證字號</label>
                <div class="controls">
                  <input type="text" name="perid" class="form-control" maxlength="10" id="perid"
                    placeholder="請填入註冊人身份證字號"  data-validation-containsnumber-regex="^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$"
                      data-validation-containsnumber-message="請輸入正確身份證格式"
                      data-validation-required-message="身份證字號為必填" required>
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
                <label class="text-bold-600 font-medium-5" for="born"><span class="text-danger">(*)</span>出生日期</label>
                <fieldset class="form-group position-relative has-icon-left">
                  <input type="date" class="form-control pickadate-translations" id="born" name="born" value="2000/01/01" placeholder="選擇出生年月" required>
                  <div class="form-control-position">
                    <i class='bx bx-calendar'></i>
                  </div>
                </fieldset>                      
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="gender"><span class="text-danger">(*)</span>性別</label>
                <div class="">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="c_gender_m" name="gender" value="男">
                    <label class="label" for="gender_m">男</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radio" id="c_gender_f" name="gender" value="女">
                    <label class="label" for="gender_f">女</label>
                  </div>
                </div>
              </div>
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="c_name"><span class="text-danger">(*)</span>公司名稱</label>
                <div class="controls">
                  <input type="text" name="c_name" class="form-control" id="c_name" maxlength="50"
                      placeholder="請填入註冊公司名稱" data-validation-required-message="公司為必填" required>
                </div>
              </div>
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="c_addr"><span class="text-danger">(*)</span>公司地址</label>
                <div class="controls">
                  <input type="text" name="c_addr" class="form-control" id="c_addr"
                      placeholder="請填入註冊公司地址" data-validation-required-message="公司地址為必填" required>
                </div>
              </div>
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="tax_id"><span class="text-danger">(*)</span>統一編號</label>
                <div class="controls">
                  <input type="text" name="tax_id" class="form-control" id="tax_id"
                      placeholder="請填入註冊公司統編" data-validation-required-message="公司統編為必填" required>
                </div>
              </div>
              <div class="form-group mb-2">
                <label class="text-bold-600 font-medium-5" for="c_tel"><span class="text-danger">(*)</span>公司電話</label>
                <div class="controls">
                  <input type="text" name="c_tel" class="form-control" id="c_tel"
                      placeholder="請填入註冊公司電話" data-validation-required-message="公司電話為必填" required>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <input type="checkbox" class="custom-control-input bg-primary" name="agreecheck" id="agreecheck" value="ok">
              <label class="custom-control-label font-medium-3" for="agreecheck">同意接受本站之<a target="_blank" href="/file/隱私權政策.pdf">隱私權政策</a>
                <button type="submit" id="registBtn" class="btn btn-block btnRegister" disabled="disabled">註冊</button>
              </label>
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
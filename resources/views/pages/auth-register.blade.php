@extends('layouts.fullLayoutMaster')

{{-- page scripts --}}
@section('page-styles')
@endsection

@section('content')
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
        <h4 class="text-left pt-3 pl-5 font-large-1" style="font-family: Microsoft JhengHei !important;" >
          <span style="color:red;">
            {{ strlen($errors->regdata->first('email')) > 0 ? 'Email已註冊' : '' }}&nbsp;
            {{ strlen($errors->regdata->first('account')) > 0 ? '帳號已註冊' : '' }}&nbsp;
            {{ strlen($errors->regdata->first('perid')) > 0 ? '身分證已註冊' : '' }}&nbsp;
            {{ strlen($errors->regdata->first('key')) > 0 ? '金鑰無效' : '' }}&nbsp;
          <span>
        </h4>
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <form class="form-horizontal" method="POST" action="{{ route('register') }}" novalidate>
            {{ csrf_field() }}
            <h3 class="register-heading">個人註冊</h3>
            <input type="hidden" name="permission" value="common">
            <div class="row register-form">
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="name"><span class="text-danger">(*)</span>姓名</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="name" name="name" maxlength="10"
                      placeholder="請填入註冊人姓名" 
                      data-validation-required-message="姓名為必填"
                      required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="account"><span class="text-danger">(*)</span>帳號</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="account" name="account" maxlength="10"
                      placeholder="請填入註冊帳號"
                      data-validation-required-message="帳號為必填"
                      required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="email"><span class="text-danger">(*)</span>電子郵件</label>
                  <div class="controls">
                    <input type="email" class="form-control" id="email" name="email" maxlength="50"
                      placeholder="註冊後臨時密碼將寄到此信箱，請務必填寫正確"  required
                    data-validation-required-message="電子郵件為必填">
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>身分證字號</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="perid" name="perid" maxlength="10"
                      placeholder="請填入註冊人身份證字號"  data-validation-containsnumber-regex="^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$"
                        data-validation-containsnumber-message="請輸入正確身份證格式"
                        data-validation-required-message="身份證字號為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>手耭號碼</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="telphone" name="telphone" maxlength="15"
                      placeholder="請填入註冊人手機號碼" data-validation-containsnumber-regex="^\(?(\d{2})\)?[\s\-]?(\d{3,4})\-?(\d{4})$"
                        data-validation-containsnumber-message="請輸入正確電話格式"
                        data-validation-required-message="手機號碼為必填"
                        required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="birther"><span class="text-danger">(*)</span>出生日期</label>
                  <input type="date" class="form-control" id="birther" name="birther" value="2000-01-01" required>                 
                </div>
              </div>
              <div class="col-md-6">
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
                  <label class="text-bold-600 font-medium-5" for="company_key"><span class="text-danger">(*)</span>公司金鑰</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="company_key" name="company_key" maxlength="50"
                        placeholder="請填入公司金鑰" data-validation-required-message="公司金鑰為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="license_VP"><span class="text-danger">(*)</span>證照有效期</label>
                  <input type="date" class="form-control" id="license_VP" name="license_VP" required>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="license_img"><span class="text-danger">(*)</span>證照上傳</label>
                  <div class="controls">
                    <input type="file" id="license_img" name="license_img" accept=".jpg, .jpeg, .png" onchange="previewFile()">
                    <img src="" alt="" class="slider-image" width="100%" height="150px" onclick="imgBtn()">
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
          </form>
        </div>
        
        {{--公司註冊--}}
        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <form class="form-horizontal" method="POST" action="{{ route('register') }}" novalidate>
            {{ csrf_field() }}
            <h3 class="register-heading">公司註冊</h3>
            <input type="hidden" name="permission" value="unit">
            <div class="row register-form">
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="name"><span class="text-danger">(*)</span>姓名</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="name" name="name" maxlength="10"
                      placeholder="請填入註冊人姓名" 
                      data-validation-required-message="姓名為必填"
                      required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="account"><span class="text-danger">(*)</span>帳號</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="account" name="account" maxlength="10"
                      placeholder="請填入註冊帳號"
                      data-validation-required-message="帳號為必填"
                      required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="email"><span class="text-danger">(*)</span>電子郵件</label>
                  <div class="controls">
                    <input type="email" class="form-control" id="email" name="email" maxlength="50"
                      placeholder="註冊後臨時密碼將寄到此信箱，請務必填寫正確"  required
                    data-validation-required-message="電子郵件為必填">
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>身分證字號</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="perid" name="perid" maxlength="10"
                      placeholder="請填入註冊人身份證字號"  data-validation-containsnumber-regex="^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$"
                        data-validation-containsnumber-message="請輸入正確身份證格式"
                        data-validation-required-message="身份證字號為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="telphone"><span class="text-danger">(*)</span>手耭號碼</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="telphone" name="telphone" maxlength="15"
                      placeholder="請填入註冊人手機號碼" data-validation-containsnumber-regex="^\(?(\d{2})\)?[\s\-]?(\d{3,4})\-?(\d{4})$"
                        data-validation-containsnumber-message="請輸入正確電話格式"
                        data-validation-required-message="手機號碼為必填"
                        required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="birther"><span class="text-danger">(*)</span>出生日期</label>
                  <input type="date" class="form-control" id="birther" name="birther" value="2000-01-01" required>                 
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="gender"><span class="text-danger">(*)</span>性別</label>
                  <div class="">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="radio" id="c_gender_m" name="gender" value="M">
                      <label class="label" for="c_gender_m">男</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="radio" id="c_gender_f" name="gender" value="F">
                      <label class="label" for="c_gender_f">女</label>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="c_name"><span class="text-danger">(*)</span>公司名稱</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="c_name" name="c_name" maxlength="50"
                        placeholder="請填入註冊公司名稱" data-validation-required-message="公司為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="c_addr"><span class="text-danger">(*)</span>公司地址</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="c_addr" name="c_addr"
                        placeholder="請填入註冊公司地址" data-validation-required-message="公司地址為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="tax_id"><span class="text-danger">(*)</span>統一編號</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="tax_id" name="tax_id"
                        placeholder="請填入註冊公司統編" data-validation-required-message="公司統編為必填" required>
                  </div>
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600 font-medium-5" for="c_tel"><span class="text-danger">(*)</span>公司電話</label>
                  <div class="controls">
                    <input type="text" class="form-control" id="c_tel" name="c_tel"
                        placeholder="請填入註冊公司電話" data-validation-required-message="公司電話為必填" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-center">
                <input type="checkbox" class="custom-control-input bg-primary" name="c_agreecheck" id="c_agreecheck" value="ok">
                <label class="custom-control-label font-medium-3" for="c_agreecheck">同意接受本站之<a target="_blank" href="/file/隱私權政策.pdf">隱私權政策</a>
                  <button type="submit" id="c_registBtn" class="btn btn-block btnRegister" disabled="disabled">註冊</button>
                </label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- register section endss -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')

@endsection

{{-- page scripts --}}
@section('page-scripts')

@endsection
@extends('auth.master')
@section('form_title' , '{{form_title[mode]}}')
@section('form_logo' , url('img/logo-register.svg'))
@section('title' , 'فرم ثبت نام سریع رویش وب')
@section('Ctrl' , 'RegisterCtrl')
@section('form_content')
    <form method="POST" action="<% url('auth/register') %>" name="register_form" ng-show="mode == 0">
        <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>
        <md-input-container>
            <label>نام و نام خانوادگی</label>
            <input ng-model="data.name" name="name" value="<% old('name') %>" ng-required="true">
        </md-input-container>

        <md-input-container>
            <label>ایمیل</label>
            <input type="email" ng-model="data.email" name="email"
                   ng-required="true">
        </md-input-container>

        <md-input-container>
            <label>کلمه عبور</label>
            <input type="password" ng-model="data.password" name="password" ng-minlength="6"
                   ng-required="true">

            <div ng-messages="register_form.password.$error">
                <div ng-message="minlength">
                    مقدار کلمه عبور حداقل 6 کاراکتر می باشد.
                </div>
            </div>
        </md-input-container>

        <md-input-container>
            <label>تکرار کلمه عبور</label>
            <input type="password" ng-model="data.password_confirmation" name="password_confirmation"
                   ng-required="true">
        </md-input-container>

        <div layout="row">

            <md-input-container flex="50">
                <label>کد امنیتی</label>
                <input type="text" ng-model="data.captcha" name="captcha"
                       ng-required="true">
            </md-input-container>
            <div flex="50" layout="row" layout-align="center center">
                <img src="<% captcha_src('flat') %>" alt=""/>
            </div>
        </div>

        <div ng-messages="register_form.$error">
            <div ng-message="required" class="notice-area ng-msg warning">
                پر کردن مقادیر ستاره دار الزامی است.
            </div>
            <div ng-message="pass" class="notice-area ng-msg error">
                مقادیر رمز عبور یکسان نیستند.
            </div>

        </div>
        <div ng-show="server_error">
            <div class="ng-msg error" ng-repeat="(key , item) in server_error">{{item[0]}}</div>
        </div>
        <md-button class="md-raised md-primary" style="width: 100%;margin: 0;" ng-click="submit($event)"
                   ng-disabled="register_form.$invalid">
            ثبت
            نام
        </md-button>
    </form>
@endsection
@section('result')
    <div class="form-description" ng-show="mode == 1">
        <p class="form-p">آقا / خانم <strong>{{ result.name }}</strong> از اینکه در <a href="<% url() %>">رویش وب</a>
            ثبت نام نمودید
            تشکر میکنیم.</p>

        <p class="form-p">
            ایمیلی جهت فعال سازی حساب کاربری شما به آدرس پست الکترونیکی شما ارسال خواهد شد. لطفا جهت فعال سازی حساب
            کاربری خود از این طریق اقدام کنید.
        </p>

        <div class="form-seprator"></div>
        <md-button class="md-raised md-primary" style="margin: 0;" href="<% url('auth/login') %>">
            ورود به رویش وب
        </md-button>
    </div>

    <div class="form-description" ng-show="mode == 2">
        <div class="notice-area ng-msg error">
            متاسفانه در روند ثبت نام شما ، مشکلی رخ داده است.
            </br>
            لطفا مجددا تلاش کنید.
        </div>
        <div class="form-seprator"></div>
        <md-button class="md-raised md-primary" style="margin: 0;" href="<% url('auth/register') %>">
            ثبت نام در رویش وب
        </md-button>
    </div>
@endsection
@extends('auth.master')
@section('form_title' , 'تغییر رمز عبور')
@section('form_logo' , url('img/lock-icon.png'))
@section('title' , 'تغییر رمز عبور')
@section('Ctrl' , 'LoginCtrl')
@section('form_content')
    <form method="POST" action="<% url('/password/reset') %>" name="login_form">
        <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>
        <input type="hidden" name="token" value="<% $token %>">

        <md-input-container>
            <label>ایمیل</label>
            <input type="email" ng-model="data.email" name="email"
                   ng-required="true">
        </md-input-container>

        <md-input-container>
            <label>رمز عبور</label>
            <input type="password" name="password">
        </md-input-container>

        <md-input-container>
            <label>تکرار رمز عبور</label>
            <input type="password" name="password_confirmation">
        </md-input-container>
        <md-button class="md-raised md-primary" style="width: 100%;margin: 0;"
                   ng-disabled="login_form.$invalid">تغییر رمز عبور</md-button>
        <div class="form-seprator"></div>
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="ng-msg error"><% $error %></li>
                @endforeach
            </ul>
        @endif
    </form>
@endsection
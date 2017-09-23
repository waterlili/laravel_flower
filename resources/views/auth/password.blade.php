@extends('auth.master')
@section('form_title' , 'فراموشی رمز عبور')
@section('form_logo' , url('img/lock-icon.png'))
@section('title' , 'فراموشی رمز عبور')
@section('Ctrl' , 'LoginCtrl')
@section('form_content')
    <form method="POST" action="<% url('/password/email') %>" name="login_form">
        <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>

        <md-input-container style="width: 100%;">
            <label>ایمیل</label>
            <input type="email" ng-model="data.email" name="email"
                   ng-required="true">
        </md-input-container>
        <md-button class="md-raised md-primary" style="width: 100%;margin: 0;"
                   ng-disabled="login_form.$invalid">درخواست تغییر رمز عبور
        </md-button>

        @if (isset($errors) && count($errors) > 0)
            <div class="form-seprator"></div>
            @foreach ($errors->all() as $error)
                <div class="ng-msg error"><% $error %></div>
            @endforeach
        @endif



        @if( Session::has('status'))
            <div class="form-seprator"></div>
            <div class="ng-msg info"><% Session::get('status') %></div>
        @endif
    </form>
@endsection
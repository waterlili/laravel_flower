@extends('auth.master')
@section('form_title' , 'رمز عبور با موفقیت تغییر کرد')
@section('form_logo' , url('img/lock-icon.png'))
@section('title' , 'رمز عبور با موفقیت تغییر کرد')
@section('Ctrl' , 'LoginCtrl')
@section('form_content')
        <md-button class="md-raised md-primary" href="<% url('/') %>" style="width: 100%;margin: 0;" >رفتن با صفحه اصلی</md-button>

        @if( Session::has('status'))
            <div class="form-seprator"></div>
            <div class="ng-msg info"><% Session::get('status') %></div>
        @endif
@endsection
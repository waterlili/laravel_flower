@extends('auth.master')
@section('form_title' , trans('login.page_title'))
@section('form_logo' , url('img/logo-login.svg'))
@section('title' , trans('login.page_title'))
@section('Ctrl' , 'LoginCtrl')
@section('form_content')
    <link href="<% url('/css/auth.css') %>" rel="stylesheet">
    <form method="POST" action="<% url('auth/login') %>" name="login_form">
        <input type="hidden" ng-model="data._token" name="_token" value="<% csrf_token() %>"/>
        <div layout="column">
            <md-input-container flex class="md-accent">
                <label><% trans('login.email') %></label>
                <input type="email" ng-model="data.email" name="email"
                       ng-required="true">
            </md-input-container>

            <md-input-container flex class="md-accent">
                <label><% trans('login.password') %></label>
                <input type="password" ng-model="data.password" name="password"
                       ng-required="true">
            </md-input-container>
            <md-checkbox ng-model="data.remember">
                <% trans('login.remember_me') %>
            </md-checkbox>
        </div>
        <div ng-show="server_error">
            <div class="ng-msg error" ng-repeat="(key , item) in server_error">{{item[0]}}</div>
        </div>
        <div class="ng-msg error" ng-show="unauthorized"><% trans('login.unauthorized') %></div>
        <div class="ng-msg error" ng-show="not_acceptable"><% trans('login.not_acceptable') %></div>
        <md-button type="submit" class="md-raised md-primary" style="width: 100%;margin: 0;" ng-click="submit($event)"
                   ng-disabled="login_form.$invalid">
            <% trans('login.login') %>
        </md-button>
        <div class="form-seprator"></div>
        <div class="form-description">
            <div class="form-sep"></div>
            <a href="<% url('password/email') %>"><% trans('login.forgotten') %></a>
        </div>
    </form>
@endsection


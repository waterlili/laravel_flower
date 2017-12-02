<?php
$inputsName = [
        'captcha',
        'username',
        'password',

];

$inputRequired = [
        'captcha',
        'username',
        'password',
];


$inputs = [];
foreach ($inputsName as $item) {
    $inputs[$item] = new \App\View\InputObject('data.' . $item, trans('register.' . $item));
    $inputs[$item]->setName($item);
    $inputs[$item]->hasMessage('FONE');
}
$inputs[$item]->setType('password');
foreach ($inputRequired as $reqItem) {
    $inputs[$reqItem]->setRequired(true);
}
$no_top_header = true;
?>
@extends('register.master')
@section('title' , trans('register.page_1_header_title'))
@section('content')
    <div class="md-bg md-background p-md-nmd" ng-controller="EntranceCtrl">
        <div class="cm" >
            @include('register.block.notice' , ['type'=>'info' , 'text'=>'کاربر گرامی در صورتی که شما تا به حال در سامانه ثبت نام ننموده اید دکمه برای اولین با از سامانه استفاده میکنم'])
            <div flex style="max-width: 350px; margin: auto">
                <form name="FONE">
                    <div>@include('MD.input.text' , $inputs['username']->export())</div>
                    <div>@include('MD.input.text' , $inputs['password']->export())</div>
                    <div class="ar-divider"><span class="ar-line"></span></div>
                    <!-- Forth Row - Captcha  -->
                    <span ng-init="captchaSrc = '<% captcha_src('flat') %>'"></span>
                    <div class="fset" layout-align="center start">

                        <img src="{{captchaSrc}}" alt="captcha">
                        <md-button ng-click="refreshCaptcha()" class="md-icon-button md-primary">
                            <md-tooltip>کد دیگر را امتحان میکنم</md-tooltip>
                            <i class="material-icons">&#xE5D5;</i></md-button>
                        <div flex-gt-md="33" id="captcha-input-wrapper">
                            @include('MD.input.text' , $inputs['captcha']->export())
                        </div>

                    </div>

                    <div class="ar-divider"><span class="ar-line"></span></div>
                    <div class="area-notice">
                        @include('register.block.notice' , ['repeat'=>'errorItem','type'=>'error'])
                        @include('register.block.notice' , ['repeat'=>'infoItem','type'=>'info'])
                    </div>
                    @include('register.block.preloader')
                    <div>
                        <md-button class="md-raised md-primary" layout="row" layout-align="center center"
                                   ng-click="submit()"
                                   type="submit"
                                   ng-disabled="FONE.$invalid"
                        ><i class="material-icons">&#xE876;</i>ورود به فرآیند ثبت نام
                        </md-button>
                        <md-button class="md-warn" layout="row"
                                   ng-href="<% url('register/new') %>">برای اولین بار در سامانه ثبت نام می کنم
                        </md-button>

                        <md-button class="md-accent" layout="row"
                                   ng-href="<% url('register') %>">رمز عبورم را فراموش کرده ام</md-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
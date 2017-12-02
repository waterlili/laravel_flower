<?php
$fname = new \App\View\InputObject('data.fname', trans('public.fname'));
$lname = new \App\View\InputObject('data.lname', trans('public.lname'));
$email = new \App\View\InputObject('data.email', trans('public.email'));
$mobile = new \App\View\InputObject('data.mobile', trans('public.mobile'));
$captcha = new \App\View\InputObject('data.captcha', trans('public.captcha'));
$password = new \App\View\InputObject('data.password', trans('public.password'));
$confirm = new \App\View\InputObject('data.confirm', trans('public.confirm'));

$ncode = new \App\View\InputObject('data.ncode', trans('public.ncode'));

$iban = new \App\View\InputObject('data.iban', trans('public.iban'));
//$iban_fname = new \App\View\InputObject('data.iban_fname', trans('public.iban_fname'));
//$iban_lname = new \App\View\InputObject('data.iban_lname', trans('public.iban_lname'));

$fname->setRequired(true);
$lname->setRequired(true);
$mobile->setRequired(true);
$captcha->setRequired(true);
$email->setRequired(true);
$password->setRequired(true);
$confirm->setRequired(true);
$iban->setRequired(true);
$ncode->setRequired(true);


$fname->hasMessage('Form', 'fname');
$lname->hasMessage('Form', 'lname');
$mobile->hasMessage('Form', 'mobile');
$captcha->hasMessage('Form', 'captcha');
$email->hasMessage('Form', 'email');
$password->hasMessage('Form', 'password');
$confirm->hasMessage('Form', 'confirm');
$iban->hasMessage('Form', 'iban');
$ncode->hasMessage('Form', 'ncode');

$email->setType('email');
$password->setType('password');
$confirm->setType('password');
//$mobile->numeric();
$confirm->setInpAttr('match-password=password');
$confirm->setMessage('passwordMatch', trans('public.password_not_match'));

$iban->setInpAttr('ui-mask=****-****-9999-9999-9999');
$mobile->setInpAttr('international-phone-number');
$mobile->setInpAttr('id=phone-number');
$mobile->setInpAttr('country=country');
?>

@extends('public.master')
@section('header')
    @include('public.header')
@endsection
@section('footer')
    @include('public.footer')
@endsection
@section('content')
    <main id="main" ng-controller="SignupCtrl">
        <div class="cn-md p-md" style="max-width: 1280px" layout-gt-md="row" layout-align="start start">

            <div flex-gt-md="66" class="p-md w-box" id="public-form">
                <form name="Form">
                    <h2 class="mv-md b md-fg md-primary"><% trans('public.sign_up') %></h2>
                    <div layout-gt-md="row">
                        <div flex-gt-md="50">
                            <fieldset class="p-md mb-md">
                                <legend><% trans('public.form_personal_name') %></legend>

                                <div layout-gt-md="row">
                                    <div flex-gt-md="50">
                                        @include('MD.input.text' , $fname->export())
                                    </div>
                                    <div class="pl-md-md"></div>
                                    <div flex-gt-md="50">
                                        @include('MD.input.text' , $lname->export())
                                    </div>
                                </div>
                                @include('MD.input.text' , $ncode->export())
                            </fieldset>
                            <fieldset class="mb-md">
                                <legend><% trans('public.password_of_account') %></legend>
                                <div>
                                    <div>
                                        <label class="md-required"><% trans('public.password') %></label>
                                        @include('MD.input.text' , array_merge($password->export() , ['noLabel'=>TRUE]))
                                    </div>
                                    <div>
                                        <label class="md-required"><% trans('public.confirm_password') %></label>
                                        @include('MD.input.text' , array_merge($confirm->export() , ['noLabel'=>TRUE]))
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mb-md">
                                <legend><% trans('public.iban_info') %></legend>
                                <div>
                                    <label class="md-required"><% trans('public.iban') %></label>
                                    @include('MD.input.text' , array_merge($iban->export() , ['noLabel'=>TRUE]))
                                </div>
                            </fieldset>
                        </div>
                        <div flex-gt-md="50" class="ml-md-md">
                            <fieldset class="p-md mb-md">
                                <legend><% trans('public.form_email') %></legend>
                                <label class="md-required"><% trans('public.email') %></label>
                                @include('MD.input.text' , array_merge($email->export() , ['noLabel'=>TRUE]))
                                <md-divider class="mv-md"></md-divider>
                                <label class="md-required"><% trans('public.mobile') %></label>
                                @include('MD.input.text' , array_merge($mobile->export() , ['noLabel'=>TRUE]))
                            </fieldset>
                            <fieldset class="p-md mb-md">
                                <div layout="row">
                                    <img src="{{captcha_src}}" alt="">
                                    <span flex ng-init='captcha_src = "<% captcha_src("flat") %>"'></span>
                                    <md-button class="md-icon-button" ng-click="refresh_captcha()">
                                        <i class="material-icons md-dark">&#xE5D5;</i>
                                        <md-tooltip><% trans('public.refresh_captcha') %></md-tooltip>
                                    </md-button>
                                </div>
                                <div class="mt-md"></div>
                                @include('MD.input.text' , $captcha->export())
                            </fieldset>
                        </div>
                    </div>


                    @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'errorItem'])
                    <md-button class="m-n mv-md md-primary md-raised"
                               ng-disabled="Form.$invalid"
                               ng-click="submit()"><% trans('public.register')%>
                    </md-button>
                </form>
            </div>
            <div flex-gt-md="33" class="p-md w-box ml-md-md">
                <img src="<% url('img/sign-up.jpg') %>" alt="" style="max-width: 100%">

                <h3 class="tac"><a href="<% url('sign-in') %>">Already Register? Sign-in</a></h3>
            </div>

        </div>
        <div>

        </div>
        </div>
    </main>
@endsection
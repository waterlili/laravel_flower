<?php
$fname = new \App\View\InputObject('data.fname', trans('field.fname'));
$lname = new \App\View\InputObject('data.lname', trans('field.lname'));
$email = new \App\View\InputObject('data.email', trans('field.email'));

$fname->setRequired(true);
$lname->setRequired(true);
$email->setRequired(true);

$passwrod_old = new \App\View\InputObject('pass.old', trans('field.current_password'));
$passwrod = new \App\View\InputObject('pass.new', trans('field.new_password'));
$passwrod_confirm = new \App\View\InputObject('pass.confirm', trans('field.confirm'));

$passwrod_old->setType('password');
$passwrod->setType('password');
$passwrod_confirm->setType('password');

$passwrod_old->setRequired(true);
$passwrod->setRequired(true);
$passwrod_confirm->setRequired(true);

$passwrod->hasMessage('PassForm', 'new');
$passwrod_old->hasMessage('PassForm', 'old');
$passwrod_confirm->hasMessage('PassForm', 'confirm');
$passwrod_confirm->setMessage('confirm', trans('validation.password_not_match'));

?>
<section layout-gt-md="row" layout-align="start start">

    <div flex-gt-md="33" class="w-box">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h4>پروفایل من</h4>
            </div>
        </md-toolbar>
        <div class="p-md">
            <form name="FONE">
                @include('MD.input.text' , $fname->export())
                @include('MD.input.text' , $lname->export())
                @include('MD.input.text' , $email->export())
                <div class="image-thumb">
                    <img src="{{data.personal.url}}" alt="">
                </div>
                @include('register.block.uploader' , [
        'class_color'=>'md-primary',
        'top_title'=>'بارگذاری تصویر کاربری',
        'top_description'=>'فایل می بایست از نوع تصویر بوده و حداکثر 500 کیلوبایت باشد.',
        'title'=> 'انتخاب فایل',
        'accept'=>"'image/*'",
        'max_size'=>'500KB',
        'types'=>'jpg',
        'model'=>'data.personal',
        'name'=>'personal_picture',
        ])
                <md-button class="md-primary md-raised" ng-click="edit()" ng-disabled="FONE.$invalid">
                    ویرایش پروفایل
                </md-button>
            </form>
        </div>
    </div>
    <div flex-gt-md="33" class="w-box  mr-md-md">
        <md-toolbar class="md-warn">
            <div class="md-toolbar-tools">
                <h4>تغییر رمز عبور</h4>
            </div>
        </md-toolbar>
        <div class="p-md">
            <form name="PassForm">
                @include('MD.input.text' , $passwrod_old->export())
                @include('MD.input.text' , $passwrod->export())
                @include('MD.input.text' , $passwrod_confirm->export())
                @include('MD.Notice.notice' , ['repeat'=>'errorItem' , 'type'=>'error'])
                <md-button class="md-warn md-raised" ng-click="password()" ng-disabled="PassForm.$invalid">
                    تغییر رمز عبور
                </md-button>
            </form>
        </div>
    </div>
</section>
<?php
$inputsName = [
        'fname',
        'lname',
        'father_name',
        'ncode',
        'iden_code',
        'where_birth',
        'mother_name',
        'address',
        'zip_code',
        'phone',
        'mobile',
        'f_phone',
        'f_mobile',
        'f_work',
        'f_work_phone',
        'father_job',
        'illnes',
        'email',
        'bank_no',
        'bank_card',
        'captcha',

];

$inputRequired = [
        'fname',
        'lname',
        'father_name',
        'ncode',
        'iden_code',
        'address',
        'phone',
        'zip_code',
        'mobile',
        'f_mobile',
        'illnes',
        'email',
        'captcha',
];


$inputs = [];
foreach ($inputsName as $item) {
    $inputs[$item] = new \App\View\InputObject('data.' . $item, trans('register.' . $item));
    $inputs[$item]->setName($item);
    $inputs[$item]->hasMessage('FONE');
}

foreach ($inputRequired as $reqItem) {
    $inputs[$reqItem]->setRequired(true);
}


$inputs['ncode']->setMessage('ncode', trans('validation.ncode'));
$inputs['ncode']->setInpAttr('ncode-validity');
$inputs['phone']->setPattern('/^\d{10}$/');
$inputs['mobile']->setPattern('/^\d{10}$/');
$inputs['f_mobile']->setPattern('/^\d{10}$/');
$inputs['zip_code']->setPattern('/^\d{10}$/');

?>

@extends('register.master')
@section('title' , trans('register.page_1_header_title'))
@section('header_title' , trans('register.page_1_header_title'))
@section('header_description' , trans('register.page_1_header_description'))
@section('content')
    <div class="md-bg md-background p-md-nmd" ng-controller="StepOneCtrl">
        <div class="cm" layout-gt-md="row" flex="grow">
            <div class="step-bar-wrapper" show-gt-md hide layout-padding>
                <div class="step-bar"></div>
                <div layout="row" class="step-item" layout-align="center center">
                    <div class="step-bar-number active">1</div>
                </div>
            </div>
            <div flex>
                <form name="FONE">


                    <!-- First Row  -->
                    <h3 class="mv-md"><% trans('register.from_title_one') %></h3>
                    @include('register.block.notice' , ['type'=>'info' , 'text'=>trans('register.required_field')])
                    @include('register.block.divider' , ['icon'=>'&#xE8A6;' , 'title'=>trans('register.iden_info')])
                    <div class="fset" layout-gt-md="row" layout-align="space-between start">
                        @foreach(['fname' , 'lname' , 'ncode' ,'iden_code'] as $item)
                            @if(isset($inputs[$item]))
                                <div class="ml-sm-md" flex>
                                    @include('MD.input.text',$inputs[$item]->export())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="fset" layout-gt-md="row" layout-align="space-between start">
                        @foreach(['where_birth' , 'father_name' , 'mother_name' , 'father_job'] as $item)
                            @if(isset($inputs[$item]))
                                <div class="ml-sm-md" flex>
                                    @include('MD.input.text',$inputs[$item]->export())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="fset" layout-gt-md="row" layout-align="space-between start">
                        <div layout="column" flex-gt-md="50" class="input-cnt ml-md-md">
                            <div class="ph-sm">
                                <label for="sex"><% trans('register.sex') %></label>
                                <md-radio-group ng-model="data.gender" layout="row" layout-padding ng-required="true">
                                    <md-radio-button value="1"
                                                     class="md-primary">
                                        <div layout="column" layout-align="center center">
                                            <img width="100px" src="<% url('img/male-profile.png') %>" alt="">
                                            <span><% trans('register.male') %></span>
                                        </div>
                                    </md-radio-button>
                                    <div flex></div>
                                    <md-radio-button value="0"
                                                     class="md-primary">
                                        <div layout="column" layout-align="center center">
                                            <img width="100px"
                                                 src="<% url('img/women-profile.png') %>"
                                                 alt="">
                                            <span><% trans('register.female') %></span>
                                        </div>
                                    </md-radio-button>
                                </md-radio-group>
                            </div>
                        </div>
                        <div layout="column" flex-gt-md="50">
                            @include('register.block.birth_date' , ['formName'=>'FONE' ,'model'=>'data.birth_date' , 'data_model'=>'birth_date_data'])
                        </div>
                    </div>

                    <!-- Secend Row  -->
                    @include('register.block.divider' , ['icon'=>'&#xE0CD;' , 'title'=>trans('register.phone_info')])
                    @include('register.block.notice' , ['type'=>'warn' , 'text'=>trans('register.valid_phone')])
                    <div class="fset" layout-gt-md="row" layout-align="space-between start">
                        @foreach(['phone' , 'mobile' , 'f_mobile'] as $item)
                            @if(isset($inputs[$item]))
                                <div class="ml-sm-md" flex>
                                    @include('MD.input.text',$inputs[$item]->export())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="fset" layout-gt-md="row" layout-align="space-between start">
                        @foreach(['email' , 'f_phone'] as $item)
                            @if(isset($inputs[$item]))
                                <div class="ml-sm-md" flex>
                                    @include('MD.input.text',$inputs[$item]->export())
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Three Row  - Address And ZipCode -->
                    @include('register.block.divider' , ['icon'=>'&#xE0C8;' , 'title'=>trans('register.address_info')])
                    <div class="fset" layout-gt-md="row" layout-align="start start">
                        @if(isset($inputs['state']))
                            <md-input-container flex-gt-md="33" class="ml-md-md mb-xxl mt-n">
                                <label><% trans('register.state') %></label>
                                <md-select ng-model="data.state" ng-required="true" md-on-close="data.clearCity()">
                                    <md-option ng-repeat="item in data.stateRow" value="{{$index+1}}">
                                        {{item}}
                                    </md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container flex-gt-md="33" class="ml-md-md mb-xxl mt-n">
                                <label><% trans('register.city') %></label>
                                <md-select ng-model="data.city" ng-required="true" md-on-open="data.loadCity()">
                                    <md-option ng-repeat="item in data.cityRow" value="{{$index+1}}">
                                        {{item}}
                                    </md-option>
                                </md-select>
                            </md-input-container>
                        @endif
                    </div>
                    <div class="fset" layout-gt-md="row" layout-align="start start">
                        @if(isset($inputs['address']))
                            <div flex-gt-md="75"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['address']->export())
                            </div>
                        @endif
                        @if(isset($inputs['zip_code']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['zip_code']->export())
                            </div>
                        @endif
                    </div>


                    <!-- Forth Row - Captcha  -->
                    @include('register.block.divider' , ['icon'=>'&#xE90D;' , 'title'=>trans('register.captcha')])
                    <span ng-init="captchaSrc = '<% captcha_src('flat') %>'"></span>
                    <div class="fset" layout-gt-md="row" layout-align="center start">

                        <img src="{{captchaSrc}}" alt="captcha">
                        <div flex-gt-md="33" id="captcha-input-wrapper">
                            @include('MD.input.text' , $inputs['captcha']->export())
                        </div>
                        <md-button ng-click="refreshCaptcha()" class="md-icon-button md-primary">
                            <md-tooltip>کد دیگر را امتحان میکنم</md-tooltip>
                            <i class="material-icons">&#xE5D5;</i></md-button>
                    </div>

                    <div class="ar-divider"><span class="ar-line"></span></div>
                    <div class="area-notice">
                        @include('register.block.notice' , ['repeat'=>'errorItem','type'=>'error'])
                        @include('register.block.notice' , ['repeat'=>'infoItem','type'=>'info'])
                        @include('register.block.notice' , ['type'=>'warn' , 'text'=>'داوطلب گرامی! وارد کردن فیلد های ستاره دار الزامی است. لذا تا زمانی که فیلد های مورد نظر پر نگردیده است امکان ثبت نام وجود ندارد.'])
                    </div>
                    @include('register.block.preloader')
                    <div layout-gt-md="row">
                        <div flex></div>
                        <md-button class="md-raised md-primary" layout="row" layout-align="center center"
                                   ng-click="submit()"><i
                                    class="material-icons">&#xE876;</i> <% trans('register.submit') %></md-button>


                        @if(\Illuminate\Support\Facades\App::environment('local'))
                            <md-button class="md-primary" layout="row" layout-align="center center"
                                       ng-click="import()">درون ریزی
                            </md-button>
                            <md-button class="md-primary" layout="row" layout-align="center center"
                                       ng-click="csession()">clear session
                            </md-button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('register.block.stepDown' , ['page'=>1])
@endsection
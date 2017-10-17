<?php
$fname = \App\View\Text::create('data.fname', 'نام')->form()->setRequired(true)->export();
$lname = \App\View\Text::create('data.lname', 'نام خانوادگی')->form()->setRequired(true)->export();
$email = \App\View\Text::create('data.email', 'ایمیل')->form()->setRequired(true)->setType('email')->export();
$type = \App\View\Select::create('data.type', 'نحوه جذب', \App\DB\User::CUSTOMER_TYPE())
        ->setRequired(true)
        ->form()
        ->export();
$job = \App\View\Text::create('data.job', 'تخصص')->export();
$skill = \App\View\Text::create('data.skill', 'مهارت')->export();
$address = \App\View\Text::create('data.address', 'آدرس')->export();
$address2 = \App\View\Text::create('data.address2', 'آدرس دوم')->export();
$zip_code = \App\View\Text::create('data.zip_code', 'کد پستی')->form()->numeric()->export();
$mobile = \App\View\Text::create('data.mobile', 'موبایل')->setInpAttr('ui-mask=9999-999-9999')->form()->export();
$description = \App\View\Text::create('data.description', 'توضیح خاص مشتری')->form()->export();
$phone = \App\View\Text::create('data.phone', 'تلفن')->setInpAttr('ui-mask=9999-999-9999')->form()->export();
$job_type = \App\View\Select::create('data.job', 'رسته شغلی', \App\DB\User::$JOBTYPES)->export();
$sts = \App\View\Select::create('data.sts', 'وضعیت کاربر', \App\DB\User::$STATUS)->setRequired(true)->form()->export();
$att_type = \App\View\Select::create('data.att_type', 'نحوه جذب', \App\DB\UserInfo::$ATTTYPE)->export();
$attraction = \App\View\Text::create('data.attraction', 'معرف')->export();
$group = App\View\Text::create('group.text', 'عنوان گروه')->form()->export();
$select = \App\View\UiSelect::create('group.parent', 'گروه پدر', 'group.all', 'title')->export();
?>
@extends('admin.block.form')
@section('form')
    <div layout="row" layout-align="start center">
        <div class="ui search" use-search="cus" ng-model="customer">
            <div class="ui icon input">
                <input class="prompt" type="text" placeholder="جستجو مشتری" ng-model="cus.search">
                <i class="search icon"></i>
            </div>
            <div class="results"></div>
        </div>
        <div flex></div>
        <div>
            <md-button class="md-raised md-primary" ng-disabled="!customer" ng-click="getData()">بررسی اطلاعات
            </md-button>
        </div>
    </div>
    <div layout-gt-md="row">
        <div flex-gt-md="100">
            <fieldset class="m-sm">
                <div layout-gt-md="row" layout-align="start start">
                    <div flex-gt-md="33">
                        @include('MD.input.text-sm' , $fname)
                    </div>
                    <div flex-gt-md="33" class="mr-md-md">
                        @include('MD.input.text-sm' , $lname)
                    </div>
                    <div flex-gt-md="33" class="mr-md-md">
                        <div layout-gt-md="row">
                            <div class="ui buttons mb-md">
                                <button class="ui button disabled ">
                                    <span>جنسیت</span>

                                </button>
                                <button class="ui button" ng-click="data.gender = 1"
                                        ng-class="{'active teal':data.gender == 1}">
                                    <span>مرد</span>
                                </button>
                                <button class="ui button" ng-click="data.gender = 2"
                                        ng-class="{'active pink':data.gender == 2}">
                                    <span>زن</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div layout-gt-md="row" layout-align="start center">
                    <div flex-gt-md="25">
                        @include('MD.input.text-sm' , $mobile)

                    </div>
                    <div flex-gt-md="25" class="mh-md-md">
                        @include('MD.input.text-sm' , $phone)
                    </div>
                    <div flex-gt-md="50">
                        @include('MD.input.text-sm' , $email)

                    </div>
                </div>
                <div>
                    @include('MD.input.text-sm' , $address)
                </div>
                <div layout-gt-md="row">
                    <div flex-gt-md="33" class="ml-md-md">

                        @include('MD.input.select-sm' , $job_type)
                    </div>
                    <div flex-gt-md="33" class="ml-md-md">
                        @include('MD.input.text-sm' , $skill)
                    </div>
                    <div flex-gt-md="33">
                        @include('MD.input.select-sm' , $type)
                    </div>
                </div>

                @include('MD.input.text-sm' , $description)
            </fieldset>
        </div>

        <div flex-gt-md="33" ng-if="false">
            <fieldset>
                <legend>گروه بندی</legend>
                <div class="p-md">
                    <fieldset>
                        <legend>گروه</legend>
                        <div style="overflow: auto;max-height: 250px">
                            <group-collection collection='group.all'
                                              url="console/group-collection"></group-collection>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>افزودن گروه</legend>
                        <div>
                            <div layout="row" layout-align="start center">
                                @include('MD.input.text' , $group)

                                <md-button class="md-raised md-primary" ng-click="group.add()"
                                           ng-disabled="!group.text || group.loading">افزودن
                                </md-button>
                            </div>
                            <md-divider class="mv-md"></md-divider>
                            <div>گروه پدر</div>
                            @include('MD.input.ui-select' , $select)
                            @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'group.errorItem'])
                        </div>

                    </fieldset>
                </div>
            </fieldset>
            <fieldset class="mt-md">
                <div class="p-md">
                    @include('MD.input.select' , $sts)
                </div>
            </fieldset>
            <fieldset class="mt-md">
                <legend>جذب و معرفی</legend>
                <div class="p-md">
                    @include('MD.input.select' , $att_type)
                    @include('MD.input.text' , $attraction)
                </div>
            </fieldset>
        </div>

    </div>
@endsection
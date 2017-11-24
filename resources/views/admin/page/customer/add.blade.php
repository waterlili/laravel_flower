<?php
$fname = \App\View\Text::create('data.fname', 'نام')->form()->setRequired(true)->export();
$lname = \App\View\Text::create('data.lname', 'نام خانوادگی')->form()->setRequired(true)->export();
$email = \App\View\Text::create('data.email', 'ایمیل')->form()->setRequired(false)->setType('email')->export();
$skill = \App\View\Select::create('data.skill_id', 'مهارت', \App\DB\Cnt::whereW(8)->pluck('title', 'id')->toArray())->export();
$address = \App\View\Text::create('data.address', 'آدرس')->export();
$mobile = \App\View\Text::create('data.mobile', 'موبایل')->setRequired(true)->form()->export();
$description = \App\View\Text::create('data.description', 'توضیح خاص مشتری')->form()->export();
$phone = \App\View\Text::create('data.phone', 'تلفن')->form()->export();
$job_type = \App\View\Select::create('data.job_id', 'شغل', \App\DB\Cnt::whereW(6)->pluck('title', 'id')->toArray())->export();
$sts = \App\View\Select::create('data.sts', 'وضعیت کاربر', \App\DB\User::$STATUS)->setRequired(true)->form()->export();
$attraction = \App\View\Select::create('data.type_attraction_id', 'نحوه جذب', \App\DB\Cnt::whereW(7)->pluck('title', 'id')->toArray())
    ->setRequired(true)
    ->form()
    ->export();

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
                        @include('MD.input.text-md' , $fname)
                    </div>
                    <div flex-gt-md="33" class="mr-md-md">
                        @include('MD.input.text-md' , $lname)
                    </div>
                    <div flex-gt-md="33" class="mr-md-md gen-pos">

                        <div class="ui buttons">
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

                <div layout-gt-md="row" layout-align="start start">
                    <div flex-gt-md="33">
                        @include('MD.input.text-md' , $mobile)
                    </div>
                    <div flex-gt-md="33" class="mh-md-md">
                        @include('MD.input.text-md' , $phone)
                    </div>
                    <div flex-gt-md="33" class="mr-md-md">
                        @include('MD.input.text-md' , $email)

                    </div>
                </div>

                <div layout-gt-md="row">

                    <div flex-gt-md="33" class="ml-md-md">

                        @include('MD.input.select-sm' , $job_type)
                    </div>
                    <div flex-gt-md="33" class="ml-md-md">
                        @include('MD.input.select-sm' , $skill)
                    </div>
                    <div flex-gt-md="33">
                        @include('MD.input.select-sm' , $attraction)
                    </div>
                </div>
                <div layout-gt-md="row">

                    @include('MD.input.textarea' , $address)

                </div>
                <div layout-gt-md="row">

                    @include('MD.input.textarea' , $description)
                </div>
            </fieldset>
        </div>

    </div>
@endsection
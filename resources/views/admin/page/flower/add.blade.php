<?php
$name = \App\View\Text::create('data.name', 'نام گل')->setRequired(true)->form()->export();
$nemad = \App\View\Text::create('data.nemad', 'نماد گل')->setRequired(true)->form()->export();
$vahed = \App\View\Select::create('data.vahed', 'واحد', \App\DB\Flower::vahed())
    ->setRequired(true)
    ->form()
    ->export();
$price = \App\View\Text::create('data.price', 'مبلغ محصول')
    ->setRequired(true)
    ->form()
    ->export();
$rade = \App\View\Select::create('data.rade', 'رده قیمتی', \App\DB\Flower::radeGheimati())
    ->setRequired(true)
    ->form()
    ->export();
$has_boo = \App\View\Select::create('data.has_boo', 'آیا بو دارد؟', \App\DB\Flower::has_or_not())
    ->setRequired(true)
    ->form()
    ->export();
$saghe = \App\View\Select::create('data.saghe', 'ساقه', \App\DB\Flower::saghe())
    ->setRequired(true)
    ->form()
    ->export();
$mandegari = \App\View\Select::create('data.mandegari', 'ماندگاری', \App\DB\Flower::mandegari())
    ->setRequired(true)
    ->form()
    ->export();
$comp_flower = \App\View\Text::create('comp.flower', 'رنگ')->setRequired(false)->form()->export();
$comp_image = \App\View\Text::create('comp.image', 'تصویر')->setRequired(false)->form()->export();
?>
@extends('admin.block.form')
@section('form')
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $name)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $nemad)
        </div>
    </div>

    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $vahed)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' , $price)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $rade)
        </div>
    </div>
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $has_boo)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.select-sm' , $saghe)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.select-sm' , $mandegari)
        </div>
    </div>

    <fieldset>
        <legend>تنوع گل</legend>
        <div layout-gt-md="row" layout-align="start center">
            <div flex-gt-md="35">
                @include('MD.input.text-sm' , $comp_flower)
            </div>
            <div flex-gt-md="35">
                <div class="image-thumb">
                    <img src="{{data.personal.url}}" alt="">
                </div>
                @include('register.block.uploader' , [
                    'class_color'=>'md-primary',
                    'top_title'=>'بارگذاری تصویر گل',
                    'top_description'=>'فایل می بایست از نوع تصویر بوده و حداکثر 500 کیلوبایت باشد.',
                    'title'=> 'انتخاب فایل',
                    'accept'=>"'image/*'",
                    'max_size'=>'500KB',
                    'types'=>'jpg',
                    'model'=>'data.flower_picture',
                    'name'=>'flower_picture',
                    ])
                @include('MD.input.text-sm' , $comp_image)
            </div>
            <div flex></div>
            <div>
                <md-button class="md-icon-button md-raised md-primary" ng-click="comp.add()" layout="row"
                           layout-align="center center" ng-disabled="!(comp.flower && comp.image)">
                    <i class="material-icons md-18">add</i>
                    <md-tooltip>اضافه کردن ردیف</md-tooltip>
                </md-button>
            </div>
        </div>
        <md-divider class="mv-md"></md-divider>
        <div layout="row">
            <div ng-repeat="item in data.composit">
                <fieldset class="mv-sm chip-item">
                    <div layout-gt-md="row" layout-align="start center">
                        <i class="material-icons md-18 md-warn" ng-click="comp.remove($index)">close</i>

                        <h3>{{item.flower}} </h3>
                        <i class="md-fg md-warn"> ({{item.image}})</i>
                    </div>
                </fieldset>
            </div>
        </div>
    </fieldset>
@endsection
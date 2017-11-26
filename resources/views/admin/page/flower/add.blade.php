<?php
$name = \App\View\Select::create('data.name', 'نام', \App\DB\Cnt::where('w', 1)->pluck('title', 'id')->toArray())->setRequired(true)->form()->export();
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
$color = \App\View\Select::create('data.color', 'رنگ', \App\DB\Cnt::where('w', 5)->pluck('title', 'id')->toArray())->setRequired(false)->form()->export();

?>
@extends('admin.block.form')
@section('form')
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $name)
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
        <legend>تنوع گل
            <div>
                <md-button class="md-icon-button md-raised md-primary" ng-click="addVariety()" layout="row"
                           layout-align="center center">
                    <i class="material-icons md-18">add</i>
                    <md-tooltip>اضافه کردن ردیف</md-tooltip>
                </md-button>
            </div>
        </legend>
        <div class="ui styled accordion" style="width: 100%">

            <div class="title" layout="row" layout-align="start center" data-ng-init="init()"
                 ng-repeat-start="item in data.new_case">


                <i class="material-icons">add_a_photo</i><i class="material-icons">color_lens</i>


                <div flex></div>
                <div>
                    <i class="icon trash red color  " ng-click="removenewVariety(item)"></i>
                </div>
            </div>
            <div class="content active" ng-repeat-end>
                <div class="p-md">
                    <div layout-gt-md="row" layout-align="start center">
                        <div class="ui fluid search selection dropdown ml-md-md mb-xl" use-dropdown
                             ng-model="item.color"
                             style="margin-top: 4px;">
                            <i class="dropdown icon"></i>
                            <div class="default text">رنگ</div>
                            <div class="menu">
                                @foreach(\App\DB\Cnt::where('w', 5)->get() as $item)
                                    <div class="item"
                                         data-value="<% $item['title'] %>"><% $item['title'] %>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                <!--<div layout-gt-md="row" layout-align="start center">
                        <div class="button select_multi" ngf-select name="files{{$index}}" ng-model="item.files[$index]" ngf-multiple="true"
                             ng-change="imageUpload(item,event)" style="position: relative">
                            <i class="material-icons">cloud_upload</i> &nbsp;انتخاب تصاویر مربوط به گل
                            <div id="myDiv{{$index}}" class="image-thumb img-wrap pull-left"
                                 ng-repeat="item in stepsModel" >

                                <img ngf-thumbnail="item">

                            </div>
                        </div>
                    </div>-->



                </div>
            </div>
        </div>
    </fieldset>




@endsection
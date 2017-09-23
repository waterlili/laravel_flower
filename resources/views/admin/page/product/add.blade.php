<?php
$title = \App\View\Text::create('data.title', 'عنوان محصول')->setRequired(true)->form()->export();
$code = \App\View\Text::create('data.code', 'کد محصول')->setRequired(true)->form()->export();
$description = \App\View\Text::create('data.description', 'توضیح مختصر')->form()->export();
$price = \App\View\Text::create('data.price', 'مبلغ محصول')
        ->setRequired(true)
        ->setInpAttr('format-as-currency')
        ->form()
        ->export();
$pack_type = \App\View\Select::create('data.pack_type', 'نوع محصول', \App\DB\Product::PACK_TYPE())
        ->setRequired(true)
        ->form()
        ->export();
$check = \App\View\Checkbox::create('data.is_active', 'آیا محصول فعال است؟')->hasBorder()->export();


$comp_flower = \App\View\Ac::create('comp.flower', 'comp.flowerOpt', 'console/product/get-flowers', 'نام گل')->export();
$comp_total = \App\View\Text::create('comp.total', 'تعداد')->numeric()->export();

?>
@extends('admin.block.form')
@section('form')
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.text' ,  $title)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text' ,  $code)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text' ,  $price)
        </div>
    </div>
    <div>
        @include('MD.input.text' , $description)
    </div>
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.select' ,  $pack_type)
        </div>
        <div flex-gt-md="33">
            {!! $check !!}
        </div>
    </div>

    <fieldset>
        <legend>تعلقات محصول</legend>
        <div layout-gt-md="row" layout-align="start center">
            <div flex-gt-md="25">
                {!! $comp_flower !!}
            </div>
            <div flex-gt-md="25" class="mr-md-md mt-md">
                @include('MD.input.text' , $comp_total)
            </div>
            <div flex></div>
            <div>
                <md-button class="md-icon-button md-raised md-primary" ng-click="comp.add()" layout="row"
                           layout-align="center center" ng-disabled="!(comp.flower && comp.total)">
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

                        <h3>{{item.flower.value}} </h3>
                        <i class="md-fg md-warn"> ({{item.total}})</i>
                    </div>
                </fieldset>
            </div>
        </div>
    </fieldset>


@endsection
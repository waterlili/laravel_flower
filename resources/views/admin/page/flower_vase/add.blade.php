<?php
$name = \App\View\Text::create('data.title', 'نام گلدان')->setRequired(false)->form()->export();
$material = \App\View\Text::create('data.material', 'جنس')->setRequired(false)->form()->export();
$weight = \App\View\Text::create('data.weight', 'وزن')->setRequired(false)->form()->export();
$size = \App\View\Select::create('data.size', 'سایز', \App\DB\FlowerVase::$SIZE)
    ->setRequired(true)
    ->form()
    ->export();
$price = \App\View\Text::create('data.price', 'قیمت')
    ->setRequired(false)
    ->form()
    ->export();
$quality = \App\View\Select::create('data.quality', 'کیفیت', \App\DB\FlowerVase::$QUALITY)
    ->setRequired(true)
    ->form()
    ->export();
$capacity = \App\View\Text::create('data.capacity', 'ظرفیت(چند شاخه؟)')->setRequired(false)->form()->export();
$color = \App\View\Select::create('data.color', 'رنگ', \App\DB\Cnt::color())
    ->setRequired(true)
    ->form()
    ->export();


?>
@extends('admin.block.form')
@section('form')
    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $name)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $material)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $weight)
        </div>
    </div>

    <div layout-gt-md="row">
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $size)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $quality)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' ,  $capacity)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.select-sm' ,  $color)
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text-sm' , $price)
        </div>

    </div>
    <fieldset>
        <legend>تصاویر گلدان</legend>
        <div layout-gt-md="row" layout-align="start center">
            <div flex-gt-md="35">
            <!--<div class="image-thumb">
                    <img src="{{data.personal.url}}" alt="">
                </div>-->
                <div>

                    <div id="myDiv{{$index}}" class="image-thumb img-wrap" ng-repeat="step in stepsModel">

                        <div class="col-sm-6 col-md-3">
                            <img ngf-thumbnail="step">
                            <p>
                                <progress id="pro" value="0"></progress>
                            </p>
                            <div class="progress" ng-show="step.progress >= 0">
                                <div class="progress-bar" style="width:{{step.progress}}%"
                                     ng-bind="step.progress + '%'"></div>
                            </div>
                        </div>

                        <i class="material-icons close" ng-click="removeElement($event)">close</i>

                    </div>
                </div>

                @include('admin.page.flower_vase.block.uploader' , [
                    'class_color'=>'md-primary',
                    'top_title'=>'بارگذاری تصویر گل',
                    'top_description'=>'فایل می بایست از نوع تصویر بوده و حداکثر 500 کیلوبایت باشد.',
                    'title'=> 'انتخاب فایل',
                    'accept'=>"'image/*'",
                    'max_size'=>'500KB',
                    'types'=>'jpg',
                    'model'=>'data.flower_vs_picture',
                    'name'=>'flower_vs_picture',
                    ])

            </div>
        </div>

    </fieldset>


@endsection
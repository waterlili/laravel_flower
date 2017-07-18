<?php
$inputsName = [
        'sch_name',
        'sch_address',
        'sch_phone',
        'sch_area',
        'edu_level',
        'edu_field',
        'edu_avg_int',
        'edu_avg_float',
        'illness',
        'bank',
        'bank_no',
        'bank_card',
        'email',
];

$inputRequired = [
        'sch_name',
        'sch_address',
        'sch_phone',
        'sch_area',
        'edu_level',
        'edu_field',
        'edu_avg_int',
        'edu_avg_float',
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
?>

@extends('register.master')
@section('title' , trans('register.page_2_header_title'))
@section('header_title' , trans('register.page_2_header_title'))
@section('header_description' , trans('register.page_2_header_description'))
@section('content')
    @include('register.block.stepUp' , ['page'=>2])
    <div class="md-bg md-background" ng-controller="StepSchoolCtrl">
        <div class="cm" layout-gt-md="row" flex="grow">
            <div class="step-bar-wrapper" show-gt-md hide layout-padding>
                <div class="step-bar"></div>
                <div layout="row" class="step-item" layout-align="center center">
                    <div class="step-bar-number active">2</div>
                </div>
            </div>
            <div flex>
                <form name="FONE">
                    <h3 class="mb-md mt-md"><% trans('register.page_2_header_title') %></h3>
                    <?php
                    $full_name = ($dt['sex'] == 1) ? 'جناب آقای' : 'سرکار خانم';
                    $sex = ($dt['sex'] == 1) ? 'برادر' : 'خواهر';
                    $full_name .= ' ' . $dt['fname'] . ' ' . $dt['lname'];
                    ?>
                    @include('register.block.notice' , ['type'=>'info' , 'text'=>trans('register.step_one_success' ,['full_name'=>$full_name])])
                            <!-- First Row - Education Info  -->
                    @include('register.block.divider' , ['icon'=>'&#xE80C;' , 'title'=>trans('register.education_info')])
                    <div class="fset" layout-gt-md="row" layout-align="start start">
                        @if(isset($inputs['edu_level']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['edu_level']->export())
                            </div>
                        @endif
                        @if(isset($inputs['edu_field']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['edu_field']->export())
                            </div>
                        @endif
                        @if(isset($inputs['edu_avg_int']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md input-cnt ph-sm">
                                <lable>معدل</lable>
                                <div layout="row">
                                    <div flex="50">@include('MD.input.text' , $inputs['edu_avg_int']->export())</div>
                                    <div flex="50">@include('MD.input.text' , $inputs['edu_avg_float']->export())</div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <!-- Secend Row - School Info  -->
                    @include('register.block.divider' , ['icon'=>'&#xE153;' , 'title'=>trans('register.school_info')])
                    <div class="fset" layout-gt-md="row" layout-align="start start">
                        @if(isset($inputs['sch_name']))
                            <div flex-gt-md="33"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['sch_name']->export())
                            </div>
                        @endif
                        @if(isset($inputs['sch_phone']))
                            <div flex-gt-md="33"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['sch_phone']->export())
                            </div>
                        @endif
                        @if(isset($inputs['sch_area']))
                            <div flex-gt-md="33"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['sch_area']->export())
                            </div>
                        @endif
                    </div>
                    @if(isset($inputs['sch_address']))
                        <div>
                            @include('MD.input.text' , $inputs['sch_address']->export())
                        </div>
                    @endif


                    @include('register.block.divider' , ['icon'=>'&#xE80C;' , 'title'=>trans('register.personal_picture')])

                    @include('register.block.uploader' , [
                   'class_color'=>'md-primary',
                   'top_title'=>'بارگذاری تصویر پرسنلی',
                   'top_description'=>'فایل می بایست از نوع تصویر بوده و می بایست حداکثر 500 کیلوبایت حجم داشته باشد.',
                   'title'=> 'انتخاب فایل',
                   'accept'=>"'image/*'",
                   'max_size'=>'500KB',
                   'types'=>'jpg',
                   'model'=>'data.personal',
                   'name'=>'personal_picture',
                    ])

                    @include('register.block.divider' , ['icon'=>'&#xE8DE;' , 'title'=>trans('register.other_info')])
                    <div>
                        @if(isset($inputs['illness']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['illness']->export())
                            </div>
                        @endif
                    </div>
                    <div layout-gt-md="row">
                        @if(isset($inputs['bank_no']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['bank_no']->export())
                            </div>
                        @endif

                        @if(isset($inputs['bank_name']))
                            <div flex-gt-md="25"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['bank_name']->export())
                            </div>
                        @endif
                        @if(isset($inputs['bank_card']))
                            <div flex-gt-md="50"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['bank_card']->export())
                            </div>
                        @endif
                    </div>
                    <div>
                        @if(isset($inputs['email']))
                            <div flex-gt-md="50"
                                 class="ml-sm-md">
                                @include('MD.input.text' , $inputs['email']->export())
                            </div>
                        @endif
                    </div>
                    <div class="ar-divider"><span class="ar-line"></span></div>
                    <div class="area-notice">
                        @include('register.block.notice' , ['repeat'=>'stp1.errorItem','type'=>'error'])
                        @include('register.block.notice' , ['repeat'=>'stp1.infoItem','type'=>'info'])
                    </div>
                    @include('register.block.preloader')
                    <div layout-gt-md="row">

                        <div flex></div>
                        <md-button class="md-raised md-primary" layout="row" layout-align="center center"
                                   ng-click="submit()"
                                   ng-disabled="FONE.$invalid">
                            <i
                                    class="material-icons">&#xE876;</i> <% trans('register.submitAndNext') %>
                        </md-button>

                        @if(\Illuminate\Support\Facades\App::environment('local'))
                            <md-button class="md-primary" layout="row" layout-align="center center"
                                       ng-click="fill_data()">درون ریزی
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
    @include('register.block.stepDown' , ['page'=>2])
@endsection
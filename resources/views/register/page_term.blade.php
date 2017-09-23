@extends('register.master')
@section('title' , trans('register.page_3_header_title'))
@section('header_title' , trans('register.page_3_header_title'))
@section('header_description' , trans('register.page_3_header_description'))
@section('content')
    @include('register.block.stepUp' , ['page'=>3])
    <div class="md-bg md-background" ng-controller="StepTermCtrl">
        <div class="cm" layout-gt-md="row" flex="grow">
            <div class="step-bar-wrapper" show-gt-md hide layout-padding>
                <div class="step-bar"></div>
                <div layout="row" class="step-item" layout-align="center center">
                    <div class="step-bar-number active">3</div>
                </div>
            </div>
            <div flex>
                <form name="FONE">
                    <h3 class="mb-md mt-md"><% trans('register.page_3_header_title') %></h3>
                    @include('register.block.divider' , ['icon'=>'&#xE7F9;' , 'title'=>trans('register.term_select')])
                    <div class="input-cnt mt-md">
                        <div class="p-md">
                            <md-checkbox ng-model="data.cb1" aria-label="" class="m-n md-primary">
                                مشاوره
                            </md-checkbox>
                        </div>
                    </div>

                    <div class="input-cnt mt-md">
                        <div layout-gt-md="row">
                            <div class="p-md">
                                <md-checkbox ng-model="data.cb1" aria-label="" class="m-n">
                                    دوره آموزشی بیان
                                </md-checkbox>
                            </div>
                            <div flex></div>
                            <div class="m-sm" ng-if="data.cb1">
                                <md-button class="md-raised md-primary" ng-click="showRecognize($event , 10)"> تعهد
                                    نامه
                                </md-button>
                            </div>
                        </div>
                        <div ng-if="data.cb1" class="p-md">
                            <hr>
                            دوره آموزشی بیان
                        </div>
                    </div>
                    <div class="area-notice">
                        @include('register.block.notice' , ['repeat'=>'stp1.errorItem','type'=>'error'])
                        @include('register.block.notice' , ['repeat'=>'stp1.infoItem','type'=>'info'])
                    </div>
                    @include('register.block.preloader')
                    <div layout-gt-md="row">
                        <div flex></div>
                        <md-button class="md-raised md-primary" layout="row" layout-align="center center"
                                   ng-click="stp3.submit()"
                                   ng-disabled="FONE.$invalid || (!stp3.cantUpload && (!stp3.shafahi.finish || !stp3.honari.finish || !stp3.azan.finish || !stp3.tavashih.finish))">
                            <i
                                    class="material-icons">&#xE876;</i>
                            <span><% trans('register.submitAndNext') %></span>
                        </md-button>
                        @if(\Illuminate\Support\Facades\App::environment('local'))
                            <md-button class="md-primary" layout="row" layout-align="center center"
                                       ng-click="csession()">clear session
                            </md-button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('register.block.stepDown' , ['page'=>3])
@endsection
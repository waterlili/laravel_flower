<?php
$has_leaf = \App\View\Select::create('data.has_leaf', 'آیا برگ دارد؟', App\DB\Flower::has_or_not())->setRequired(true)->form()->export();

$comp_flower = \App\View\Select::create('comp.flower', 'گل', \App\DB\Flower::pluck('name', 'id')->toArray())->form()->export();
$comp_count = \App\View\Text::create('comp.count', 'تعداد')->form()->export();
?>
@extends('admin.block.form')
@section('form')
    <div>
        <div layout-gt-md="row">
            <div flex-gt-md="33">
                @include('MD.input.select-sm' , $has_leaf)
            </div>
        </div>

        <fieldset>
            <legend>افزودن گل</legend>
            <div layout-gt-md="row">

                <div flex-gt-md="33" class="ml-md-md">
                    @include('MD.input.select-sm' , $comp_flower)
                </div>
                <div flex-gt-md="33" class="ml-md-md">
                    @include('MD.input.text-sm' , $comp_count)
                </div>
                <div flex></div>
                <div>
                    <md-button class="md-icon-button md-raised md-primary" ng-click="comp.add()" layout="row"
                               layout-align="center center" ng-disabled="!(comp.flower && comp.count)">
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

                            <h3>{{flowers_arr[item.flower].name}} </h3>
                            <i class="md-fg md-warn"> ({{item.count}})</i>
                        </div>
                    </fieldset>
                </div>
            </div>
        </fieldset>
        <div flex></div>
        <div>
            <md-button class="md-raised md-primary md-button md-ink-ripple" style="margin: 15px auto"
                       ng-click="comp.combine()" layout="row"
                       layout-align="center center" ng-disabled="!(data.composit)">
                <i class="material-icons md-18">search</i>
                <md-tooltip>جستجوی ترکیب ها</md-tooltip>
            </md-button>
        </div>
        <fieldset>
            <ul style="list-style: none">
                <li ng-repeat="item in data.combine_arr track by $index">
                    <label>
                        <input type="checkbox" ng-checked="data.checkedCombines.indexOf(item) != -1"
                               ng-click="toggleCheck(item)" name="datacombines[]" value="{{item}}">
                        {{ item }}
                    </label>
                </li>
            </ul>
        </fieldset>
    </div>
@endsection

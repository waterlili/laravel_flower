<?php
$types = \App\View\Select::create('data.type', 'نوع پکیج گل', \App\DB\PacketType::pluck('title')->toArray())->form()->export();

$comp_package = \App\View\Select::create('comp.package', 'ترکیب', \App\DB\FlowerPackage::pluck('name', 'id')->toArray())->form()->export();
?>
@extends('admin.block.form')
@section('form')
    <div>
        <div layout-gt-md="row">
            <div flex-gt-md="33">
                @include('MD.input.select-sm', $types)
            </div>
        </div>

        <fieldset>
            <legend>افزودن ترکیب</legend>
            <div layout-gt-md="row" layout-align="start center">
                <div flex-gt-md="35">
                    @include('MD.input.select-sm' , $comp_package)
                </div>
                <div flex></div>
                <div>
                    <md-button class="md-icon-button md-raised md-primary" ng-click="comp.add()" layout="row"
                               layout-align="center center" ng-disabled="!(comp.package)">
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

                            <h3>{{packages_arr[item.package].name}} </h3>
                        </div>
                    </fieldset>
                </div>
            </div>
        </fieldset>
    </div>
@endsection
@extends('admin.master')
@section('title' , trans('subject.system_name'))
@section('content')
    <div ng-controller="AdminCtrl" layout="column" layout-fill id="main-wrapper">
        <div ng-controller="PreloaderCtrl" id="main-progress-bar">
            <md-progress-linear ng-if="_loader" class="md-accent" md-mode="indeterminate"></md-progress-linear>
        </div>

        <md-progress-linear ng-if="preloder_page" style="position: fixed;z-index: 1000; height: 3px;overflow: hidden;"
                            class="md-primary md-hue-2" md-mode="indeterminate"></md-progress-linear>
        <md-toolbar id="toolbar" class="md-bg shadow md-accent md-hue-1" layout="row"
                    layout-align="start stretch">
            <div layout="column" layout-align="center start" class="md-bg md-accent md-hue-1" hide show-gt-md
                 style="min-width: 300px">
                <img src="<% url('img/logo.svg') %>" height="50px" alt="">
            </div>

            <div flex layout="column" style="position: relative;">
                <div layout="row" layout-align="start center">
                    <md-button class="md-icon-button" ng-click="toggleMenu()" hide-gt-md><i
                                class="material-icons md-light">menu</i></md-button>
                    <h1 class="md-toolbar-tools" layout="column" layout-align="center start">
                        <span class="toolbar-title-page" ng-repeat="item in toolbarTitlePage">
                        {{item}}
                        </span>
                    </h1>
                    <span flex></span>
                    <md-button class="md-icon-button" ng-click="toggleRight()">
                        <i class="material-icons md-light">message</i>
                        <md-tooltip md-direction="right">
                            رویداد ها
                        </md-tooltip>
                    </md-button>
                </div>

            </div>

        </md-toolbar>


        <div id="notify-wrapper" ng-style="{'margin-right':(show_menu)?'250px':'0px'}" layout="column"
             flex="grow"
             ng-controller="NotifyCtrl">
            <div class="notify notify-{{item.type}}" layout-padding layout="row" layout-align="center center"
                 ng-repeat="item in admin_notify">
                <div class="notify-icon" style="line-height: 1" layout-padding>
                    <i class="material-icons">error</i>
                </div>

                <div class="notify-content h5" flex>
                    {{item.text}}
                </div>
                <md-button class="md-icon-button md-mini" ng-click="_destroy($index)">
                    <i class="material-icons md-18 md-light" style="line-height: 1.5">close</i>
                </md-button>
            </div>
        </div>
        <section layout="row" style="height: 100%">

            <md-sidenav
                    flex
                    class="md-sidenav-right"
                    md-component-id="menu"
                    md-is-locked-open="$mdMedia('gt-md')"
                    md-whiteframe="4">

                <md-content flex layout-fill class="md-bg md-accent md-hue-1" ng-controller="MenuCtrl">
                    @include('admin.block.profileMneu')
                    @include('admin.block.menu')
                </md-content>
            </md-sidenav>

            <md-content id="main_content_wrapper" flex class="md-main" ui-view="viewMaster" layout-padding>

            </md-content>

            <md-sidenav class="md-sidenav-left md-whiteframe-4dp" md-component-id="right">
                <md-toolbar class="md-theme-light">
                    <h1 class="md-toolbar-tools">Event Sidebar</h1>
                </md-toolbar>
                <md-content ng-controller="RightCtrl" layout-padding>
                    <div layout="column" layout-align="start center">
                        <md-list style="width: 100%;">
                            <md-list-item ng-click="clickList()">
                                <div layout="row" layout-align="center center" class="p-md">
                                    <div flex="25">
                                        <i class="material-icons md-fg md-priamry">history</i>
                                    </div>
                                    <div flex>
                                        <h3>سفارش جدید</h3>
                                        <p style="font-size: 12px;" class="m-n lh-1">
                                            توضیحی در باره سفارش
                                        </p>
                                    </div>
                                </div>
                            </md-list-item>
                        </md-list>
                        <span flex></span>
                        <md-button ng-click="close()">بستن</md-button>
                    </div>
                </md-content>
            </md-sidenav>
        </section>

    </div>
@endsection
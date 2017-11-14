<?php
$link = (isset($unver)) ? 'console/order/order-unverified' : 'console/order/order-list';
?>
<div ng-controller="OrderListCtrl">
    <section class="w-box p-md">
        <form name="Form">
            @yield('form')
            @include('MD.Notice.notice' , ['type'=>'info' , 'repeat'=>'submit.infoItem'])
            @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'submit.errorItem'])
            <div layout="row" layout-align="start center">
                <div class="ui search" use-search="cus" ng-model="customer">
                    <div class="ui icon input">
                        <input class="prompt" type="text" placeholder="جستجو مشتری" ng-model="cus.search">
                        <i class="search icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
                <div flex></div>
                <!--<div>
                    <md-button class="md-raised md-primary" ng-disabled="!customer" ng-click="getData()">بررسی صحت کاربری
                    </md-button>
                </div>-->
            </div>
            @include('admin.page.order.orders_list')
        </form>

    </section>
</div>


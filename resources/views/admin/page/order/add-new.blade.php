<?php

$description = \App\View\Text::create('data.description', 'ملاحظات فاکتور')->form()->export();
$feedback = \App\View\Text::create('data.feedback', 'بازخورد')->form()->export();
$pay_number = \App\View\Text::create('data.pay_number', 'شماره پیگیری پرداخت')->form()->export();

$send_at = \App\View\Text::create('data.send_at', 'تاریخ ارسال سفارش')->dateInput()->form()->export();
$send_at_time = \App\View\Text::create('data.send_at_time', 'زمان ارسال سفارش')
        ->setType('time')
        ->setInpAttr('mdp-time-picker')
        ->setInpAttr('mdp-format=HH:mm A')
        ->form()
        ->export();

$day = \App\View\Select::create('data.day', 'روز', \App\DB\Order::GetDays())
        ->setRequired(true)
        ->form()
        ->export();

$sts = \App\View\Select::create('data.sts', 'وضعیت سفارش', \App\DB\OrderPayment::$StsStr)
        ->setRequired(true)
        ->form()
        ->export();


$pay_type = \App\View\Select::create('data.pay_type', 'نحوه پرداخت', \App\DB\Order::$PayType)
        ->form()
        ->export();

$when = \App\View\Radio::create('data.when', 'چه موقع', \App\DB\Order::GetWhen())
        ->setRequired(true)
        ->setFset('چه موقع؟')
        ->form()
        ->export();
$customer = \App\View\Ac::create('data.customer', 'customer.itemOpt', 'console/order/get-customer', 'مشتری')
        ->setRequired(true)
        ->export();

$visitor = \App\View\Ac::create('data.visitor', 'visitor.itemOpt', 'console/order/get-visitor', 'بازاریاب')
        ->export();

$sender = \App\View\Ac::create('data.sender', 'sender.itemOpt', 'console/order/get-sender', 'تحویل دهنده')
        ->export();

$product = \App\View\Ac::create('prc.item', 'prc.itemOpt', 'console/order/get-product', 'نام یا کد محصول')
        ->export();
$total = \App\View\Text::create('item.total', 'تعداد')
        ->setRequired(true)
        ->numeric()
        ->setName('total')
        ->form()
        ->export();

?>

<div ng-controller="OrderAddNewCtrl">
    <div class="ui label red" ng-if="data.customer">{{data.customer.title}}</div>
    <div class="ui label green" ng-if="data.customer"><span>تعداد سفارش‌ :‌ </span>{{data.orders.length}}</div>

    <md-content>
        <md-tabs md-dynamic-height md-border-bottom md-selected="myTabIndex">
            <md-tab label="مشتری">
                <md-content class="md-padding">
                    <div class="content" ng-controller="CustomerAddCtrl">
                        @include('admin.page.customer.add')
                    </div>
                    <md-button class="md-raised md-primary md-button md-default-theme md-ink-ripple"
                               ng-click="myTabIndex = myTabIndex+1">بعدی
                    </md-button>
                </md-content>
            </md-tab>
            <md-tab label="اطلاعات سفارش">
                <div class="ui bottom attached segment" data-tab="second">
                    <md-content class="md-padding">

                        @include('admin.page.order.order-new')


                        <md-button class="md-raised md-primary md-button md-default-theme md-ink-ripple"
                                   ng-click="myTabIndex = myTabIndex-1">قبلی
                        </md-button>
                        <md-button class="md-raised md-primary md-button md-default-theme md-ink-ripple"
                                   ng-click="myTabIndex = myTabIndex+1">بعدی
                        </md-button>
                    </md-content>
                </div>
            </md-tab>
            <md-tab label="اطلاعات پرداخت">
                <div class="ui bottom attached segment" data-tab="third">
                    <md-content class="md-padding">
                        <div class="title" id="pay-tab">
                            <i class="add to cart icon"></i>
                            اطلاعات پرداخت
                        </div>

                        <div>
                            @include('admin.page.order.pay-new')
                        </div>
                        <md-button class="md-raised md-primary md-button md-default-theme md-ink-ripple"
                                   ng-click="myTabIndex = myTabIndex-1">قبلی
                        </md-button>
                        <md-button class="md-raised md-primary" ng-click="submit()" ng-disabled="loading">
                            ثبت سفارش
                        </md-button>
                    </md-content>
                </div>
            </md-tab>
        </md-tabs>
    </md-content>
</div>
</div>


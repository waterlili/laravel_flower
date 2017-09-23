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

$sts = \App\View\Select::create('data.sts', 'وضعیت سفارش', \App\DB\Order::$StsStr)
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
@extends('admin.block.form')
@section('form')
    @include('MD.Notice.notice' , ['type'=>'warn' , 'text'=>'کاربر گرامی ! توجه داشته باشید این بخش برای سفارش های مناسبتی است و کاربردی برای سفارش های اشتراکی ندارد.'])
    <div layout-gt-md="row">
        <div flex-gt-md="25" class="mr-md-md">
            {!! $customer !!}
        </div>
        <div flex-gt-md="25" class="mr-md-md">
            @include('MD.input.select' , $sts)
        </div>
    </div>
    <div layout-gt-md="row" layout-align="start start" class="mt-md">
        <fieldset  flex-gt-md="66">
            <legend>اطلاعات بازاریاب و تحویل دهنده</legend>
            <div layout-gt-md="row">
                <div flex-gt-md="50">
                    {!! $visitor !!}
                </div>
                <div flex-gt-md="50" class="mr-md-md">
                    {!! $sender !!}
                </div>

            </div>
        </fieldset>
        <fieldset flex-gt-md="33" class="mr-md-md">
            <legend>زمان و تاریخ ارسال سفارش</legend>
            <div>
                <div layout="row" layout-align="start center">
                    @include('MD.input.text' , $send_at)
                    @include('MD.input.text' , $send_at_time)
                </div>
            </div>
        </fieldset>
    </div>
    <div class="mt-md">
        <fieldset>
            <legend>توضیحات تکمیلی</legend>

            @include('MD.input.text' , $description)
            @include('MD.input.text' , $feedback)

        </fieldset>

    </div>

    <div class="mt-md">
        <fieldset>
            <legend>پرداخت</legend>

            <div layout-gt-md="row">
                <div flex-gt-md="33">
                    @include('MD.input.select' , $pay_type)
                </div>
                <div flex-gt-md="33">
                    @include('MD.input.text' , $pay_number)
                </div>

            </div>

        </fieldset>

    </div>
    @if(!isset($edt))
        <fieldset class="p-md">
            <legend>لیست اقلام فاکتور</legend>
            <div>
                <div class="p-md w-box blue">
                    <span>جمع اقلام فاکتور</span><span>  {{data.total | currency:'':''}}</span>
                </div>
                <div>
                    {!! $product !!}
                </div>
                <md-divider class="mv-md"></md-divider>
                <table ng-table="tableParams" class="table" show-filter="false">
                    <tr ng-repeat="item in $data">
                        <td title="'عنوان'">
                            {{item.value}}
                        </td>
                        <td title="'مبلغ'">
                            {{item.price | currency:'':''}}
                        </td>
                        <td title="'تعداد'" WIDTH="55px">
                            @include('MD.input.text' ,$total)
                        </td>
                        <td title="'جمع'">
                            {{item.price * item.total | currency:'':''}}
                        </td>
                        <td title="'حذف'">
                            <md-button class="md-icon-button md-warn" ng-click="prc.remove($index)">
                                <i class="material-icons md-18">delete</i>
                            </md-button>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
    @endif
@endsection
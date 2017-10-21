<?php
$total = \App\View\Text::create('item.total', 'تعداد ')->form()->export();
$name = \App\View\Text::create('item.sending_name', 'نام')->form()->export();
$phone = \App\View\Text::create('item.sending_mobile', 'موبایل')->setInpAttr('ui-mask=9999-999-9999')->form()->export();
$address = \App\View\Text::create('item.sending_address', 'آدرس')->form()->export();
$first = \App\View\Text::create('item.first', 'تاریخ اولین ارسال')->dateInput()->form()->export();
$first2 = \App\View\Text::create('item.first', 'تاریخ ارسال')->dateInput()->form()->export();

?>

<div class="ui styled accordion" style="width: 100%">
    <div ng-if="item" flex layout="column" layout-align="center center" class="text-center">لیست سفارشات مشتری</div>
    <div class="title" layout="row" layout-align="start center" data-ng-init="init()"
         ng-repeat-start="item in data.orders">
        <i class="icon edit"></i>
        سفارش
        <span>{{$index + 1}}</span>
        <div flex></div>
    </div>
    <div class="content" ng-repeat-end>
        <div class="p-md">
            <div layout-gt-md="row" layout-align="start center">
                <div class="form-group">
                    <p ng-if="item.type==1">
                        اشتراکی
                    </p>
                    <p ng-if="item.type==2">
                        هدیه
                    </p>
                    <p>
                        قیمت: {{item.amount}}
                    </p>
                    <p ng-if="item.sending!=Null">
                    <div flex>اطلاعات دریافت کننده</div>
                    <p ng-if="item.sending_name!=Null">نام:{{item.sending_name}}</p>
                    <p ng-if="item.sending_mobile!=Null">موبایل:{{item.sending_mobile}}</p>
                    <p ng-if="item.sending_address!=Null">آدرس :{{item.sending_address}}</p>

                    </p>


                </div>
            </div>
        </div>


    </div>

</div>






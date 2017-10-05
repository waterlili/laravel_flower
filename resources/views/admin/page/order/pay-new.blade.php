<?php
$price = \App\View\Text::create('item.price', 'مبلغ قابل پرداخت')->form()->export();
$serial = \App\View\Text::create('item.no', 'شماره سند')->form()->export();
$serial2 = \App\View\Text::create('item.no', 'شماره پیگیری')->form()->export();
$bank = \App\View\Text::create('item.bank', 'شماره حساب/کارت')->form()->export();
$mobile = \App\View\Text::create('item.mobile_pay', 'شماره موبایل')->form()->export();
$email = \App\View\Text::create('item.email_pay', 'ایمیل')->form()->export();
$date = \App\View\Text::create('item.pay_date', 'تاریخ تحویل به صندوق')->dateInput()->form()->export();
$date2 = \App\View\Text::create('item.pay_date', 'تاریخ واریز')->dateInput()->form()->export();
?>
<div class="ui segment">
    <div class="ui styled accordion" style="width: 100%">
        <div class="title" layout="row" layout-align="start center" ng-repeat-start="item in data.orders">
            <i class="icon edit"></i>
            سفارش
            <span>{{item.id || $index + 1}}</span>

            <div flex></div>
            <div>
                <i class="icon trash red color  " ng-click="removeOrder(item)"></i>
            </div>
        </div>
        <div class="content" ng-repeat-end>
            <div layout-gt-md="row" layout-align="start start">
                <div class="ui label large blue mb-md">
                    <span>مبلغ قابل پرداخت</span>
                    <div class="detail">{{calcPrice(item) | currency:"":""}}</div>
                    <span>تومان</span>
                </div>
                <div flex></div>
                <div>
                    <div class="ui fluid search selection dropdown ml-md-md mb-xl" use-dropdown ng-model="item.sts">
                        <input type="hidden" name="sts">
                        <i class="dropdown icon"></i>
                        <div class="default text">وضعیت سند</div>
                        <div class="menu">
                            @foreach(\App\DB\OrderPayment::$StsStr as $key=>$item)
                                <div class="item" data-value="<% $key %>"><% $item %></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start center">
                <div>
                    <label>نوع پرداخت</label>
                    <div class="ui buttons mb-md">
                        @foreach(\App\DB\Order::$PayType as $key=>$item)
                            <button class="ui button" ng-click="payType(item, <%$key %>)"
                                    ng-class="{'active teal':item.pay_type == <% $key %>}"><% $item %>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start start" ng-if="item.pay_type == 1">
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $mobile)
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $email)
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $serial)
                </div>
                <div flex-gt-md="25">
                    @include('MD.input.text-sm' , $date2)
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start start" ng-if="item.pay_type == 2">
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $date)
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                </div>
                <div flex-gt-md="25">
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start start" ng-if="item.pay_type == 4">
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $serial2)
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                    @include('MD.input.text-sm' , $date2)
                </div>
                <div flex-gt-md="25" class="ml-md-md">
                </div>
                <div flex-gt-md="25">
                </div>
            </div>
        </div>
    </div>

</div>
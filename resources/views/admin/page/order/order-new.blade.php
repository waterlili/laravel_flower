<?php
$total = \App\View\Text::create('item.total', 'تعداد ')->form()->export();
$name = \App\View\Text::create('item.sending_name', 'نام')->form()->export();
$phone = \App\View\Text::create('item.sending_mobile', 'موبایل')->setInpAttr('ui-mask=9999-999-9999')->form()->export();
$address = \App\View\Text::create('item.sending_address', 'آدرس')->form()->export();
$first = \App\View\Text::create('item.first', 'تاریخ اولین ارسال')->dateInput()->form()->export();
$first2 = \App\View\Text::create('item.first', 'تاریخ ارسال')->dateInput()->form()->export();

?>
<md-button class="md-raised md-primary" ng-click="addOrder()">افزودن سفارش</md-button>

<div class="ui styled accordion" style="width: 100%">
    <div class="title" layout="row" layout-align="start center"  ng-repeat-start="item in data.orders">
        <i class="icon edit"></i>
        سفارش
        <span>{{item.id || $index + 1}}</span>
        <div flex></div>
        <div>
            <i class="icon trash red color  " ng-click="removeOrder(item)"></i>
        </div>
    </div>
    <div class="content" ng-repeat-end>
        <div class="p-md">
            <div layout-gt-md="row" layout-align="start center">
                <div class="ui buttons mb-md">
                    <button class="ui button" ng-click="type(item , 1)" ng-class="{'active teal':item.type == 1}">هفتگی
                    </button>
                    <button class="ui button" ng-click="type(item , 2)" ng-class="{'active teal':item.type == 2}">
                        مناسبتی
                    </button>
                </div>
                <div flex></div>

            </div>
            <div layout-gt-md="row" layout-align="start center">
                <div class="ui fluid search selection dropdown ml-md-md mb-xl" use-dropdown ng-model="item.prc">
                    <input type="hidden" name="country">
                    <i class="dropdown icon"></i>
                    <div class="default text">انتخاب محصول</div>
                    <div class="menu">
                        @foreach(\App\DB\Product::GetPrc() as $item)
                            <div class="item" data-value="<% $item['id'] %>"><% $item['title'] %></div>
                        @endforeach
                    </div>
                </div>
                <div>
                    @include('MD.input.text-sm' , $total)
                </div>
            </div>
            <div layout-gt-md="row" ng-if="item.type == 1">
                <div class="ui buttons mb-md ml-md-md" flex-gt-md="66">
                    <button class="ui button" ng-click="weekChange(item , w.id)"
                            ng-class="{'active red':item.week == w.id}"
                            ng-repeat="w in week">{{w.title}}</button>
                </div>
                <div class="ui buttons mb-md" flex-gt-md="33">
                    <button class="ui button" ng-click="timeChange(item,t.id)"
                            ng-class="{'active green':item.time == t.id}"
                            ng-repeat="t in time">{{t.title}}</button>
                </div>

            </div>


            <div layout-gt-md="row" ng-if="item.type == 1">
                <div flex-gt-md="66" class="ml-md-md">
                    <div class="ui buttons mb-md ml-md-md" flex-gt-md="66">
                        <button class="ui button" ng-click="wChange(item , r.id)"
                                ng-class="{'active blue':item.w == r.id}"
                                ng-repeat="r in w">{{r.title}}</button>
                    </div>
                </div>
                <div flex-gt-md="33">
                    @include('MD.input.text-sm' , $first)
                </div>
            </div>

            <div layout-gt-md="row" ng-if="item.type == 2">
                <div flex-gt-md="66" class="ml-md-md">
                    <div class="ui buttons mb-md ml-md-md" flex-gt-md="66">
                        <button class="ui button" ng-click="wChange(item , r.id)"
                                ng-class="{'active blue':item.w == r.id}"
                                ng-repeat="r in time2">{{r.title}}</button>
                    </div>
                </div>
                <div flex-gt-md="33">
                    @include('MD.input.text-sm' , $first2)
                </div>
            </div>


            <div>
                <div class="ui checkbox mb-md">
                    <input type="checkbox" ng-model="item.sending">
                    <label>اطلاعات تحویل گیرنده متفاوت است.</label>
                </div>
                <div layout-gt-md="row" layout-align="start center" ng-if="item.sending">
                    <div flex-gt-md="25" class="ml-md-md">
                        @include('MD.input.text-sm' , $name)
                    </div>
                    <div flex-gt-md="25" class="ml-md-md">
                        @include('MD.input.text-sm' , $phone)
                    </div>
                    <div flex-gt-md="50">
                        @include('MD.input.text-sm' , $address)
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
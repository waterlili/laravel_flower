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

    <div class="title" layout="row" layout-align="start center" data-ng-init="init()"
         ng-repeat-start="item in data.new_orders" is-open="$first">

        <span><?php
            $value = "{{data.orders.orders.length+1}}";
            ?></span>
        <i class="icon edit"></i>
        سفارش
        <span><?php echo $value; ?></span>
        <div flex></div>
        <div>
            <i class="icon trash red color  " ng-click="removenewOrder(item)"></i>
        </div>
    </div>
    <div class="content active" ng-repeat-end>
        <div class="p-md">
            <div layout-gt-md="row" layout-align="start center">
                <div class="ui buttons mb-md">
                    <button class="ui button" ng-click="type(item , 1)" ng-class="{'active teal':item.type == 1}">
                        اشتراکی
                    </button>
                    <button class="ui button" ng-click="type(item , 2)" ng-class="{'active teal':item.type == 2}">
                        هدیه
                    </button>
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start center">
                <div class="ui checkbox mb-md">
                    <input type="checkbox" ng-model="Flower">
                    <label>انتخاب گل</label>
                </div>
                <div class="ui checkbox mb-md">

                    <?php $item = \App\DB\FlowerVase::select(['price'])->first();?>
                    <input type="checkbox" ng-model="item.flowerVase" ng-true-value="<% $item['price'] %>"
                           ng-false-value="0"/>
                    <input type="hidden" ng-model="flag"/>
                    <label>گلدان</label>
                </div>
            </div>


            <div layout-gt-md="row" layout-align="start center" ng-hide="Flower">
                <div class="ui fluid search selection dropdown ml-md-md mb-xl" use-dropdown ng-model="item.pck_type">
                    <i class="dropdown icon"></i>
                    <div class="default text">انتخاب بسته</div>
                    <div class="menu">
                        @foreach(\App\DB\FlowerPacket::GetPckt() as $item)
                            <div class="item" ng-click="item.flw_type= ''"
                                 data-value="<% $item['id'] %>|<% $item['price'] %>"><% $item['title'] %>

                            </div>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" value="<% $item['price'] %>" ng-model="item.price">
            </div>
            <div layout-gt-md="row" layout-align="start center" ng-if="Flower">
                <div flex-gt-md="50" class="ui fluid search selection dropdown ml-md-md mb-xl" use-dropdown
                     ng-model="item.flw_type">
                    <input type="hidden" name="country">
                    <i class="dropdown icon"></i>
                    <div class="default text">انتخاب گل</div>
                    <div class="menu">
                        @foreach(\App\DB\Flower::GetFlw() as $item)
                            <div class="item" ng-click="item.pck_type= ''"
                                 data-value="<% $item['id'] %>|<% $item['price'] %>"><% $item['name'] %>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div flex-gt-md="50">
                    @include('MD.input.text-sm' , $total)
                </div>
            </div>
            <div class="flexbox-parent">
                <div layout-gt-md="row" ng-if="item.type == 1">
                    <div flex-gt-md="100" class="ml-md-md pos_plate">
                        <div class="ui buttons mb-md ml-md-md" flex-gt-md="66">
                            <button class="ui button" ng-click="wChange(item , r.id)"
                                    ng-class="{'active blue':item.w == r.id}"
                                    ng-repeat="r in w">{{r.title}}</button>
                        </div>
                    </div>
                </div>
                <div layout-gt-md="row" ng-if="item.type == 1">
                    <div flex-gt-md="100" class="ml-md-md pos_plate">
                        <div class="ui buttons mb-md ml-md-md" flex-gt-md="66">
                            <button class="ui button" ng-click="weekChange(item , w.id)"
                                    ng-class="{'active red':item.week == w.id}"
                                    ng-repeat="w in week">{{w.title}}</button>
                        </div>
                    </div>
                </div>
                <div layout-gt-md="row" ng-if="item.type == 1">
                    <div flex-gt-md="100" class="ml-md-md pos_plate">
                        <div class="ui buttons mb-md" flex-gt-md="33">
                            <button class="ui button" ng-click="timeChange(item,t.id)"
                                    ng-class="{'active green':item.time == t.id}"
                                    ng-repeat="t in time">{{t.title}}</button>
                        </div>
                    </div>
                </div>
            </div>


            <div layout-gt-md="row" ng-if="item.type == 1">
                <div flex-gt-md="100">
                    @include('MD.input.text-sm' , $first)
                </div>
            </div>
            <div layout-gt-md="row" ng-if="item.type == 2">
                <div flex-gt-md="66" class="ml-md-md pos_plate">
                    <div class="ui buttons mb-md pos_plate" flex-gt-md="33">
                        <button class="ui button" ng-click="timeChange(item,t.id)"
                                ng-class="{'active blue':item.time == t.id}"
                                ng-repeat="t in time">{{t.title}}</button>
                    </div>
                </div>
                <div flex-gt-md="100">
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






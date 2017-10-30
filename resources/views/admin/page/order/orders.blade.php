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
         ng-repeat-start="item in data.orders.orders">
        <i class="icon edit"></i>
        سفارش
        <span>{{$index + 1}}</span>
        <div flex></div>
    </div>
    <div class="content odr_style" ng-repeat-end>
        <div class="p-md">
            <div layout-gt-md="row" layout-align="start center">
                <div class="form-group">
                    <div ng-if="item.order_flowers.length > 0 && item.type==1">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل از نوع
                            اشتراکی {{item.month_str}}</h4>
                        <p>{{item.week_str}} ها </p>
                        <p><label class="lab_sty">نام گل:</label>{{item.order_flowers[0]['flower']['name']}}</p>
                        تاریخ اولین ارسال: {{item.first_date}}
                        <p>{{item.order_packets[0]['packet']['title']}}</p>
                    </div>
                    <div ng-if="item.order_flowers.length > 0 && item.type==2">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل از نوع هدیه</h4>
                        <div><label class="lab_sty">نام گل:</label>{{item.order_flowers[0]['flower']['name']}}</div>
                        <p>
                            تاریخ اولین ارسال: {{item.first_date}}
                        </p>
                    </div>
                    <div ng-if="item.order_packets.length > 0 && item.type==1">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل از نوع
                            اشتراکی {{item.month_str}}</h4>
                        <span class="pull-left topic_pos">{{item.week_str}} ها </span>
                        <div layout="column" layout-align="center end"> تاریخ اولین ارسال:{{item.first_date}}
                        </div>

                        <div><label class="lab_sty">نوع بسته:</label>{{item.order_packets[0]['packet']['title']}}</div>
                    </div>
                    <div ng-if="item.order_packets.length > 0 && item.type==2">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل از نوع هدیه
                        </h4>
                        <div><label class="lab_sty">نوع بسته:</label>{{item.order_packets[0]['packet']['title']}}</div>
                        <div> تاریخ ارسال: {{item.first_date}}</div>


                    </div>
                    <div>
                        <label class="lab_sty">قیمت:</label> {{item.amount}}تومان
                    </div>


                </div>
            </div>
        </div>


    </div>

</div>






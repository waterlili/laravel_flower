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
         ng-repeat-start="item in data.orders.orders | limitTo:3">
        <i class="icon edit"></i>
        سفارش
        <span>{{item.number}}</span>&nbsp;

        <span ng-if="item.type==1">&nbsp;اشتراک {{item.month_str}}</span>



        <div flex></div>
        <span ng-if="item.type==1">ازتاریخ&nbsp;<label ng-bind="item.first_date |  date:'yyyy/MM/dd'"></label></span>
        <md-button class="md-icon-button pull-left" aria-label="More">
            <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
        </md-button>
    </div>
    <div class="content odr_style" ng-repeat-end>
        <div class="p-md">
            <div class="form-group">
                <div ng-if="item.order_flowers.length > 0 && item.type==1">
                    <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل
                    </h4>
                    <span class="pull-left topic_pos">{{item.week_str}} ها </span>
                    <div layout="column" layout-align="center end"><span> تاریخ اولین ارسال:</span><span
                                ng-bind="item.first_date |  date:'yyyy/MM/dd'"></span>
                    </div>
                    <p><label class="lab_sty">نام گل:</label>{{item.order_flowers[0]['flower']['name']}}</p>
                    <p>{{item.order_packets[0]['packet']['title']}}</p>
                </div>
                <div ng-if="item.order_flowers.length > 0 && item.type==2">
                    <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل از نوع هدیه</h4>
                    <div><label class="lab_sty">نام گل:</label>{{item.order_flowers[0]['flower']['name']}}</div>
                    <p>
                        <span> تاریخ اولین ارسال:</span> <span ng-bind="item.first_date |  date:'yyyy/MM/dd'"></span>
                    </p>
                </div>
                <div ng-if="item.order_packets.length > 0 && item.type==1">
                    <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل
                    </h4>
                    <span class="pull-left topic_pos">{{item.week_str}} ها </span>
                    <div layout="column" layout-align="center end"><span> تاریخ اولین ارسال:</span><span
                                ng-bind="item.first_date |  date:'yyyy/MM/dd'"></span>
                    </div>

                    <div><label class="lab_sty">نوع بسته:</label>{{item.order_packets[0]['packet']['title']}}</div>
                </div>
                <div ng-if="item.order_packets.length > 0 && item.type==2">
                    <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل از نوع هدیه
                    </h4>
                    <div><label class="lab_sty">نوع بسته:</label>{{item.order_packets[0]['packet']['title']}}</div>
                    <div><span> تاریخ اولین ارسال:</span><span ng-bind="item.first_date |  date:'yyyy/MM/dd'"></span>
                    </div>


                </div>


                <div>
                    <label class="lab_sty">هزینه سفارش</label> {{item.amount}}تومان
                </div>
            </div>


        </div>


    </div>

</div>








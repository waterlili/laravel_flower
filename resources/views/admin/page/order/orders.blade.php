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
        <span>{{$index + 1}}</span>&nbsp;

        <span ng-if="item.type==1">&nbsp;اشتراک {{item.month_str}}</span>


        <div flex></div>
        <span ng-if="item.type==1">ازتاریخ&nbsp;{{item.first_date}}</span>
        <md-button class="md-icon-button pull-left" aria-label="More">
            <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
        </md-button>
    </div>
    <div class="content odr_style" ng-repeat-end>
        <div class="p-md">


            <div layout-gt-md="row" layout-align="start center">
                <div class="form-group">

                    <div ng-if="item.order_flowers.length > 0 && item.type==2">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل از نوع هدیه</h4>
                        <div><label class="lab_sty">نام گل:</label>{{item.order_flowers[0]['flower']['name']}}</div>
                        <p>
                            تاریخ اولین ارسال: {{item.first_date}}
                        </p>
                    </div>
                    <div ng-if="item.order_packets.length > 0 && item.type==2">
                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل از نوع هدیه
                        </h4>
                        <div><label class="lab_sty">نوع بسته:</label>{{item.order_packets[0]['packet']['title']}}</div>
                        <div> تاریخ ارسال: {{item.first_date}}</div>


                    </div>
                    <div layout="row" layout-xs="column" ng-if="item.order_flowers.length > 0 && item.type==1">
                        <div flex layout-align="start center" ng-repeat="item in item.orderCard">

                            <md-card class="card_sty" id="card_poss" layout="row" ng-if="item.current < item.date"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>

                                            <span>{{item.date}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.name}}</span>
                                            <span>{{item.counter}}شاخه</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                            <md-card layout="row" class="card_sty" id="card_pass" ng-if="item.current >= item.date"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text green>

                                            <span>{{item.date}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.name}}</span>
                                            <span>{{item.counter}}شاخه</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                        </div>


                    </div>
                    <div layout="row" layout-xs="column" ng-if="item.order_packets.length > 0 && item.type==1">
                        <div flex layout-align="start center" ng-repeat="item in item.order_packets">
                            <md-card class="card_sty" id="card_poss" layout="row" ng-if="item.current < item.sent"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                            <md-card class="card_sty" id="card_pass" layout="row" ng-if="item.current >= item.sent"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                        </div>
                    </div>

                    <div layout="row" layout-xs="column">
                        <md-button class="md-raised md-primary" ng-show="item.order_payment.sts">اطلاعات پرداخت
                        </md-button>
                    </div>
                    <div>
                        <label class="lab_sty">هزینه سفارش</label> {{item.amount}}تومان
                    </div>


                </div>
            </div>


        </div>


    </div>

</div>








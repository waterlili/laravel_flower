<?php
$total = \App\View\Text::create('item.total', 'تعداد ')->form()->export();
$name = \App\View\Text::create('item.sending_name', 'نام')->form()->export();
$phone = \App\View\Text::create('item.sending_mobile', 'موبایل')->setInpAttr('ui-mask=9999-999-9999')->form()->export();
$address = \App\View\Text::create('item.sending_address', 'آدرس')->form()->export();
$first = \App\View\Text::create('item.first', 'تاریخ اولین ارسال')->dateInput()->form()->export();
$first2 = \App\View\Text::create('item.first', 'تاریخ ارسال')->dateInput()->form()->export();

?>

<div class="ui styled accordion mt-md" style="width: 100%">
    <div ng-if="item" flex layout="column" layout-align="center center" class="text-c enter">لیست سفارشات مشتری</div>
    <div class="title" layout="row" layout-align="start center" data-ng-init="init()"
         ng-repeat-start="item in data.orders.orders">
        <i class="icon edit"></i>
        سفارش
        <span>{{item.number}}</span>&nbsp;

        <span ng-if="item.type==1">&nbsp;اشتراک {{item.month_str}}&nbsp;<span
                    ng-if="item.flowerItem">گل&nbsp;{{item.flowerItem.flower.name}}</span><span ng-if="item.packetItem">بسته&nbsp;{{item.packetItem.flower_packet.title}}</span></span>
        <span ng-if="item.type==2">&nbsp;هدیه </span>

        <div flex></div>
        <span ng-if="item.type==1">ازتاریخ&nbsp;<label ng-bind="item.first_date |  date:'yyyy/MM/dd'"></label></span>
        <span ng-if="item.type==2">تاریخ ارسال&nbsp;<label
                    ng-bind="item.first_date |  date:'yyyy/MM/dd'"></label></span>
        <md-button class="md-icon-button pull-left" aria-label="More">
            <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
        </md-button>
    </div>
    <div class="content " ng-repeat-end>
        <div class="p-md">
            <div layout-gt-md="row" layout-align="start center">
                <div class="form-group">
                    <div ng-if="item.order_items[0].itemable_type=='Flower' && item.type==2">

                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش گل</h4>
                        <div><label class="lab_sty">نام گل:</label>{{item.order_items[0]['flower']['name']}} -<span>{{item.order_items[0]['count']}}
                                شاخه</span>
                            <label class="lab_sty">هزینه سفارش:</label><span>{{item.amount}}</span>
                        </div>

                    </div>
                    <div ng-if="item.order_items[0].itemable_type=='FlowerPacket' && item.type==2">

                        <h4 class="topic_pos"><i class="material-icons">local_florist</i> سفارش بسته ی گل
                        </h4>
                        <div><label class="lab_sty">نوع بسته:</label>{{item.order_items[0]['flower_packet']['title']}}
                            <label class="lab_sty">هزینه سفارش:</label><span>{{item.amount}}</span>
                        </div>


                    </div>
                    <div layout="row" layout-wrap layout-xs="column"
                         ng-if="item.order_items[0].itemable_type=='Flower' && item.type==1 && item.order_payment.sts==0">

                        <div flex-gt-md="25" layout-align="start center"
                             ng-repeat="item in item.order_items">
                            <md-card class="card_sty" id="card_poss" layout="row"
                                     ng-if="item.current < item.sent && item.sts==1"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>

                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.count}}شاخه</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                            <md-card layout="row" class="card_sty" id="card_pass"
                                     ng-if="item.current >= item.sent && item.sts==1"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text green>

                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.count}}شاخه</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                            <md-card layout="row" class="card_sty" id="card_conf" ng-if="item.sts==0"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text green>

                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.count}}شاخه</span>
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
                        <label class="lab_sty">هزینه سفارش:</label><span>{{item.amount}}</span>

                    </div>
                    <div layout="row" layout-wrap layout-xs="column"
                         ng-if="item.order_items[0].itemable_type=='Flower' && item.type==1 && item.order_payment.sts==1">
                        <div flex-gt-md="25" layout-align="start center"
                             ng-repeat="item in item.order_items">
                            <md-card ng-if="item.sts==1" class="card_sty" id="card_de" layout="row"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>

                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.count}}شاخه</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                                <div flex>
                                    <md-button class="md-icon-button pull-left" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                </div>
                            </md-card>
                            <md-card ng-if="item.sts==0" class="card_sty" id="card_conf" layout="row"
                                     layout-xs="column" md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}"
                                     md-theme-watch>
                                <div flex style="width:275px">
                                    <md-card-title>
                                        <md-card-title-text>

                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.count}}شاخه</span>
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
                        <label class="lab_sty">هزینه سفارش:</label><span>{{item.amount}}</span>
                    </div>
                    <div layout="row" layout-wrap layout-xs="column"
                         ng-if="item.order_items[0].itemable_type=='FlowerPacket' && item.type==1 && item.order_payment.sts==0">


                        <div flex-gt-md="25" layout-align="start center"
                             ng-repeat="item in item.order_items">
                            <md-card class="card_sty" id="card_poss" layout="row"
                                     ng-if="item.current < item.sent && item.sts==1"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-button class="md-icon-button pull-left crd-btn" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                            </md-card>
                            <md-card class="card_sty" id="card_pass" layout="row"
                                     ng-if="item.current >= item.sent && item.sts==1"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-button class="md-icon-button pull-left crd-btn" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                            </md-card>
                            <md-card class="card_sty" id="card_conf" layout="row" ng-if="item.sts==0"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-button class="md-icon-button pull-left crd-btn" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                            </md-card>

                        </div>

                        <label class="lab_sty">هزینه سفارش:</label><span>{{item.amount}}</span>
                    </div>
                    <div layout="row" layout-wrap layout-xs="column"
                         ng-if="item.order_items[0].itemable_type=='FlowerPacket' && item.type==1 && item.order_payment.sts==1">

                        <div flex-gt-md="25" layout-align="start center"
                             ng-repeat="item in item.order_items">
                            <md-card ng-if="item.sts==1" class="card_sty" id="card_de" layout="row"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-button class="md-icon-button pull-left crd-btn" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                            </md-card>
                            <md-card ng-if="item.sts==0" class="card_sty" id="card_conf" layout="row"
                                     layout="row" layout-xs="column"
                                     md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                                <div flex style="width:275px">
                                    <md-button class="md-icon-button pull-left crd-btn" aria-label="More">
                                        <md-icon md-svg-icon="img/button/more_vert.svg"></md-icon>
                                    </md-button>
                                    <md-card-title>
                                        <md-card-title-text>
                                            <span>{{item.sent}}</span>
                                            <span> ساعت {{item.duration_str}}</span>
                                            <span>{{item.day}}</span>
                                            <span>{{item.combination}}</span>
                                        </md-card-title-text>
                                    </md-card-title>
                                </div>
                            </md-card>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<div class="notice notice-error" ng-if="data.orders.orders.length == 0">
هیچ سفارشی برای این کاربر به ثبت نرسیده است.
</div>
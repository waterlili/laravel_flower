<section class="w-box p-md">
    <header class="w-box-header h-md" layout="row" layout-align="start center">
        <span><% $title %></span>
        <input class="date-report-input" type="text" ng-jalaali-flat-datepicker ng-model="<% $type %>.date"
               datepicker-config="{dateFormat:'jYYYY/jMM/jDD'}">

        <md-button class="md-icon-button" ng-click="<% $type %>.load()" ng-if="!<% $type %>.loading">
            <i class="material-icons md-24 md-dark">refresh</i>
        </md-button>
        <md-progress-circular ng-if="<% $type %>.loading" md-diameter="18px" style="margin: 10px;"></md-progress-circular>
    </header>
    <div ng-show="<% $type %>.dt.total_order > 0">
        <div layout-gt-md="row">
            {!! \App\View\BarView::create('تعداد سفارش ها', '{{'.$type.'.dt.total_order}}' , 'blue') !!}
            {!! \App\View\BarView::create('سفارش های پرداخت شده', '{{'.$type.'.dt.order_paid}}' , 'green') !!}
            {!! \App\View\BarView::create('سفارش های پرداخت نشده', '{{'.$type.'.dt.order_unpaid}}' , 'red') !!}
            {!! \App\View\BarView::create('درآمد', '{{'.$type.'.dt.income|currency:"":""}}' , 'yellow') !!}
        </div>
        <md-divider class="mv-md"></md-divider>
        <div>
            <div>نمودار نسبت پرداخت</div>
            @if($type == 'day')
                {!! \App\View\PieChart::create($type.'.chart' , 5,1 , $link) !!}
            @else
                {!! \App\View\LineChart::create($type.'.chart' , 5,1 , $link) !!}
            @endif
        </div>
    </div>
    <div class="w-box brown p-md" ng-if="<% $type %>.dt.total_order < 1">
        متاسفانه هیچ سفارشی موجود نیست.
    </div>
</section>

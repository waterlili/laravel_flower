<section class="w-box p-md mt-md">

    <?php
    $ng = new \App\View\NgTable('نمونه جدول در سامانه', 'tblRegister', 'console/test-table');
    $ng
            ->addCol('col1', 'ستون اول', 'col1')
            ->addCol('col2', 'ستون دوم', 'col2')
            ->addCol('col3', 'ستون سوم', 'col3')
            ->addInclude('col4', 'ستون سوم', 'admin.block.tableOpt')
            ->addFilter('ncode', 'نوع فیلتر وردوی', 'title', 'text');
    ?>
    @include('MD.table.table' , $ng->export())
</section>

<section class="w-box p-md mt-md">
    <h1 class="b md-fg md-accent">نمودار ها</h1>

    <md-divider class="mv-md"></md-divider>
    <h1 class="b md-fg md-accent mv-md">نمودار خطی</h1>
    @include('MD.chart.lineChart' , ['ngModel'=>'chartModel'  , 'w'=>5, 'h'=>1])

    <div class="mv-md"></div>
    <h1 class="b md-fg md-accent mv-md">نمودار میله ای</h1>
    @include('MD.chart.barChart' , ['ngModel'=>'chartModel'  , 'w'=>5, 'h'=>1])

    <div class="mv-md"></div>
    <h1 class="b md-fg md-accent mv-md">نمودار میله ای ( به صورت افقی)</h1>
    @include('MD.chart.horizontalChart' , ['ngModel'=>'chartModel'  , 'w'=>5, 'h'=>3])


    <div class="mv-md"></div>
    <h1 class="b md-fg md-accent mv-md">نمودار ترکیبی</h1>
    @include('MD.chart.barChart' , ['ngModel'=>'compChart'  , 'w'=>5, 'h'=>2])


    <div class="mv-md"></div>
    <h1 class="b md-fg md-accent mv-md">نمودار های دایره ای</h1>
    <div layout-gt-md="row" layout-align="start center">
        <div flex-gt-md="33">
            <h1 class="b md-fg md-accent mv-md tac">کیکی</h1>
            @include('MD.chart.polarChart' , ['ngModel'=>'circleChart' , 'w'=>5 , 'h'=>4])
        </div>
        <div flex-gt-md="33">
            <h1 class="b md-fg md-accent mv-md tac">راداری</h1>
            @include('MD.chart.radarChart' , ['ngModel'=>'chartModel' , 'w'=>5 , 'h'=>4])
        </div>
        <div flex-gt-md="33">
            <h1 class="b md-fg md-accent mv-md tac">حلقوی</h1>
            @include('MD.chart.doughnutChart' , ['ngModel'=>'circleChart' , 'w'=>5 , 'h'=>4])
        </div>
    </div>
</section>

<section class="w-box p-md mt-md">
    <h1 class="b md-fg md-accent">پیغام ها و هشدارها</h1>
    @include('MD.Notice.notice' , ['type'=>'error' , 'text'=>'یک پیغام آزمایشی برای سامانه مدیریت مشتریان گل'])
    @include('MD.Notice.notice' , ['type'=>'info' , 'text'=>'یک پیغام آزمایشی برای سامانه مدیریت مشتریان گل'])
    @include('MD.Notice.notice' , ['type'=>'warn' , 'text'=>'یک پیغام آزمایشی برای سامانه مدیریت مشتریان گل'])
    @include('MD.Notice.notice' , ['type'=>'confirm' , 'text'=>'یک پیغام آزمایشی برای سامانه مدیریت مشتریان گل'])
    <md-button ng-click="notify_info()" class="md-primary md-raised">اجرای یک اینفو در سامانه</md-button>
    <md-button ng-click="notify_error()" class="md-warn md-raised">اجرای یک خطا در سامانه</md-button>
</section>

<section class="w-box p-md mt-md">
    <h1 class="b md-fg md-accent">ورودی ها</h1>
    <?php
    $ac = new \App\View\InputObjectAc('ac','acOpt','link' ,'بارگیری آنلاین از سمت سرور');
    $t1 = new \App\View\InputObject('txt', 'ورودی 1');
    $t2 = new \App\View\InputObject('txt', 'ورودی 2');
    $t3 = new \App\View\InputObject('txt', 'ورودی 3');
    ?>
    @include('MD.input.autocomplete' , $ac->export())
    <div layout-gt-md="row" class="mt-md">
        <div flex-gt-md="33">
            @include('MD.input.text' , $t1->export())
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text' , $t2->export())
        </div>
        <div flex-gt-md="33">
            @include('MD.input.text' , $t3->export())
        </div>
    </div>
</section>


<section class="w-box blue p-md mt-md">
    باکس آبی رنگ
</section>

<section class="w-box green p-md mt-md">
باکس سبز رنگ
</section>

<section class="w-box red p-md mt-md">
باکس قرمز رنگ
</section>

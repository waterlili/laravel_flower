<?php
$table = new \App\View\NgTable('جدول سفارش های مشتری', 'tbl', 'console/customer/order-list');
$table
        ->addCol('price', 'مبلغ', NULL, true, true, 'currency:"":""')
        ->addCol('type_str', 'نوع', 'type')
        ->addCol('when_str', 'چه موقع', 'when')
        ->addCol('day_str', 'روز', 'day')
        ->addCol('total_product', 'جمع محصولات')
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addMore('description', 'توضیحات')
        ->addMore('feedback', 'بازخورد')
        ->addMore('closed_at_j', 'بسته شدن در', 'closed_at', FALSE)
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addCol('updated_at_j', 'بروزرسانی', 'updated_at', FALSE);


$table->addBtnFilter('bfnPayment', 'پرداخت شده ها');
$table->addBtnFilter('bfnDebts', 'بدهی ها');

$table->addFilter('price', 'مبلغ', 'price', 'number');

$table->addFilter('description', 'توضیحات', 'description', 'text');

$table->addFilter('type', 'نوع', 'type', 'select', \App\DB\Order::GetType());
$table->addFilter('when', 'چه موقع', 'when', 'select', \App\DB\Order::GetWhen());
$table->addFilter('day', 'چه روزی', 'day', 'select', \App\DB\Order::GetDays());
$table->addFilter('sts', 'وضعیت', 'sts', 'select', \App\DB\Order::$StsStr);
$table->addFilter('submit', 'وضعیت ارسال', 'submit', 'select', \App\DB\Order::$StsSubmit);

$table->addFilter('closed_at', 'تاریخ بسته شدن', 'closed_at', 'date');
$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');
$table->addFilter('updated_at', 'تاریخ بروزرسانی', 'updated_at', 'date');
?>
@extends('admin.block.editDialogMaster' , ['noBtn'=>TRUE])
@section('title' , 'سفارش های {{dt.fname + " " + dt.lname}}')
@section('content')
    <div class="mv-md mb-md" layout-gt-md="row">
        <div flex-gt-md="33" class="mh-sm">
            @include('MD.tile.tile' , ['title'=>'میزان وفاداری' , 'value'=>'{{facts.data.loyalty}}' , 'color'=>'blue' , 'icon'=>'favorite'])
        </div>
        <div flex-gt-md="33" class="mh-sm">
            @include('MD.tile.tile' , ['title'=>'سفارش های پرداخت شده' , 'value'=>'{{facts.data.paid}}' , 'color'=>'green' , 'icon'=>'mail'])
        </div>
        <div flex-gt-md="33" class="mh-sm">
            @include('MD.tile.tile' , ['title'=>'سفارش های پرداخت نشده' , 'value'=>'{{facts.data.unpaid}}' , 'color'=>'red' , 'icon'=>'drafts'])
        </div>
    </div>

    <div class="mv-md mb-md" layout-gt-md="row">
        <div flex-gt-md="50" class="mh-sm">
            @include('MD.tile.tile' , ['title'=>'پرداخت ها' , 'value'=>'{{facts.data.get|currency:"":""}}' , 'color'=>'brown' , 'icon'=>'done_all'])
        </div>
        <div flex-gt-md="50" class="mh-sm">
            @include('MD.tile.tile' , ['title'=>'بدهی ها' , 'value'=>'{{facts.data.debt|currency:"":""}}' , 'color'=>'red' , 'icon'=>'undo'])
        </div>
    </div>
    @include('MD.table.table' , $table->export())
@endsection
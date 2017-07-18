<?php

$table = new \App\View\NgTable('سفارش های روز', 'tbl', 'console/order/list-day');
$table
        ->addCol('when_str', 'روز', 'week')
        ->addCol('when_day', 'زمان ارسال', 'week')
        ->addCol('oid', 'شماره سفارش', 'oid' )
        ->addCol('product.title', 'محصول', 'prc')
        ->addCol('total', 'تعداد', 'total')
        ->addCol('count', 'چندمین سفارش', 'count', FALSE)
        ->addCol('customer.name', 'چه موقع', 'cid')
        ->addCol('customer.address', 'آدرس', 'cid', FALSE)
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('created_at_j', 'ایجاد فاکتور', 'created_at');
$table->addFilter('no', 'شماره پیگیری', 'no', 'text');
$table->addFilter('created_at', 'تاریخ ', 'created_at', 'date');
$table->addFilter('day', 'روز', 'day', 'select', \App\DB\Order::GetDays());
?>

@include('MD.table.table' , $table->export())


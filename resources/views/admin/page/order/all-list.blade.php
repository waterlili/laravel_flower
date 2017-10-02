<?php
$link = (isset($unver)) ? 'console/order/order-unverified' : 'console/order/order-list';
$table = new \App\View\NgTable('جدول سفارش ها', 'tbl', $link);
$table
    ->addCol('week_str', 'روز', 'week')
    ->addCol('time_str', 'چه موقع', 'time')
    ->addCol('customer.name', 'مشتری', 'cid')
        ->addCol('price', 'مبلغ', null, true, FALSE, 'currency:"":""')
        ->addCol('sts_str', 'وضعیت', 'sts')
    ->addCol('user.lname', 'ایجاد کننده', 'uid', FALSE)
        ->addMore('description', 'توضیحات', NULL, FALSE)
    ->addCol('no', 'شماره پرداخت', NULL, FALSE)
    ->addCol('first', 'اولین ارسال', 'first', FALSE)
        ->addCol('pay_type_str', 'نوع پرداخت', 'pay_type', FALSE)
        ->addCol('created_at_j', 'ایجاد فاکتور', 'created_at')
        ->addCol('updated_at_j', 'بروزرسانی', 'updated_at', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.order.block.orderOpt');
$table->addFilter('no', 'شماره پیگیری', 'no', 'text');
$table->addFilter('created_at', 'تاریخ ', 'created_at', 'date');
$table->addFilter('day', 'روز', 'day', 'select', \App\DB\Order::GetDays());
$table->extraRow('admin.page.order.block.order-list-extra-row');
?>

@include('MD.table.table' , $table->export())


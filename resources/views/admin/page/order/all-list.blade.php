<?php
$link = (isset($unver)) ? 'console/order/order-unverified' : 'console/order/order-list';
$table = new \App\View\NgTable('جدول سفارش ها', 'tbl', $link);
$table
        ->addCol('day_str', 'روز', 'day')
        ->addCol('when_str', 'چه موقع', 'when')
        ->addCol('total_product', 'جمع محصولات', null, FALSE)
        ->addCol('user_name.name', 'مشتری', 'uid')
        ->addCol('price', 'مبلغ', null, true, FALSE, 'currency:"":""')
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('creator_name . name', 'ایجاد کننده', 'creator', FALSE)
        ->addMore('description', 'توضیحات', NULL, FALSE)
        ->addMore('feedback', 'بازخورد', NULL, FALSE)
        ->addCol('visitor_name.name', 'بازاریاب', 'visitor', FALSE)
        ->addCol('sender_name.name', 'تحویل دهنده', 'sender', FALSE)
        ->addCol('pay_number', 'شماره پرداخت', NULL, FALSE)
        ->addCol('send_at_j', 'تاریخ ارسال', 'send_at', FALSE)
        ->addCol('pay_type_str', 'نوع پرداخت', 'pay_type', FALSE)
        ->addCol('closed_at_j', 'بسته شده', 'closed_at', FALSE)
        ->addCol('created_at_j', 'ایجاد فاکتور', 'created_at')
        ->addCol('updated_at_j', 'بروزرسانی', 'updated_at', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.order.block.orderOpt');


$table->addFilter('uid', 'مشتری', 'users.lname', 'text');
$table->addFilter('pay_number', 'شماره پیگیری', 'pay_number', 'text');
$table->addFilter('created_at', 'تاریخ ', 'created_at', 'date');
$table->addFilter('day', 'روز', 'day', 'select', \App\DB\Order::GetDays());
$table->extraRow('admin.page.order.block.order-list-extra-row');
?>

@include('MD.table.table' , $table->export())


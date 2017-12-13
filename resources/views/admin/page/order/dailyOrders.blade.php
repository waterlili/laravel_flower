<?php
$table = new \App\View\NgTable('گزارش سفارشات ارسالی روز', 'tbl', 'console/order/daily-orders');
$table
    ->addCol('id', 'ردیف', FALSE)
    ->addCol('order.customer.fname', 'نام', FALSE)
    ->addCol('order.customer.lname', 'نام خانوادگی', FALSE)
    ->addCol('order.customer.address', 'آدرس', FALSE)
    ->addCol('order.customer.mobile', 'تلفن', FALSE)
    ->addCol('combination', 'ترکیب', FALSE)
    ->addCol('sent', 'زمان ارسال', FALSE)
    ->addCol('period_str', ' ', FALSE)
    ->addCol('order.customer.description', 'توضیحات', FALSE)
    ->addInclude('opt', 'عملیات', 'admin.page.order.block.checkOpt');;


//$table->addFilter('price', 'قیمت', 'packet.price', 'text');
$table->addFilter('period', 'بازه زمانی', 'period', 'select', \App\DB\OrderItem::timeDuration());
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


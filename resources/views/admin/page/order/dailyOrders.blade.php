<?php
$table = new \App\View\NgTable('گزارش سفارشات ارسالی روز', 'tbl', 'console/order/daily-orders');
$table
    ->addCol('id', 'ردیف', FALSE)
    ->addCol('customer.fname', 'نام', FALSE)
    ->addCol('customer.lname', 'نام خانوادگی', FALSE)
    ->addCol('customer.address', 'آدرس', FALSE)
    ->addCol('customer.mobile', 'تلفن', FALSE)
    ->addCol('period_str', 'نوع سفارش', FALSE)
    ->addCol('Day_count', 'تاریخ ارسال', FALSE)
    ->addCol('Day_count', 'زمان ارسال', FALSE)
    ->addCol('customer.description', 'توضیحات', FALSE)
    ->addCol('Day_count', 'تایید', FALSE);


//$table->addFilter('price', 'قیمت', 'packet.price', 'text');
$table->addFilter('period_str', 'بازه زمانی', 'period_str', 'select');
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


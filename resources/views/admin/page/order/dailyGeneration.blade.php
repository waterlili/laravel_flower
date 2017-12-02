<?php
$table = new \App\View\NgTable('گزارش تولید روزانه', 'tbl', 'console/order/daily-generation');
$table
    ->addCol('packet["title"]', 'نوع', FALSE)
    ->addCol('packet["price"]', 'قیمت', FALSE)
    ->addCol('packet.pkg_names', 'ترکیب', FALSE)
    ->addCol('sent', 'تاریخ')
    ->addCol('period_str', 'بازه زمانی', FALSE)
    ->addCol('Day_count', 'تعداد', FALSE);


//$table->addFilter('price', 'قیمت', 'packet.price', 'text');
$table->addFilter('period_str', 'بازه زمانی', 'period_str', 'select');
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


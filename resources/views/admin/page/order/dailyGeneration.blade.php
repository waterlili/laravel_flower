<?php
$table = new \App\View\NgTable('گزارش تولید روزانه', 'tbl', 'console/order/daily-generation');
$table
    ->addCol('flower_packet["title"]', 'نوع', FALSE)
    ->addCol('flower_packet["price"]', 'قیمت', FALSE)
    ->addCol('combination', 'ترکیب', FALSE)
    ->addCol('sent', 'تاریخ')
    ->addCol('Day_count', 'تعداد', FALSE);


//$table->addFilter('price', 'قیمت', 'packet.price', 'text');
$table->addFilter('period_str', 'بازه زمانی', 'period_str', 'select');
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


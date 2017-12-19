<?php
$table = new \App\View\NgTable('گزارش تولید روزانه', 'tbl', 'console/order/daily-generation');
$table
    ->addCol('flower_packet["title"]', 'نوع', FALSE)
    ->addCol('flower_packet["price"]', 'قیمت', FALSE)
    ->addCol('combination', 'ترکیب', FALSE)
    ->addCol('period_str', 'بازه زمانی', FALSE)
    ->addCol('sent', 'تاریخ', FALSE)
    ->addCol('Day_count', 'تعداد', FALSE);


$table->addFilter('period', 'بازه زمانی', 'period', 'select', \App\DB\OrderItem::timeDuration());
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


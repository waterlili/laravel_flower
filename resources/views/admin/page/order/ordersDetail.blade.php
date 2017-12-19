<?php
$table = new \App\View\NgTable('گزارش کلی سفارش ها', 'tbl', 'console/order/detail');
$table
    ->addCol('id', 'ردیف', FALSE)
    ->addCol('number', 'کد سفارش', FALSE)
    ->addCol('customer.fname', 'نام', FALSE)
    ->addCol('customer.lname', 'نام خانوادگی', FALSE)
    ->addCol('customer.address', 'آدرس', FALSE)
    ->addCol('customer.mobile', 'تلفن', FALSE)
    ->addCol('amount', 'هزینه(ریال)', FALSE)
    ->addCol('type_str', 'نوع سفارش', FALSE)
    ->addCol('type2_str', 'نوع سفارش', FALSE)
    ->addCol('order_payment.sts_str', 'وضعیت', FALSE)
    ->addCol('started_at', 'اولین ارسال', FALSE)
    ->addCol('week_str', 'روز', FALSE)
    ->addCol('duration_str', 'ساعت', FALSE)
    ->addCol('vase_str', 'گلدان', FALSE)
    ->addCol('period_str', ' ', FALSE)
    ->addCol('customer.description', 'توضیحات', FALSE)
    ->addInclude('opt', 'ترکیب ها', 'admin.page.order.block.ordPkt');


//$table->addFilter('price', 'قیمت', 'packet.price', 'text');
$table->addFilter('period', 'بازه زمانی', 'period', 'select', \App\DB\OrderItem::timeDuration());
$table->addFilter('sent_at', 'تاریخ', 'sent_at', 'date');

?>

@include('MD.table.table' , $table->export())


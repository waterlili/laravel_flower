<?php
$table = new \App\View\NgTable('جدول گلدان ها', 'tbl', 'console/flower_vase/list');
$table
    ->addCol('title', 'نام')
    ->addCol('price', 'قیمت', null, true, FALSE, 'currency:"":""')
    ->addInclude('opt', 'عملیات', 'admin.page.flower.block.listOpt');

$table->addFilter('title', 'نام', 'name', 'text');
$table->addFilter('price', 'قیمت', 'price', 'number');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>
@include('MD.table.table' , $table->export())




<?php
$table = new \App\View\NgTable('جدول بسته ها', 'tbl', 'console/flower_packet/list');
$table
    ->addCol('title', 'نوع')
        ->addInclude('opt', 'عملیات', 'admin.page.flower_packet.block.listOpt');

$table->addFilter('name', 'نام', 'name', 'text');
$table->addFilter('leaf_str', 'برگ دارد', 'has_leaf', 'text');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>

@include('MD.table.table' , $table->export())




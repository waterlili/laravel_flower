<?php
$table = new \App\View\NgTable('جدول بسته ها', 'tbl', 'console/packet/list');
$table
        ->addCol('name', 'نام')
        ->addInclude('opt', 'عملیات', 'admin.page.packet.block.listOpt');

$table->addFilter('name', 'نام', 'name', 'text');
$table->addFilter('leaf_str', 'برگ دارد', 'has_leaf', 'text');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');
$table->extraRow('admin.page.packet.block.extra-row');

?>

@include('MD.table.table' , $table->export())




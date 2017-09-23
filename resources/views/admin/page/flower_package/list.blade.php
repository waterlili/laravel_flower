<?php
$table = new \App\View\NgTable('جدول ترکیب گل ها', 'tbl', 'console/flower_package/list');
$table
        ->addCol('name', 'نام')
        ->addCol('leaf_str', 'برگ دارد')
        ->addInclude('opt', 'عملیات', 'admin.page.flower_package.block.listOpt');

$table->addFilter('name', 'نام', 'name', 'text');
$table->addFilter('leaf_str', 'برگ دارد', 'has_leaf', 'text');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>

@include('MD.table.table' , $table->export())




<?php
$table = new \App\View\NgTable('جدول گل ها', 'tbl', 'console/flower/list');
$table
        ->addCol('name', 'نام')
        ->addCol('price', 'قیمت', null, true, FALSE, 'currency:"":""')
        ->addCol('vahed_str', 'واحد', 'vahed_str')
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addCol('updated_at_j', 'بروزرسانی در', 'updated_at', FALSE)
        ->addCol('users.name', 'ایجاد کننده', 'uid', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.flower.block.listOpt');

$table->addFilter('name', 'نام', 'name', 'text');
$table->addFilter('price', 'قیمت', 'price', 'number');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>
@include('MD.table.table' , $table->export())




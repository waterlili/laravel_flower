<?php
$table = new \App\View\NgTable('جدول محصولات', 'tbl', 'console/product/list');
$table
        ->addCol('code', 'کد محصول')
        ->addCol('title', 'عنوان محصول')
        ->addCol('price', 'قیمت', null, true, FALSE, 'currency:"":""')
        ->addCol('pack_type_str', 'نوع محصول', 'pack_type')
        ->addMore('description', 'توضیحات', null, FALSE)
        ->addCol('sales', 'فروش')
        ->addCol('is_active_str', 'فعال', 'is_active', FALSE)
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addCol('updated_at_j', 'بروزرسانی در', 'updated_at', FALSE)
        ->addCol('users.name', 'ایجاد کننده', 'uid', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.customer.block.listOpt');

$table->addFilter('code', 'کدمحصول', 'code', 'text');
$table->addFilter('title', 'عنوان', 'title', 'text');
$table->addFilter('price', 'قیمت', 'price', 'number');
$table->addFilter('pack_type_str', 'نوع بسته بندی', 'pack_type', 'select', config('pack_type'));
$table->addFilter('description', 'توضیحات', 'description', 'text');
$table->addFilter('sales', 'فروش', 'sales', 'number');
$table->addFilter('is_active', 'فعال', 'is_active', 'switch');
$table->addFilter('sts', 'وضعیت', 'sts', 'select', \App\DB\Product::$STS_STR);
$table->addFilter('user', 'ایجاد کننده', 'users.lname', 'text');

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>

@include('MD.table.table' , $table->export())




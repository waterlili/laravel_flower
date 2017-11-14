<?php
$table = new \App\View\NgTable('جدول مشتریان', 'tbl', 'console/customer/list');
$table
        ->addCol('id', 'کد')
        ->addCol('fname', 'نام')
        ->addCol('lname', 'نام خانوادگی')
    ->addCol('email', 'ایمیل', FALSE)
    ->addCol('gender_str', 'جنسیت', FALSE)
    ->addCol('mobile', 'موبایل')
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.customer.block.listOpt');

$table->addFilter('lname', 'نام خانوادگی', 'lname', 'text');
$table->addFilter('email', 'ایمیل', 'email', 'text');
$table->addFilter('job', 'شغل', 'user_info.job', 'text');
$table->addFilter('mobile', 'موبایل', 'user_info.mobile', 'text');
$table->addFilter('phone', 'تلفن', 'user_info.phone', 'text');
$table->addFilter('skill', 'مهارت', 'user_info.skill', 'text');
$table->addFilter('address', 'آدرس', 'user_info.address', 'text');
$table->addFilter('address2', 'آدرس دوم', 'user_info.address2', 'text');
$table->addFilter('description', 'توضیح بازاریاب', 'user_info.description', 'text');
$table->addFilter('zip_code', 'کد پستی', 'user_info.zip_code', 'text');

$table->addFilter('type', 'نوع', 'type', 'select', \App\DB\User::CUSTOMER_TYPE());
$table->addFilter('job_type', 'نوع شغل', 'user_info.job_type', 'select', \App\DB\User::$JOBTYPES);

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');

?>

@include('MD.table.table' , $table->export())




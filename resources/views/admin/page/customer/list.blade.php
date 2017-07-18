<?php
$table = new \App\View\NgTable('جدول مشتریان', 'tbl', 'console/customer/list');
$table
        ->addCol('id', 'کد')
        ->addCol('fname', 'نام')
        ->addCol('lname', 'نام خانوادگی')
        ->addCol('email', 'ایمیل', null, FALSE)
        ->addCol('gender_str', 'جنسیت', 'gender', FALSE)
        ->addCol('cus_type_str', 'نوع', 'type', FALSE)
        ->addCol('user_info.job', 'تخصص', NULL, FALSE)
        ->addCol('user_info.job_type_str', 'نوع فعالیت', 'user_info.job_type')
        ->addCol('user_info.skill', 'مهارت', null, FALSE)
        ->addCol('user_info.mobile', 'موبایل')
        ->addCol('user_info.phone', 'تلفن', null, FALSE)
        ->addMore('user_info.address', 'آدرس', NULL, FALSE)
        ->addMore('user_info.address2', 'آدرس دوم', null, FALSE)
        ->addMore('user_info.description', 'توضیح بازاریاب', null, FALSE)
        ->addCol('user_info.zip_code', 'کد پستی', NULL, FALSE)
        ->addCol('pay_number', 'شماره پرداخت', NULL, FALSE)
        ->addCol('user_info.att_type_str', 'نحوه جذب', NULL, FALSE)
        ->addCol('user_info.attraction', 'معرف', NULL, FALSE)
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('active_str', 'فعال', 'active')
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




<?php
$table = new \App\View\NgTable('جدول رویداد های سیستمی', 'tbl', 'console/manage/log');
$table
        ->addCol('user.name', 'کاربر', 'uid')
        ->addCol('type_str', 'نوع رویداد', 'type')
        ->addMore('message', 'پیغام')
        ->addCol('severity', 'اهمیت')
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addCol('updated_at_j', 'بروزرسانی', 'updated_at', FALSE);


$table->addFilter('type', 'نوع رویداد', 'type', 'select', \App\DB\Log::getTypes());
$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');
$table->addFilter('updated_at', 'بروزرسانی', 'updated_at', 'date');
?>

<section class="w-box p-md">
    @include('MD.table.table' , $table->export())
</section>

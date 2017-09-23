@include('admin.page.manage.user.user_form')

<?php $table = new \App\View\NgTable('جدول کاربران سامانه', 'tbl', 'console/manage/user-list');
$table->addCol('fname', 'نام');
$table->addCol('lname', 'نام خانوادگی');
$table->addCol('type_str', 'نوع کاربری', 'type');
$table->addCol('email', 'ایمیل');
$table->addInclude('opt', 'عملیات', 'admin.page.manage.user.block.user_list_opt');
?>

<section class="w-box p-md mt-md">
    @include('MD.header.header' , ['title'=>'کاربران سامانه'])
    @include('MD.table.table' , $table->export())
</section>

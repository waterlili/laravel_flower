<?php
$fname = new \App\View\InputObject('data.fname', trans('field.fname'));
$lname = new \App\View\InputObject('data.lname', trans('field.lname'));
$username = new \App\View\InputObject('data.username', trans('field.username'));
$email = new \App\View\InputObject('data.email', trans('field.email'));
$password = new \App\View\InputObject('data.password', trans('field.password'));
$confirm = new \App\View\InputObject('data.confirm', trans('field.confirm'));
$fname->setRequired(true)->hasMessage('Form', 'fname');
$lname->setRequired(true)->hasMessage('Form', 'fname');
$username->setRequired(true)->hasMessage('Form', 'fname');
$email->setRequired(true)->hasMessage('Form', 'fname');
$password->setRequired(true)->hasMessage('Form', 'fname');
$confirm->setRequired(true)->hasMessage('Form', 'fname');
$password->setType('password');
$confirm->setType('password');
$email->setType('email');
$email->setMessage('email', trans('validation.email', ['attribute' => 'email']));
$email->hasMessage('Form', 'email');
$confirm->hasMessage('Form', 'confirm');
$password->hasMessage('Form', 'password');
$confirm->setMessage('confirm', trans('subject.password_confirm_must_be_same'));
$type = \App\View\Select::create('data.type' , 'نوع کاربری',\App\DB\User::$TYPES)->setRequired(true)->export();
?>

<section class="w-box p-md">
    <form name="Form">
        <div layout-gt-md="row">
            <div flex-gt-md="66" class="input-cnt m-md p-md">
                @include('MD.header.header' , ['title'=>'ایجاد کاربر'])
                <div layout-gt-md="row">
                    <div flex-gt-md="50">
                        @include('MD.input.text-sm' , $fname->export())
                        @include('MD.input.text-sm' , $lname->export())
                    </div>
                    <div flex-gt-md="50" class="mr-md-md">
                        @include('MD.input.select-sm' , $type)
                        @include('MD.input.text-sm' , $username->export())
                        @include('MD.input.text-sm' , $email->export())
                        @if(!isset($edt))
                            @include('MD.input.text-sm' , $password->export())
                            @include('MD.input.text-sm' , $confirm->export())
                        @endif
                    </div>
                </div>
            </div>
            @if(isset($edt))
                <div flex-gt-md="33" class="input-cnt m-md p-md">
                    <div class="image-thumb">
                        <img src="{{data.personal.url}}" alt="">
                    </div>
                    @include('register.block.uploader' , [
            'class_color'=>'md-primary',
            'top_title'=>'بارگذاری تصویر کاربری',
            'top_description'=>'فایل می بایست از نوع تصویر بوده و حداکثر 500 کیلوبایت باشد.',
            'title'=> 'انتخاب فایل',
            'accept'=>"'image/*'",
            'max_size'=>'500KB',
            'types'=>'jpg',
            'model'=>'data.personal',
            'name'=>'personal_picture',
            ])
                </div>
            @endif
        </div>
        @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'errorItem'])
        @if(!isset($edt))
            @include('MD.button.submit' , ['title'=>'ایجاد'])
        @endif
    </form>
</section>
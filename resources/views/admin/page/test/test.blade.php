<?php
$t = \App\View\Text::create('data.name', 'نام خانوادگی')->setRequired(true)->export();
?>


<div>
    <form name="Form">
        @include('MD.input.text-sm' , $t)
        @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'errorItem'])
        @include('MD.button.submit' , ['title'=>"ثبت سند" , 'submit'=>'ara()'])
    </form>
</div>



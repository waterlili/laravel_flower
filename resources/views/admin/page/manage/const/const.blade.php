<?php
$packet_price = App\View\Text::create('packet_type.price', 'قیمت')->export();
?>
<section>
    <div layout-gt-md="row" layout-align="start start" class="mt-md">
        <div flex-gt-md="90" class="w-box p-md mh-md">
            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'color' , 'title'=>'رنگ' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'color.errorItems'])
        </div>
        <div flex-gt-md="90" class="w-box p-md mh-md">
            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'flower' , 'title'=>'گل' ])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'flower.errorItems'])
        </div>
        <div flex-gt-md="90" class="w-box p-md mh-md">
            <div layout="row" layout-align="start center">
                @include('admin.block.const' , ['name'=>'packet_type' , 'title'=>'نوع بسته'])
            </div>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'packet_type.errorItems'])
        </div>


    </div>

</section>
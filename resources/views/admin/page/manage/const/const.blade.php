<?php
$flower = App\View\Text::create('flower.name', 'نام گل')->export();
$pack = App\View\Text::create('pack.name', 'نوع محصول')->export();
$cost = App\View\Text::create('cost.name', 'نوع هزینه های جاری')->export();
$user_type = App\View\Text::create('user_type.name', 'نوع مشتری')->export();
$packet_type = App\View\Text::create('packet_type.name', 'نوع')->setRequired(true)->export();
$packet_price = App\View\Text::create('packet_type.price', 'قیمت')
    ->setRequired(true)
    ->setInpAttr('format-as-currency')
    ->form()
    ->export();
?>
<section>
    <div layout-gt-md="row" layout-align="start start" class="mt-md">
        <div flex-gt-md="33" class="w-box p-md mh-md">
            <header class="w-box-header h-md">نام گل</header>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $flower)
                <md-button ng-click="flower.add()" ng-disabled="!flower.name">ثبت</md-button>
            </div>
            <fieldset>
                <div>
                    <div ng-repeat="item in flower.items" class="const-item">
                        {{item.title}}
                    </div>
                </div>
            </fieldset>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'flower.errorItems'])
        </div>
        <div flex-gt-md="33" class="w-box p-md mh-md">
            <header class="w-box-header h-md">نوع محصول </header>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $pack)
                <md-button ng-click="pack.add()" ng-disabled="!pack.name">ثبت</md-button>
            </div>
            <fieldset>
                <div>
                    <div ng-repeat="item in pack.items" class="const-item">
                        {{item.title}}
                    </div>
                </div>
            </fieldset>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'pack.errorItems'])
        </div>
        <div flex-gt-md="33" class="w-box p-md mh-md">
            <header class="w-box-header h-md">نوع هزینه های جاری</header>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $cost)
                <md-button ng-click="cost.add()" ng-disabled="!cost.name">ثبت</md-button>
            </div>
            <fieldset>
                <div>
                    <div ng-repeat="item in cost.items" class="const-item">
                        {{item.title}}
                    </div>
                </div>
            </fieldset>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'pack.errorItems'])
        </div>
    </div>
    <div layout-gt-md="row" layout-align="start start" class="mt-md">
        <div flex-gt-md="33" class="w-box p-md mh-md">
            <header class="w-box-header h-md">نوع مشتری</header>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $user_type)
                <md-button ng-click="user_type.add()" ng-disabled="!user_type.name">ثبت</md-button>
            </div>
            <fieldset>
                <div>
                    <div ng-repeat="item in user_type.items" class="const-item">
                        {{item.title}}
                    </div>
                </div>
            </fieldset>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'flower.errorItems'])
        </div>
    </div>
    <div layout-gt-md="row" layout-align="start start" class="mt-md">
        <div flex-gt-md="33" class="w-box p-md mh-md">
            <header class="w-box-header h-md">بسته</header>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $packet_type)
            </div>
            <div layout="row" layout-align="start center">
                @include('MD.input.text' , $packet_price)
                <md-button ng-click="packet_type.add()" ng-disabled="!packet_type   .name || !packet_type.price">ثبت
                </md-button>
            </div>
            <fieldset>
                <div>
                    <div ng-repeat="item in packet_type.items" class="const-item">

                        {{item.title}}</br>
                        {{item.price}}
                        @include('admin.block.clearBtn' , ['id'=>'item.id' , 'title'=>'package_types' , 'where'=>'package_types'])

                    </div>

                </div>
            </fieldset>
            @include('MD.Notice.notice' ,['type'=>'error' , 'repeat'=>'package_type.errorItems'])
        </div>
    </div>
</section>
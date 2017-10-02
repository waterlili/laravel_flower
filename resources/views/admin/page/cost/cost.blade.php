<?php
$table = new \App\View\NgTable('جدول هزینه کردها', 'tbl', 'console/cost/list');
$table
        ->addCol('id', 'شماره سند')
        ->addCol('title', 'عنوان')
        ->addMore('description', 'توضیحات')
        ->addMore('paraph', 'پاراف')
        ->addCol('price', 'مبلغ', NULL, true, false, 'currency:"":""')
        ->addCol('type', 'نوع هزینه')
        ->addCol('user_full_name.name', 'دریافت کننده', 'user.lname')
        ->addCol('reviewer_full_name.name', 'بازبین', 'reviewer.lname')
        ->addCol('parent.title', 'پدر')
        ->addCol('sts_str', 'وضعیت', 'sts')
        ->addCol('created_at_j', 'ایجاد در', 'created_at', FALSE)
        ->addCol('updated_at_j', 'بروزرسانی', 'updated_at', FALSE)
        ->addInclude('opt', 'عملیات', 'admin.page.customer.block.listOpt');

$table->addFilter('id', 'شماره سند', 'id', 'number');
$table->addFilter('title', 'عنوان', 'title', 'text');
$table->addFilter('description', 'توضیحات', 'description', 'text');
$table->addFilter('paraph', 'پاراف', 'paraph', 'text');
$table->addFilter('price', 'مبلغ', 'price', 'number');
$table->addFilter('type', 'نوع هزینه', 'type', 'text');
$table->addFilter('uid', 'دریافت کننده', 'user.lname', 'text');
$table->addFilter('reviewer', 'بازبین', 'reviewer.lname', 'text');
$table->addFilter('parent', 'عنوان پدر', 'parent.title', 'text');
$table->addFilter('sts', 'وضعیت', 'sts', 'select', \App\DB\Cost::getStsStr());

$table->addFilter('created_at', 'تاریخ ایجاد', 'created_at', 'date');
$table->addFilter('updated_at', 'بروزرسانی', 'updated_at', 'date');


//Form
$title = App\View\Text::create('data.title', 'عنوان سند')->setRequired(true)->form()->export();
$price = App\View\Text::create('data.price', 'مبلغ')
        ->setInpAttr('format-as-currency')
        ->setRequired(true)
        ->form()
        ->export();
$description = App\View\Text::create('data.description', 'شرح سند')->export();
$paraph = App\View\Text::create('data.paraph', 'پاراف')->export();
$sts = \App\View\Select::create('data.sts', 'وضعیت سند', \App\DB\Cost::getStsStr())->export();
$type = \App\View\Select::create('data.type', 'نوع هزینه', \App\DB\Cost::getTypes())->export();
$uid = \App\View\Ac::create('data.uid', 'uidOpt', 'console/cost/uid-list', 'دریافت کننده')->export();
$parent = \App\View\Ac::create('data.parent', 'parentOpt', 'console/cost/parent-list', 'سند پدر')->export();

?>

<section class="w-box p-md">
    <header class="w-box-header h-md">
        <md-button class="md-icon-button md-primary" ng-click="show_form = !show_form" ng-class="{'md-raised':show_form}">
            <i class="material-icons md-24 md-dark">keyboard_arrow_down</i>
        </md-button>
        <span>ثبت هزینه جاری</span>
    </header>
    <div ng-show="show_form">
        <form name="Form">
            <div layout-gt-md="row" layout-align="start start">
                <div flex-gt-md="50" class="mh-sm-md">
                    @include('MD.input.text' , $title)
                </div>
                <div flex-gt-md="25" class="mh-sm-md">
                    @include('MD.input.text' , $price)
                </div>
                <div flex-gt-md="25" class="mh-sm-md">
                    {!! $uid !!}
                </div>
            </div>
            <div layout-gt-md="row" layout-align="start start">
                <div flex-gt-md="33" class="mh-sm-md">
                    @include('MD.input.select' , $type)
                </div>
                <div flex-gt-md="33" class="mh-sm-md">
                    @include('MD.input.select' , $sts)
                </div>
                <div flex-gt-md="33" class="mh-sm-md">
                    {!! $parent !!}
                </div>
            </div>
            <div>

            </div>
            <fieldset>
                <legend>توضیحات تکمیلی</legend>
                <div>
                    @include('MD.input.text' , $description)
                    @include('MD.input.text' , $paraph)
                </div>
            </fieldset>
            @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'errorItem'])
            @include('MD.button.submit' , ['title'=>"ثبت سند"])
        </form>
    </div>
</section>
<section class="w-box mt-md">
    @include('MD.table.table' , $table->export())
</section>
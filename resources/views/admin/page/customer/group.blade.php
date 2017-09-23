<?php

$group = App\View\Text::create('group.text', 'عنوان گروه')->form()->export();
$select = \App\View\UiSelect::create('group.parent', 'گروه پدر', 'group.all', 'title')->export();

$chip = \App\View\MdChip::create('data.groups', 'chipOpt', 'console/customer/search-groups', 'انتخاب گروه')->export();
$customers = \App\View\MdChip::create('data.customers', 'chipCusOpt', 'console/customer/search-customers', 'انتخاب مشتری')
        ->export();
?>
<section class="w-box p-md">
    <header class="w-box-header h-md">
        مدیریت گروه های مشتریان
    </header>
    <form name="Form">
        <div layout-gt-md="row">
            <div flex-gt-md="33">
                <fieldset>
                    <legend>ایجاد گروه جدید</legend>
                    <div>
                        <div layout="row" layout-align="start center">
                            @include('MD.input.text' , $group)

                            <md-button class="md-raised md-primary" ng-click="group.add()"
                                       ng-disabled="!group.text || group.loading">افزودن
                            </md-button>
                        </div>
                        <md-divider class="mv-md"></md-divider>
                        <div>گروه پدر</div>
                        @include('MD.input.ui-select' , $select)
                        @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'group.errorItem'])
                    </div>
                </fieldset>
            </div>
            <div flex-gt-md="66" class="mr-md-md">
                <fieldset>
                    <legend>
                        گروه ها
                    </legend>
                    <div>
                        <div style="overflow: auto;max-height: 250px">
                            <group-collection collection='group.all'
                                              url="console/group-collection"></group-collection>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        @include('MD.Notice.notice' , ['type'=>'info' , 'repeat'=>'submit.infoItem'])
        @include('MD.Notice.notice' , ['type'=>'error' , 'repeat'=>'submit.errorItem'])
    </form>
</section>

<section class="w-box p-md mt-md">
    <header class="w-box-header h-md">
        انتصاب گروه به مشتریان
    </header>
    <div>
        <div layout-gt-md="row">
            <div flex-gt-md="50">
                <fieldset>
                    <legend>گروه</legend>
                    <div>
                        {!! $chip !!}
                    </div>
                </fieldset>
            </div>
            <div flex-gt-md="50" class="mr-md">
                <fieldset>
                    <legend>مشتریان</legend>
                    <div>
                        {!! $customers !!}
                    </div>
                </fieldset>
            </div>
        </div>
        <div>
            <md-button ng-click="submit()" class="md-raised md-primary">ثبت گروه بندی</md-button>
        </div>
    </div>
</section>
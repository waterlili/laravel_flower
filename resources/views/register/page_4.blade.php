@extends('register.master')
@section('title' , trans('register.page_4_header_title'))
@section('header_title' , trans('register.page_4_header_title'))
@section('header_description' , trans('register.page_4_header_description'))
@section('content')

    <div class="md-bg md-background md-hue-1 b-shadow-top">
        <div class="cm" layout-gt-md="row">
            <div class="step-bar-wrapper">
                <div class="step-bar" show-gt-md hide></div>
                @include('register.block.step' , ['title'=>trans('register.page_1_header_title') , 'hasTick'=>TRUE])
                @include('register.block.step' , ['title'=>trans('register.page_2_header_title') , 'hasTick'=>TRUE])
                @include('register.block.step' , ['title'=>trans('register.page_3_header_title') , 'hasTick'=>TRUE])
            </div>
            <div flex></div>
        </div>
    </div>
    <div class="md-bg md-background">
        <div class="cm" layout-gt-md="row" flex="grow">
            <div class="step-bar-wrapper" show-gt-md hide layout-padding>
                <div class="step-bar"></div>
                <div layout="row" class="step-item" layout-align="center center">
                    <div class="step-bar-number active">4</div>
                </div>
            </div>
            <div flex>
                <form name="FONE">
                    <h3 class="mb-md mt-sm"><% trans('register.page_4_header_title') %></h3>
                    <?php
                    $full_name = ($p->personal['sex'] == 1) ? 'جناب آقای' : 'سرکار خانم';
                    $full_name .= ' ' . $p->personal['fname'] . ' ' . $p->personal['lname'];
                    $sex_value = ($p->personal['sex'] == 1) ? 'آقا ' : 'خانم ';
                    ?>
                    @include('register.block.notice' , ['type'=>'info' , 'text'=>trans('register.all_step_success' ,['full_name'=>$full_name])])
                    @include('register.block.notice' , ['type'=>'warn' , 'text'=>trans('register.transaction_code')])

                    @include('register.block.divider' , ['icon'=>'&#xE8A6;' , 'title'=>trans('register.iden_info')])
                    <div layout-gt-md="row" layout-align="start center">
                        @include('register.block.itemShow' , ['field'=>'نام و نام خانوادگی' , 'value'=>$p->personal['fname'].' '.$p->personal['lname']])
                        @include('register.block.itemShow' , ['field'=>'نام پدر' , 'value'=>$p->personal['father_name']])
                        @include('register.block.itemShow' , ['field'=>'جنسیت' , 'value'=>$sex_value])
                    </div>
                    <div layout-gt-md="row" layout-align="start center">
                        @include('register.block.itemShow' , ['field'=>'کد ملی' , 'value'=>$p->personal['ncode']])
                        @include('register.block.itemShow' , ['field'=>'تاریخ تولد' , 'value'=>\Morilog\Jalali\jDate::forge($p->personal['birth_date'])->format('Y/n/d')])
                        <div flex></div>
                    </div>

                    @include('register.block.divider' , ['icon'=>'&#xE0CD;' , 'title'=>trans('register.phone_info')])
                    <div layout-gt-md="row" layout-align="start center">
                        @include('register.block.itemShow' , ['field'=>'شماره تلفن ثابت' , 'value'=>$p->personal['phone']])
                        @include('register.block.itemShow' , ['field'=>'تلفن همراه' , 'value'=>isset($p->personal['mobile'])?$p->personal['mobile']:'ندارم'])
                        @include('register.block.itemShow' , ['field'=>'تلفن همراه ولی' , 'value'=>$p->personal['mobile_parent']])
                    </div>


                    @include('register.block.divider' , ['icon'=>'&#xE0C8;' , 'title'=>trans('register.address_info')])
                    <div layout-gt-md="row" layout-align="start center">
                        @include('register.block.itemShow' , ['field'=>'استان' , 'value'=>config('state.state')[$p->personal['state']]])
                        @include('register.block.itemShow' , ['field'=>'شهر' , 'value'=>config('state.city')[$p->personal['state']][$p->personal['city']-1]])
                        <div flex></div>
                    </div>
                    <div layout-gt-md="row" layout-align="start center">
                        <div flex-gt-md="66">@include('register.block.itemShow' , ['field'=>'آدرس پستی' , 'value'=>$p->personal['address']])</div>
                        <div flex-gt-md="33">@include('register.block.itemShow' , ['field'=>'کد پستی' , 'value'=>$p->personal['zip_code']])</div>
                    </div>


                    @include('register.block.divider' , ['icon'=>'&#xE14F;' , 'title'=>'رشته و گرایش'])
                    <div>
                        @if($p->hasShafahi())
                            <div>
                                <span class="_field ml-sm">رشته</span>
                                <span class="md-fg ml-sm">شفاهی</span>
                                <span class="_field ml-sm">گرایش</span>
                                <span class="md-fg ml-sm"><% config('field.title')[$p->shafahi] %></span>
                            </div>
                        @endif

                        @if($p->hasHonari())
                            <div>
                                <span class="_field ml-sm">رشته</span>
                                <span class="md-fg ml-sm">هنری</span>
                                <span class="_field ml-sm">گرایش</span>
                                <span class="md-fg ml-sm"><% config('field.title')[$p->honari] %></span>
                            </div>
                        @endif

                        @if($p->hasAzan())
                            <div>
                                <span class="_field ml-sm">رشته</span>
                                <span class="md-fg ml-sm">اذان</span>
                            </div>
                        @endif

                        @if($p->hasTavashih())
                            <div>
                                <span class="_field ml-sm">رشته</span>
                                <span class="md-fg ml-sm">تواشیح</span>
                                @if($p->hasTavashih())
                                    <span class="_field ml-sm">و همچنین سرپرست گروه هستم</span>
                                @endif
                            </div>
                        @endif
                        @if(!is_null($p->cantUpload))
                            <div class="md-fg"><% trans('register.cantUpload') %></div>
                        @endif
                        <div flex></div>
                    </div>


                    <div class="ar-divider"><span class="ar-line"></span></div>
                    <div class="area-notice">
                        @include('register.block.notice' , ['repeat'=>'stp1.errorItem','type'=>'error'])
                        @include('register.block.notice' , ['repeat'=>'stp1.infoItem','type'=>'info'])
                        @include('register.block.notice' , ['text'=>trans('register.noEditable'),'type'=>'warn'])
                    </div>
                    @include('register.block.preloader')
                    <div layout-gt-md="row">
                        <md-button class="md-raised md-warn mr-n" layout="row" layout-align="center center"
                                   ng-click="back()"><i class="material-icons">&#xE409;</i>
                            <span><% trans('register.backStep') %></span>
                        </md-button>

                        <div flex></div>
                        <md-button class="md-raised md-primary" layout="row" layout-align="center center"
                                   ng-click="stp4.submit()"
                                   ng-disabled="FONE.$invalid"><i
                                    class="material-icons">&#xE876;</i>
                            <span><% trans('register.submitAndGetCode') %></span>
                        </md-button>
                        @if(\Illuminate\Support\Facades\App::environment('local'))
                            <md-button class="md-primary" layout="row" layout-align="center center"
                                       ng-click="csession()">clear session
                            </md-button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
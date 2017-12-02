@extends('register.master')
@section('title' , trans('register.page_4_header_title'))
@section('header_title' , trans('register.page_4_header_title'))
@section('header_description' , trans('register.page_4_header_description'))
@section('content')


    <div class="md-bg md-background">
        <div class="cm mb-md">
            <?php
            $full_name = ($p->personal['sex'] == 1) ? 'جناب آقای' : 'سرکار خانم';
            $full_name .= ' ' . $p->personal['fname'] . ' ' . $p->personal['lname'];
            ?>
            <div >
                <h1 class="md-fg pv-md">رسید ثبت نام مسابقات قرآنی بیان</h1>
                <md-divider></md-divider>
            </div>
            @include('register.block.notice' , ['type'=>'info' , 'text'=>trans('register.final_code' , ['full_name'=>$full_name])])
            <div class="input-cnt p-md tac">
                <h3>کد رهگیری ثبت نام شما : </h3>
                <h2 class="md-fg"><% $p->personal['tracking_code'] %></h2>
            </div>
            <div class="input-cnt mt-md p-md">
                <div layout-gt-md="row" layout-align="start center">
                    @include('register.block.itemShow' , ['field'=>'نام و نام خانوادگی' , 'value'=>$p->personal['fname'].' '.$p->personal['lname']])
                    @include('register.block.itemShow' , ['field'=>'نام پدر' , 'value'=>$p->personal['father_name']])
                </div>
                <div class="mt-md" layout-gt-md="row" layout-align="start center">
                    @include('register.block.itemShow' , ['field'=>'کد ملی' , 'value'=>$p->personal['ncode']])
                    @include('register.block.itemShow' , ['field'=>'تاریخ تولد' , 'value'=>\Morilog\Jalali\jDate::forge($p->personal['birth_date'])->format('Y/n/d')])
                    @include('register.block.itemShow' , ['field'=>'سن' , 'value'=>$p->personal['age']. ' سال'])
                </div>
            </div>
            <div class="input-cnt mt-md p-md">
                <div layout-gt-md="row" layout-align="start center">
                    @include('register.block.itemShow' , ['field'=>'شماره تلفن ثابت' , 'value'=>$p->personal['phone']])
                    @include('register.block.itemShow' , ['field'=>'شماره تلفن همراه' , 'value'=>$p->personal['mobile']])
                    @include('register.block.itemShow' , ['field'=>'شماره تلفن همراه ولی' , 'value'=>$p->personal['mobile_parent']])
                </div>
                <div class="mt-md" layout-gt-md="row" layout-align="start center">
                    @include('register.block.itemShow' , ['field'=>'استان' , 'value'=>config('state.state')[$p->personal['state']]])
                    @include('register.block.itemShow' , ['field'=>'شهر' , 'value'=>config('state.city')[$p->personal['state']][$p->personal['city']]])
                    @include('register.block.itemShow' , ['field'=>'کد پستی' , 'value'=>$p->personal['zip_code']])
                </div>
            </div>
            <div class="input-cnt p-md mt-md">
                <h3>زمان ثبت نام :</h3>
                <h3 class="md-fg"><% \Morilog\Jalali\jDate::forge($p->person['created_at'])->format('Y/n/d ساعت h:i:s') %></h3>
            </div>
            @include('register.block.notice' , ['type'=>'info' , 'text'=>trans('register.contact_us')])
            <div layout-gt-md="row" layout-align="start center" hide-print>
                <md-button class="md-raised md-primary md-hue-1" ng-click="_printPreview()">چاپ</md-button>
                <md-button class="md-primary" layout="row" layout-align="center center"
                           ng-click="exit()">خروج و رفتن به صفحه اصلی
                </md-button>
            </div>
        </div>
    </div>
@endsection
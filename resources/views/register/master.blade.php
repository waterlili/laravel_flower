<!doctype html>
<html lang="fa" dir="rtl" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>@yield('title' ,'ثبت نام')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('register.import')
</head>
<body class="md-default-theme">

<section id="main" ng-controller="RegisterCtrl">
    <div hide-print class="md-bg ">
        <div class="cm" layout-gt-md="row" layout-align="center center">
            <img class="p-xs" width="180px" src="<% url('img/logo-admin.svg') %>" alt="">
            <div flex></div>
            <img class="p-xs" height="40px" src="<% url('img/logo-samaneh.svg') %>" alt="">
        </div>
    </div>
    <header class="md-bg md-hue-2" hide-print>
        <div class="cm" layout="row" layout-align="start center">
            <md-button class="m-n md-fg md-background">قوانین و مقررات</md-button>
            <i class="material-icons md-18 md-fg md-background">&#xE5D4;</i>
            <md-button class="m-n md-fg md-background">راهنمای ثبت نام</md-button>
            <i class="material-icons md-18 md-fg md-background">&#xE5D4;</i>
            <md-button class="m-n md-fg md-background">راهنمای شرکت در مسابقه</md-button>
            <span flex></span>
            <div class="h5 md-fg md-background" show-gt-md hide>
                <?php
                $today = \Carbon\Carbon::now();
                $last_day = \Carbon\Carbon::createFromFormat('Y-n-d',
                        \Morilog\Jalali\jDate::dateTimeFromFormat('Y-n-d', '1395-3-30')
                                ->format('Y-n-d'));
                print $last_day->diffInDays($today);
                ?> روز مانده تا پایان مهلت ثبت نام
            </div>
        </div>
    </header>
    @if(!isset($no_top_header))
        <section class="header-section md-bg" style="border-bottom: 1px solid rgba(39, 39, 39, 0.35)" hide-print>
            <div class="cm" layout-padding layout-gt-md="row" layout-align="center center">
                <div>
                    <h3 class="header-title md-fg  md-background">@yield('header_title' , 'بدون عنوان')</h3>
                    <p style="margin: 0;font-size: 0.85em" class="lh-1 md-primary md-hue-1 md-fg">
                        <i class="material-icons md-18" style="vertical-align: middle">&#xE873;</i>
                        @yield('header_description')
                    </p>
                </div>
                <span flex></span>
                <md-button class="md-icon-button"><i class="material-icons md-light">&#xE887;</i>
                    <md-tooltip md-direction="right">راهنمای ثبت نام</md-tooltip>
                </md-button>
            </div>
        </section>
    @endif
    @yield('content')
    @include('register.footer')
</section>
</body>
</html>
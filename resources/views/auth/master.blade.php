<!doctype html>
<html dir="rtl" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>@yield('title' ,'گروه توسعه نرم افزاری رویش')</title>
    @include('admin.import')
    <style>
        body {
            background-image: url(<% url('img/login/'.(mt_rand(1,20)).'.jpg') %>);
            background-size: cover;
        }
    </style>
</head>
<body>

<main ng-controller="@yield('Ctrl')" style="padding: 1px;">
    <div>
        <div id="auth-content">
            <figure>
                <img id="logo-form" src="@yield('form_logo')" alt="" width="110px"/>
            </figure>
            <h1 class="page-title form-title">@yield('form_title')</h1>
            @yield('form_content')
            @yield('result' , '')
            @include('auth.preloader')
        </div>
    </div>
</main>

</body>
</html>

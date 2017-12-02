<!doctype html>
<html lang="fa" ng-app="app" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title' ,'Rooyesh Software Development')</title>
    @include('admin.import')
    <meta name="viewport" content="initial-scale=1">
    <style>
        md-input-container.md-default-theme .md-input, md-input-container .md-input {
            color: rgba(0,0,0,0.87);
            border-color: rgba(0, 0, 0, 0.6);
        }
        md-input-container.md-default-theme label, md-input-container label, md-input-container.md-default-theme .md-placeholder, md-input-container .md-placeholder {
            color: rgba(0, 0, 0, 0.81);
        }
    </style>
</head>
<body md-theme="default" class="md-theme-default">
@yield('content')
</body>
</html>
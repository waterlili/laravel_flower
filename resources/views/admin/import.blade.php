<meta name="csrf-token" content="<% csrf_token() %>">
<script>var __domain = '<% url("/") %>' + '/'</script>
<script>var $$routes = '<?php echo \App\Http\UiRoute::getUiRoute() ?>' </script>
<?php
// all scripts
$js = [
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/hamsterjs/hamster.js',
        'bower_components/underscore/underscore-min.js',
        'bower_components/semantic/semantic.min.js',
        'bower_components/angular/angular.min.js',
        'bower_components/chart.js/dist/Chart.min.js',
        'bower_components/angular-route/angular-route.min.js',
        'bower_components/angular-ui-router/release/angular-ui-router.min.js',
        'bower_components/angular-animate/angular-animate.min.js',
        'bower_components/angular-resource/angular-resource.min.js',
        'bower_components/angular-aria/angular-aria.min.js',
        'bower_components/angular-material/angular-material.min.js',
        'bower_components/angular-messages/angular-messages.min.js',
        'bower_components/angular-ui-tree/dist/angular-ui-tree.min.js',
        'bower_components/ng-table/dist/ng-table.min.js',
        'bower_components/angular-mousewheel/mousewheel.js',
        'bower_components/angular-chart.js/dist/angular-chart.min.js',
        'bower_components/ng-file-upload/ng-file-upload-shim.min.js',
        'bower_components/ng-file-upload/ng-file-upload.min.js',
        'bower_components/ckeditor/ckeditor.js',
        'bower_components/angular-ckeditor/angular-ckeditor.min.js',
        'bower_components/myColor/myColor.js',
        'bower_components/format-as-currency/dist/format-as-currency.js',
        'bower_components/angular-sanitize/angular-sanitize.min.js',
        'bower_components/angular-ui-select/dist/select.min.js',
        'bower_components/angular-ui-mask/dist/mask.min.js',
        'bower_components/ng-popover/dist/angular-popover.min.js',
        'bower_components/moment/min/moment.min.js',
        'bower_components/moment-jalaali/build/moment-jalaali.js',
        'bower_components/mdPickers/dist/mdPickers.min.js',
        'bower_components/ng-jalaali-flat-datepicker/dist/ng-jalaali-flat-datepicker.min.js',
        'js/all.js?' . time(),
        'js/TestCtrl.js?' . time(),

        'js/OrderAddNewCtrl.js?' . time(),
];

// all styles
$style = [
        'css/font-awesome.min.css',
        'bower_components/flag-icon-css/css/flag-icon.min.css',
        'bower_components/angular-material/angular-material.css',
        'bower_components/angular-material/angular-material.layouts.min.css',
        'bower_components/semantic/semantic.rtl.css',
        'bower_components/ng-table/dist/ng-table.min.css',
        'bower_components/ng-scrollbar/dist/ng-scrollbar.min.css',
        'bower_components/ng-jalaali-flat-datepicker/dist/ng-jalaali-flat-datepicker.min.css',
        'css/material-design-iconic-font.min.css',
        'css/material-design-iconic-font.min.css',
        'bower_components/ng-popover/dist/angular-popover.css',
        'fonts/iconfont/material-icons.css',
        'bower_components/tw-currency-select/dist/tw-currency-select.css',
        'bower_components/angular-ui-select/dist/select.min.css',
        'bower_components/mdPickers/dist/mdPickers.min.css',
        'css/app.css',
        'css/extra.css?' . time(),
];

foreach ($js as $item) {
    echo '<script src="' . url($item) . '" type="text/javascript"></script>';
    echo PHP_EOL;
}

foreach ($style as $item) {
    echo '<link rel="stylesheet" href="' . url($item) . '"/>';
    echo PHP_EOL;
}





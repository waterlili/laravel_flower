<script>var __domain = '<% url("/") %>' + '/'</script>
<script>var $$routes = '<?php echo \App\Http\UiRoute::getUiRoute() ?>' </script>
<?php
// all scripts
$js = [
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/hamsterjs/hamster.js',
        'bower_components/underscore/underscore-min.js',
        'bower_components/angular/angular.min.js',
        'bower_components/angular-route/angular-route.min.js',
        'bower_components/angular-animate/angular-animate.min.js',
        'bower_components/angular-password/angular-password.min.js',
        'bower_components/angular-resource/angular-resource.min.js',
        'bower_components/intl-tel-input/build/js/intlTelInput.min.js',
        'bower_components/international-phone-number/releases/international-phone-number.min.js',
        'bower_components/intl-tel-input/lib/libphonenumber/build/utils.js',
        'bower_components/angular-ui-mask/dist/mask.min.js',
        'bower_components/angular-aria/angular-aria.min.js',
        'bower_components/angular-material/angular-material.min.js',
        'bower_components/angular-messages/angular-messages.min.js',
        'bower_components/ng-table/dist/ng-table.min.js',
        'bower_components/angular-mousewheel/mousewheel.js',
        'bower_components/ng-scrollbar/dist/ng-scrollbar.min.js',
        'bower_components/myColor/myColor.js',
        'bower_components/ng-file-upload/ng-file-upload-shim.min.js',
        'bower_components/ng-file-upload/ng-file-upload.min.js',
        'bower_components/format-as-currency/dist/format-as-currency.js',
        'bower_components/angular-sanitize/angular-sanitize.min.js',
        'bower_components/angular-ui-select/dist/select.min.js',
        'js/public.js',
];

// all styles
$style = [
        'css/font-awesome.min.css',
        'bower_components/flag-icon-css/css/flag-icon.min.css',
        'bower_components/angular-material/angular-material.min.css',
        'bower_components/ng-table/dist/ng-table.min.css',
        'bower_components/ng-scrollbar/dist/ng-scrollbar.min.css',
        'bower_components/tw-currency-select/dist/tw-currency-select.css',
        'css/material-design-iconic-font.min.css',
        'bower_components/intl-tel-input/build/css/intlTelInput.css',
        'bower_components/angular-ui-select/dist/select.min.css',
//        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'fonts/iconfont/material-icons.css',
        'css/public.css',
];

foreach ($js as $item) {
    echo '<script src="' . url($item) . '" type="text/javascript"></script>';
    echo PHP_EOL;
}

foreach ($style as $item) {
    echo '<link rel="stylesheet" href="' . url($item) . '"/>';
    echo PHP_EOL;
}

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
        'bower_components/angular-resource/angular-resource.min.js',
        'bower_components/angular-aria/angular-aria.min.js',
        'bower_components/angular-material/angular-material.min.js',
        'bower_components/angular-messages/angular-messages.min.js',
        'bower_components/ng-table/dist/ng-table.min.js',
        'bower_components/angular-mousewheel/mousewheel.js',
        'bower_components/ng-scrollbar/dist/ng-scrollbar.min.js',
        'bower_components/myColor/myColor.js',
        'bower_components/ng-file-upload/ng-file-upload-shim.min.js',
        'bower_components/ng-file-upload/ng-file-upload.min.js',
        'js/register.js',
];

// all styles
$style = [
        'css/font-awesome.min.css',
        'bower_components/angular-material/angular-material.min.css',
        'bower_components/ng-table/dist/ng-table.min.css',
        'bower_components/ng-scrollbar/dist/ng-scrollbar.min.css',
        'css/material-design-iconic-font.min.css',
        'fonts/iconfont/material-icons.css',
        'css/register.css',
];

foreach ($js as $item) {
    echo '<script src="' . url($item) . '" type="text/javascript"></script>';
    echo PHP_EOL;
}

foreach ($style as $item) {
    echo '<link rel="stylesheet" href="' . url($item) . '"/>';
    echo PHP_EOL;
}

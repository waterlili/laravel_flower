var app = angular.module('app',
    [
        'ngMaterial', 'ngAnimate', 'mdColors', 'ngMessages', 'internationalPhoneNumber', 'ui.mask', 'bcherny/formatAsCurrency', 'ui.select', 'ngSanitize',
        'ngPassword'
    ]
);
function home($path) {
    return __domain + $path;
}


app.config(function ($mdThemingProvider) {
    var neonRedMap = $mdThemingProvider.extendPalette('cyan', {
        '500': '#00BBD3',
        '300': '#0097a7',
        '600': '#00bcd4',
        '400': '#212121',
        'contrastDefaultColor': 'light'
    });
    // Register the new color palette map with the name <code>neonRed</code>
    $mdThemingProvider.definePalette('araCyan', neonRedMap);
    $mdThemingProvider.theme('default')
        .primaryPalette('cyan', {'default': '700'})
        .accentPalette('blue-grey', {'default': '500', 'hue-1': '600', 'hue-2': '400', 'hue-3': '300'})
        .warnPalette('red', {'default': '600'})
        .backgroundPalette('grey', {'default': '50'});

});

app.config(function (ipnConfig) {
    ipnConfig.defaultCountry = 'ir';
    // ipnConfig.numberType = ipnConfig.numberFormat.NATIONAL;
});


app.filter('curFilter', function () {
    return function (value) {
        return value;
    }
});
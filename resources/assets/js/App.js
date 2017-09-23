var app = angular.module('app', [
    'ngRoute',
    'ngMaterial',
    'ngMessages',
    'ui.router',
    'ckeditor',
    'ui.tree',
    'ngAnimate',
    'ngTable',
    'ngResource',
    'mdColors',
    'chart.js',
    'ngFileUpload',
    'angular-popover',
    'ui.mask',
    'mdPickers',
    'ui.select',
    'bcherny/formatAsCurrency',
    'ngJalaaliFlatDatepicker',
    'ngSanitize'
]);

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
        .primaryPalette('light-green', {'default': '700'})
        .accentPalette('teal', {'default': '500', 'hue-1': '900', 'hue-2': '400', 'hue-3': '300'})
        .warnPalette('red', {'default': '600'})
        .backgroundPalette('grey', {'default': '50'});
});


Chart.defaults.global.defaultFontFamily = 'yek';


var CircleChart = function () {
    this.labels = [];
    this.series = [];
    this.data = [];
    this.options = {};
    this.datasetOverride = {};
    this.defaultOption = function () {
        this.options = {
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false
                        }
                    }
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true
                        }
                    }
                ]
            }
        };
    };

    this.init = function () {
        this.data = [];
        this.series = ['Series 1'];
        for (var i = 0; i < 3; i++) {
            var date = new Date();
            this.labels.push(date.getDate() + i);
            this.data.push(getRandomInt(100, 250));
        }
    };
    this.init();
};

var LineChart = function () {
    this.labels = [];
    this.series = [];
    this.data = [];
    this.options = {};
    this.datasetOverride = [];

    this.defaultOption = function () {
        this.options = {
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [
                    {
                        gridLines: {
                            display: true
                        }
                    }
                ]
            }
        };
    };

    this.init = function () {
        this.data[0] = [];
        this.data[1] = [];
        this.data[2] = [];
        this.series = ['Series 1', 'Series 2', 'Series 3'];
        for (var i = 0; i < 10; i++) {
            var date = new Date();
            this.labels.push(date.getDate() + i);
            this.data[0].push(getRandomInt(100, 150));
            this.data[1].push(getRandomInt(100, 150));
            this.data[2].push(getRandomInt(100, 150));
        }
    };
    this.init();
};

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

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
app.factory('htp', function ($http, notify) {
    var _Htp = function (url, data) {
        this.options = {};
        this.afterSuccess = [];
        var that = this;
        $http.post(url, data)
            .success(function (response) {
                if (that.options.then) {
                    that.options.then.call(this, response);
                }

                if (that.options.after) {
                    that.options.after.call(this, response);
                }
                _.each(that.afterSuccess, function (item) {
                    item.call(that, response);
                });
            })
            .error(function (response, sts) {
                if (that.options.after) {
                    that.options.after.call(this, response, sts);
                }
                if (that.options.error) {
                    that.options.error.call(this, response, sts);
                }
                switch (sts) {
                    case 422:
                        if (that.errorItem) {
                            that.errorItem.call(this, response);
                        }
                        notify('error', trans('message.422'));
                        break;
                }
            });
    };


    _Htp.prototype.then = function (fn) {
        this.options.then = fn;
        return this;
    };

    _Htp.prototype.after = function (fn) {
        this.options.after = fn;
        return this;
    };

    _Htp.prototype.error = function (fn) {
        this.options.error = fn;
        return this;
    };

    _Htp.prototype.errorNotice = function (fn) {
        this.errorItem = fn;
        return this;
    };

    _Htp.prototype.saveSend = function (title) {
        this.afterSuccess.push(function () {
            notify('info', trans('message.set_record', {attr: title}))
        });
        return this;
    };


    return function (url, data) {
        return new _Htp(url, data);
    };
});
app.factory('notify', function () {
    return function ($type, $text, $delay) {
        $delay = $delay || 7500;
        var scope = angular.element('#notify-wrapper').scope();
        if (scope)
            scope._notify($type, $text, $delay);
    }
});


app.controller('NotifyCtrl', function ($scope, $timeout) {
    $scope.admin_notify = [];
    $scope.times = [];
    $scope._notify = function ($type, $text, $delay) {
        $scope.admin_notify.push({type: $type, text: $text, delay: $delay});
        $scope.times.push($timeout(function () {
            $scope._destroy(0);
        }, $delay))
    };
    $scope._destroy = function ($index) {
        $scope.admin_notify = _.without($scope.admin_notify, $scope.admin_notify[$index]);
        $scope.times = _.without($scope.times, $scope.times[$index]);
    };
});
app.factory('loader', function () {
    return function ($sts) {
        var scope = angular.element('#main-progress-bar').scope();
        if($sts) {
            scope._on();
        }
        else{
            scope._off();
        }
    }
});

app.controller('PreloaderCtrl', function ($scope, $timeout) {
    $scope._off = function () {
        $scope._loader = false;
    };
    $scope._on = function () {
        $scope._loader = true;
    }
});
app.controller('PublicCtrl', function ($scope, $http) {
    console.log('scope', $scope);

    $http.post(home('get-currency')).success(function (response) {
        $scope.itemArray = response;
        $scope.selected = {value: $scope.itemArray[0]};
    });

});


app.controller('SignupCtrl', function ($scope, htp, $http) {
    var _this = $scope;
    _this.submit = function () {
        _this.getCountry();
        _this.errorItem = undefined;
        $http.post(home('sign-up'), _this.data).success(function (response) {
            window.locations.href = home('sign-in');
        }).error(function (response, sts) {
            _this.refreshCaptcha();
            if (sts == 422) {
                _this.errorItem = response;
            }
        });
    };

    _this.getCountry = function () {
        _this.data.country = angular.element('#phone-number').intlTelInput("getSelectedCountryData");
    };

    $scope.codeMapper = function (code) {
        return {code: code};
    };

    $scope.codeExtractor = function (currency) {
        return currency.code;
    };
    _this.currencies = ['EUR', 'GBP'];
    _this.refresh_captcha = function () {
        htp(home('get-captcha')).then(function (response) {
            _this.captcha_src = response;
        });
    }
});
//# sourceMappingURL=public.js.map

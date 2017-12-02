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
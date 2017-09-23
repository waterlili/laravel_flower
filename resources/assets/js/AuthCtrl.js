app.controller('RegisterCtrl', function ($scope, $http) {
    $scope.data = {};
    $scope.mode = 0;
    $scope.form_title = ['فرم ثبت نام سریع رویش وب', 'ثبت نام شما با موفقیت انجام شد', 'در فرآیند ثبت نام شما خطایی رخ داده است'];
    $scope.valid_pass = function () {
        if ($scope.register_form) {
            $scope.register_form.$setValidity('pass', ($scope.data.password == $scope.data.password_confirmation));
        }
    };
    $scope.$watch('data.password', function () {
        $scope.valid_pass()
    });
    $scope.$watch('data.password_confirmation', function () {
        $scope.valid_pass()
    });

    $scope.submit = function ($event) {
        $event.preventDefault();
        $scope.loading(true);
        $http.post(home('auth/register'), $scope.data)
            .success(function (response) {
                $scope.loading(false);
                $scope.mode = 1;
                $scope.result = response;
            })

            
            .error(function (response, status) {
                $scope.loading(false);
                if (status == 422) {
                    $scope.server_error = response;
                }
                else if (status == 500 || 400) {
                    $scope.mode = 2;
                }
            });
    };
    $scope.loading = function ($mode) {
        $scope.preloader = $mode;
    }
});


app.controller('LoginCtrl', function ($scope, $http) {
    $scope.data = {};

    $scope.submit = function ($event) {
        $scope.loading(true);
        $scope.server_error = $scope.unauthorized = $scope.not_acceptable = undefined;
        $event.preventDefault();
        $http.post(home('auth/login'), $scope.data)
            .success(function (response) {
                if (response['result'] == true) {
                    window.location.href = response['redirectPath'];
                }
            })
            .error(function (response, status) {
                $scope.loading(false);
                if (status == 422) {
                    $scope.server_error = response;
                } else if (status == 401) {
                    $scope.unauthorized = true;
                } else if (status == 406) {
                    $scope.not_acceptable = true;
                }
            });
    };

    $scope.loading = function ($mode) {
        $scope.preloader = $mode;
    }
});

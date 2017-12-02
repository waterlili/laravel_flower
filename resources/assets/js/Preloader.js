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
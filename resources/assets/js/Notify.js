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
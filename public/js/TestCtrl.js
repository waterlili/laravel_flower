app.controller('TestCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    $scope.submiterUrl = 'console/cost/test';
    $scope.submiterName = 'ثبت تست';
});
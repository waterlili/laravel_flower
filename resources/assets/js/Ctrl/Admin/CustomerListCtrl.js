app.controller('CustomerListCtrl', function ($scope, htp, $mdDialog, notify) {
    var _this = $scope;
    _this.tbl = {};
    _this.orderDialog = function (row, ev) {
        var dialog = $mdDialog.show({
                controller: function ($scope, $controller, dt, $mdDialog) {
                    $scope.dt = dt;
                    $scope.edit_mode = true;
                    $scope.data = {};
                    $scope.hide = function () {
                        $mdDialog.hide();
                    };
                    $scope.cancel = function () {
                        $mdDialog.cancel();
                    };
                    $scope.tbl = {};
                    $scope.tbl.postData = function () {
                        return {
                            uid: dt.id
                        }
                    };

                    var FACTS = function () {
                        this.paid = this.unpaid = this.loyalty = undefined;
                        var that = this;
                        htp(home('console/customer/get-facts-data'), {uid: dt.id}).then(function (response) {
                            if (response && response.result == true) {
                                that.data = response.facts;
                            }
                        });
                    };
                    $scope.facts = new FACTS();
                },
                templateUrl: home('console/customer/get-order-data'),
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    dt: row
                },
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
            .then(function (answer) {

            });
    };


    _this.ibanDialog = function (row, ev) {
        var dialog = $mdDialog.show({
                controller: function ($scope, $controller, dt, $mdDialog) {
                    $scope.dt = dt;
                    $scope.edit_mode = true;
                    $scope.hide = function () {
                        $mdDialog.hide();
                    };
                    $scope.cancel = function () {
                        $mdDialog.cancel();
                    };
                    $scope.editBtnDialog = function () {
                        $scope.preloader = true;
                        htp(home('console/edit-dialog'), {
                            data: $scope.data
                        }).then(function (response) {
                            $scope.preloader = false;
                            $mdDialog.hide();
                        });
                    };
                    // $controller(ctrl, {$scope: $scope});
                    $scope.init = function ($id) {
                        htp(home('console/customer/get-iden-info'), {id: $id}).then(function (response) {
                            console.log('response', response);
                            $scope.ibans = response;
                        });
                    };
                },
                templateUrl: home('console/customer/iban-info/' + row.id),
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    dt: row
                },
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
            .then(function (answer) {

            });
    }
});
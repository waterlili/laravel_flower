app.controller('FlowerPacketAddCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/flower_packet/add';
    _this.submiterName = 'بسته';

    if (_this.edit_mode) {
        _this.data = _this.dt;
        console.log(_this.data);
    }
    _this.data = {};
    _this.data.composit = [];
    _this.data.combine_arr = [];
    _this.data.tarkibs = [];
    _this.flowers_arr = [];
    _this.data.checkedCombines = [];

    _this.toggleCheck = function (combine) {
        if (_this.data.checkedCombines.indexOf(combine) === -1) {
            _this.data.checkedCombines.push(combine);
        } else {
            _this.data.checkedCombines.splice(_this.data.checkedCombines.indexOf(combine), 1);
        }
    };

    var COMP = function () {
        this.disabled = false;
        this.package = this.packages = undefined;
        htp(home('console/flower_packet/packages-list')).then(function (response) {
            _this.data.packages = response;
            _this.packages_arr = [];
            for(var i = 0; i < response.length; i++){
                _this.packages_arr[response[i].id] = response[i];
            }
        });
        this.add = function () {
            _this.data.composit.push({
                package: this.package
            });
            this.package = undefined;
        };

        this.remove = function ($index) {
            _this.data.composit = _.without(_this.data.composit, _this.data.composit[$index]);
        };
    };
    _this.afterSuccess = function () {
        _this.data = {};
        _this.data.composit = [];
        _this.comp = new COMP();
    };
    _this.comp = new COMP();
});


app.controller('FlowerPacketListCtrl', function ($scope, $mdDialog, htp) {
    var _this = $scope;
    _this.tbl = {};
    _this.showDialog = function (row, ev) {
        console.log(row);
        var dialog = $mdDialog.show({
            controller: function ($scope, $controller, dt, $mdDialog) {
                $scope.dt = dt;
                $scope.edit_mode = true;
                $scope.data = row;
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
            },
            templateUrl: home('console/flower_packet/data'),
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
});
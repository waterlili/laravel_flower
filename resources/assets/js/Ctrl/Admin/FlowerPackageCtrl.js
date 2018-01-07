app.controller('FlowerPackageAddCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/flower_package/add';
    _this.submiterName = 'گل';

    if (_this.edit_mode) {
        _this.data = _this.dt;
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
        this.flower = this.flowers  = this.count = undefined;
        htp(home('console/flower_package/flowers-list')).then(function (response) {
            _this.data.flowers = response;
            angular.forEach(response, function (value, key) {
                _this.flowers_arr[value.id] = value;
            });
        });
        this.add = function () {
            _this.data.composit.push({
                flower: this.flower,
                count: this.count
            });
            this.flower = this.count = undefined;
        };

        this.remove = function ($index) {
            _this.data.composit = _.without(_this.data.composit, _this.data.composit[$index]);
        };

        this.combine = function(){
            var flowers_variations = [];
            _this.data.composit.forEach(function (t) {
                var flower_v = [];
                _this.flowers_arr[t.flower].variations.forEach(function (s) {
                    flower_v.push(_this.flowers_arr[t.flower].name + ' ' + s.color);
                });
                if(flower_v.length > 0){
                    flowers_variations.push(flower_v);
                }
            });
            var result = [""];
            flowers_variations.forEach(function(arr){
                var tmp = [];
                arr.forEach(function(el){
                    result.forEach(function(curr){
                        tmp.push(curr + el + ' - ');
                    });
                });
                result = tmp;
            });
            _this.data.combine_arr = result;
        };
    };
    _this.afterSuccess = function () {
        _this.data = {};
        _this.data.composit = [];
        _this.comp = new COMP();
    };
    _this.comp = new COMP();
});


app.controller('FlowerPackageListCtrl', function ($scope, $mdDialog, htp) {
    var _this = $scope;
    _this.tbl = {};
    _this.showDialog = function (row, ev) {
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
            templateUrl: home('console/flower_package/data'),
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

app.controller('FlowerAddCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.data = {};
    _this.stepsModel = [];
    _this.data.new_case = [];
    _this.submiterUrl = 'console/flower/add';
    _this.submiterName = 'گل';

    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
    _this.init = function () {
        $('.ui.accordion').accordion();
    };

    angular.module('tabsDemoDynamicHeight', ['ngMaterial']);
    $('.ui.accordion').accordion();


    _this.imageUpload = function (item, event, files, errFiles) {


        var files = item.files; //FileList object
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = _this.imageIsLoaded;
            reader.readAsDataURL(file);
            data: {
                file: files[i]
            }
            ;

        }
        _this.afterSuccess = function () {
            Upload.upload({
                url: home('console/flower/add'),
                data: {file: files, dt: _this.data}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    _this.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        }


    }
    _this.imageIsLoaded = function (e) {

        _this.$apply(function () {
            _this.stepsModel.push(e.target.result);

        });
    };
    _this.addVariety = function () {
        _this.data.new_case.unshift({});


    };
    _this.removenewVariety = function (item) {
        _this.data.new_case = _.without(_this.data.new_case, item);
    };


});


app.controller('FlowerListCtrl', function ($scope, $mdDialog, htp) {
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
            templateUrl: home('console/flower/data'),
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
app.controller('FlowerEditCtrl', function ($scope, htp, $controller) {
    var _this = $scope;
    htp(home('console/flower/get-edit-flower-data'), {id: _this.dt.id}).then(function (resposnne) {
        _this.data = resposnne;

    });
});

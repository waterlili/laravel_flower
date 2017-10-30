app.controller('FlowerVaseAddCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/flower_vase/add';
    _this.submiterName = 'گل';

    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
    _this.data = {};
    _this.data.composit = [];
    var COMP = function () {
        this.disabled = false;
        this.flower = this.image = undefined;
        this.add = function () {
            _this.data.composit.push({
                flower: this.flower,
                image: this.image
            });
            this.flower = this.image = undefined;
            this.flowerOpt.searchText = undefined;
            this.flowerOpt.selectedItem = undefined;
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

    var Fls = function ($name) {
        this.errorUploading = undefined;
        this.file = undefined;
        this.success = undefined;
        this.readyUpload = undefined;
        this.progress = undefined;
        this.name = $name;
        this.has = undefined;
        this.finish = true;
        this.url = undefined;
        this.clear = function () {
            this.errorUploading = this.readyUpload = this.file = this.success = this.progress = undefined;
        };

        this.clearError = function () {
            this.errorUploading = undefined;
        };

        this.__submit = function () {
            _this._upload(this);
        };

        this.init = function () {
            this.has = true;
            this.finish = false;
        };
    };


    _this._upload = function (fls) {
        fls.clearError();
        fls.uploading = true;
        Upload.upload({
            url: home('console/flower/upload-flower-image'),
            data: {file: fls.file, type: fls.name}
        }).then(function (resp) {
            fls.uploading = false;
            fls.clear();
            fls.success = true;
            fls.finish = true;
            fls.url = resp.data.url;
            var d = new Date();
            _this.data.personal.url = resp.data.url + '?ver=' + d.getTime();
        }, function (resp) {
            fls.errorUploading = true;
            fls.file = undefined;
            fls.uploading = false;
            fls.progress = undefined;
        }, function (evt) {
            fls.progress = parseInt(100.0 * evt.loaded / evt.total);
        });
    };

    _this.data.flower_picture = new Fls('flower_picture');

});


app.controller('FlowerListCtrl', function ($scope, $mdDialog, htp) {
    var _this = $scope;
    _this.tbl = {};
    // _this.showDialog = function (row, ev) {
    //     console.log(row);
    //     var dialog = $mdDialog.show({
    //         controller: function ($scope, $controller, dt, $mdDialog) {
    //             $scope.dt = dt;
    //             $scope.edit_mode = true;
    //             $scope.data = row;
    //             $scope.hide = function () {
    //                 $mdDialog.hide();
    //             };
    //             $scope.cancel = function () {
    //                 $mdDialog.cancel();
    //             };
    //             $scope.tbl = {};
    //             $scope.tbl.postData = function () {
    //                 return {
    //                     uid: dt.id
    //                 }
    //             };
    //         },
    //         templateUrl: home('console/flower/data'),
    //         parent: angular.element(document.body),
    //         targetEvent: ev,
    //         clickOutsideToClose: true,
    //         locals: {
    //             dt: row
    //         },
    //         fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    //     })
    //         .then(function (answer) {
    //
    //         });
    // };
});
app.controller('FlowerEditCtrl', function ($scope, htp, $controller) {
    var _this = $scope;
    htp(home('console/flower/get-edit-flower-data'), {id: _this.dt.id}).then(function (resposnne) {
        _this.data = resposnne;

    });
});
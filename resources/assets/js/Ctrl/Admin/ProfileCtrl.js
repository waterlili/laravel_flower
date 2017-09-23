app.controller('ProfileCtrl', function ($scope, Upload, htp) {
    var _this = $scope;
    _this.data = {};
    _this.pass = {};
    _this.errorItem = {};


    _this.$watch('pass.new', function (n) {
        if (_this.PassForm)
            _this.PassForm.$setValidity('confirm.confirm', isConfirm());
    });

    _this.$watch('pass.confirm', function (n) {
        if (_this.PassForm)
            _this.PassForm.$setValidity('confirm.confirm', isConfirm());
    });

    var isConfirm = function () {
        return _this.pass.new == _this.pass.confirm;
    };


    htp(home('console/profile/get-user-data')).then(function (response) {
        _this.data = response;
        _this.data.personal = new Fls('personal');
        _this.data.personal.url = '';
        _this.data.personal.url = home(_this.data.personal_picture);
    });


    _this.edit = function () {
        htp(home('console/profile/edit'), _this.data).saveSend('Profile');
    };


    _this.password = function () {
        htp(home('console/profile/change-password'), _this.pass).saveSend('Password').errorNotice(function (response) {
            _this.errorItem = response;
        });
    };

    _this.$watch('errorItem', function (n) {
        console.log('n', n);
    });

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
            url: home('console/profile/upload-profile-image'),
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

});
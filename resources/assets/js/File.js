app.directive('useFileUpload', function (htp, Upload) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }
        s.n = new Fls('file', attrs['fileUploadLink']);
    }

    var Fls = function ($name, $url) {
        this.errorUploading = undefined;
        this.file = undefined;
        this.success = undefined;
        this.readyUpload = undefined;
        this.progress = undefined;
        this.name = $name;
        this.has = undefined;
        this.finish = true;
        this.url = undefined;
        this.send_url = $url;

        this.clear = function () {
            this.errorUploading = this.readyUpload = this.file = this.success = this.progress = undefined;
        };

        this.clearError = function () {
            this.errorUploading = undefined;
        };

        this.__submit = function () {
            _Upload(this);
        };

        this.init = function () {
            this.has = true;
            this.finish = false;
        };
    };


    var _Upload = function (fls) {
        fls.clearError();
        fls.uploading = true;
        Upload.upload({
            url: home(fls.send_url),
            data: {file: fls.file, type: fls.name}
        }).then(function (resp) {
            fls.uploading = false;
            fls.clear();
            fls.success = true;
            fls.finish = true;
            console.log('resp' , resp);
            fls.url = resp.data.url;
        }, function (resp) {
            fls.errorUploading = true;
            fls.file = undefined;
            fls.uploading = false;
            fls.progress = undefined;
        }, function (evt) {
            fls.progress = parseInt(100.0 * evt.loaded / evt.total);
        });
    };
    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngModel'
        }
    }
});



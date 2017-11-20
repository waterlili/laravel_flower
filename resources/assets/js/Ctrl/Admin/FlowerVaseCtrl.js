app.controller('FlowerVaseAddCtrl', function ($scope, htp, $http, Upload, $controller, notify) {
    // $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.files = [];
    _this.data = {};
    _this.stepsModel = [];
    _this.submiterUrl = 'console/flower_vase/add';
    _this.submiterName = 'گل';
    _this.init = function () {
        $('.ui.accordion').accordion();
    };
    _this.submit = function () {

        $http.post(home(_this.submiterUrl), _this.export())
            .success(function (response) {

                notify('info', trans('message.set_record', {attr: _this.submiterName}));
                if (_this.afterSuccess) {
                    _this.afterSuccess.call(this, response);
                }
            })
            .error(function (response, sts) {

                notify('error', trans('message.unset_record', {attr: _this.submiterName}));
                if (sts == 422) {
                    _this.errorItem = response;
                }
            });
    };
    _this.export = function () {
        return _this.data;
    }
    _this.imageUpload = function (event, files, errFiles) {
        console.log("tea");
        var files = event.target.files; //FileList object
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
                url: home('console/flower_vase/add'),
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

        _this.removeElement = function (event, index) {

            var target = angular.element(event.target.parentNode.id);
            var thenum = target['selector'].replace(/^\D+/g, '');
            var elmn = angular.element(document.querySelector("#" + target['selector'] + ""));

            // angular.element("input[type='file']").val(null);
            elmn.remove();

        };
    }
    _this.imageIsLoaded = function (e) {
        _this.$apply(function () {
            _this.stepsModel.push(e.target.result);

        });
    };


});
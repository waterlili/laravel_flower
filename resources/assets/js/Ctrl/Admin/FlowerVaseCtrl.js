app.directive('uploadFiles', function () {
    return {
        scope: true,
        link: function (scope, element, attrs) {
            element.bind('change', function (event) {
                var files = event.target.files;
                for (var i = 0; i < files.length; i++) {
                    scope.$emit("seletedFile", {file: files[i]});
                }
            });
        }
    };
});
app.controller('FlowerVaseAddCtrl', function ($scope, htp, $http, Upload, $controller) {

    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.files = [];
    _this.submiterUrl = 'console/flower_vase/add';
    _this.submiterName = 'گل';


    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
    _this.data = {};
    _this.stepsModel = [];
    _this.files = [];


    _this.imageUpload = function (event) {
        var files = event.target.files; //FileList object
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = _this.imageIsLoaded;
            reader.readAsDataURL(file);


        }


    };
    _this.imageIsLoaded = function (e) {
        _this.$apply(function () {
            _this.stepsModel.push(e.target.result);

        });
    };
    _this.$on("seletedFile", function (event, args) {

        console.log("event is ", event);
        console.log("args is ", args);

        _this.$apply(function () {
            _this.files.push(args.file);
        });
        var files = _this.files;
    });
    _this.afterSuccess = function () {
        var formData = new FormData();
        formData.append('file', _this.name);
        formData.append('file', _this.type);

        // add files to form data.
        for (var i = 0; i < _this.files.length; i++) {
            formData.append('file' + i, _this.files[i]);
        }
        // Don't forget the config object below
        htp(home('console/flower_vase/add'), formData, {
            transformRequest: angular.identity,
            headers: {'Content-Type': false},
            data: {request: _this.request, files: _this.files}
        }).then(function () {

        });

    };
    _this.removeElement = function (event) {
        var target = angular.element(event.target.parentNode.id);
        var elmn = angular.element(document.querySelector("#" + target['selector'] + ""));
        // angular.element("input[type='file']").val(null);
        elmn.remove();
    };
});





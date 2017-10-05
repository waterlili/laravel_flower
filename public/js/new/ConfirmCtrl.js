app.controller('ConfirmCtrl' , function ($scope, $mdDialog , notify , htp) {
    var _this = $scope;
    _this.destroy = function (ngTable) {
        if (ngTable && ngTable != 'null') {
            _this.$parent[ngTable].tableParams.reload();
        }
    };


    _this.before = function (id, cb) {
        _this.beforePreloader = true;
        htp(home(_this.getter), {id: id}).then(function (res) {
            cb(res);
        }).error(function () {
            notify('error','خطا در اجرا');
        }).after(function () {
            _this.beforePreloader = false;
        });
    };


    _this.showConfirm = function (ev, id, link, ctrl, ngTable) {
        if (_this.getter) {
            _this.before(id, function (res) {
                $mdDialog.show({
                    controller: ctrl || 'AdminCtrl',
                    templateUrl: home(link),
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    hasBackdrop:false,
                    locals: {data: res},
                    clickOutsideToClose: true,
                    onComplete:function () {
                        // $mdDialog.hide();
                    },
                    fullscreen: true // Only for -xs, -sm breakpoints.
                }).then(function (answer) {
                    // _this.destroy(id, where, ngTable);
                    _this.destroy(ngTable);
                }, function () {

                });
            });

        } else {
            $mdDialog.show({
                controller: ctrl || 'AdminCtrl',
                templateUrl: home(link),
                parent: angular.element(document.body),
                targetEvent: ev,
                hasBackdrop:false,
                onComplete:function () {
                    // $mdDialog.hide();
                },
                clickOutsideToClose: true,
                fullscreen: true // Only for -xs, -sm breakpoints.
            }).then(function (answer) {
                _this.destroy(id,  ngTable);
            }, function () {

            });
        }
    };
})

app.controller('EditorCtrl', function ($scope, htp, $mdDialog, notify, $rootScope) {
    var _this = $scope;
    _this.destroy = function (ngTable) {
        if (ngTable && ngTable != 'null') {
            _this.$parent[ngTable].tableParams.reload();
        }
    };

    if (!_this.editor) {
        _this.editor = {}
    }

    $rootScope.$on('modal:init', function (data, elm) {
        _this.editor.modal = elm;
        _this.editor.modal.modal({
            onHide: function (res) {
                $mdDialog.hide();
            }
        });
    });

    _this.editor.submit = function () {
        _this.editor.loading = true;
        _this.errorItems = undefined;
        _this.Form.$setValidity('loading', false);
        htp(home(_this.editor.url), (_this.editor.send) ? _this.editor.send.call(this) : _this.data, _this.editor.method || 'put').then(function (res) {
            if (_this.editor.modal) {
                _this.editor.modal.modal('hide');
            }
        }).after(function () {
            _this.editor.loading = false;
            _this.Form.$setValidity('loading', true);
        }).error(function (res, sts) {
            if (sts == 422) {
                _this.errorItems = res;
            }
        })
    };

    _this.before = function (id, cb) {
        _this.beforePreloader = true;
        htp(home(_this.getter), {id: id}).then(function (res) {
            cb(res);
        }).error(function () {
            notify.error('خطا در اجرای ویرایش');
        }).after(function () {
            _this.beforePreloader = false;
        });
    };
    _this.showConfirm = function (ev, id, link, ctrl, ngTable) {
        if (_this.getter) {
            _this.before(id._id, function (res) {
                $mdDialog.show({
                    controller: ctrl || 'AdminCtrl',
                    templateUrl: home(link),
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    hasBackdrop: false,
                    locals: {data: res},
                    clickOutsideToClose: true,
                    onComplete: function () {
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
                hasBackdrop: false,
                onComplete: function () {
                    $mdDialog.hide();
                },
                clickOutsideToClose: true,
                fullscreen: true // Only for -xs, -sm breakpoints.
            }).then(function (answer) {
                _this.destroy(id, where, ngTable);
            }, function () {

            });
        }
    };
});

app.controller('OrderListCtrl', function ($scope, htp, $mdDialog, NgTableParams, $rootScope) {
    var _this = $scope;
    _this.data = {};
    _this.data.orders = [];
    _this.init = function () {
        $('.ui.accordion').accordion();
    };
    $scope.items = [];
    for (var i = 0; i < 100; i++) $scope.items.push(i);

    angular.module('tabsDemoDynamicHeight', ['ngMaterial']);

    $('.ui.accordion').accordion();

    $scope.$watch('customer', function (n, o) {
        if (n) {
            _this.data.customer = n;
            _this.cache = false;
            htp(home('console/order/get-prc'), {cid: _this.data.customer.id}).then(function (res) {
                _this.data.orders = res;
                _this.flag = res.flag;
                _this.showAlert(_this.data.customer);
            });
        }
    });
    angular.module('dialogDemo1', ['ngMaterial']);

    _this.status = '  ';
    _this.customFullscreen = false;

    _this.showAlert = function (ev) {
        // Appending dialog to document.body to cover sidenav in docs app
        // Modal dialogs should fully cover application
        // to prevent interaction outside of dialog

        $mdDialog.show(
            $mdDialog.alert()
                .parent(angular.element(document.querySelector('#popupContainer')))
                .clickOutsideToClose(true)
                .htmlContent('<h4><i class="material-icons">local_florist</i>لیست سفارشات مربوط به</h4>' + '</br>' +
                    ' <span class="tpc">نام مشتری</span>' + ' ' + ev.title + '</br>' +
                    '<span class="tpc">شماره موبایل</span>' + ' ' + ev.mobile + '</br>' +
                    '<span class="tpc">آدرس ایمیل</span>' + ' ' + ev.email)
                .ariaLabel('Alert Dialog Demo')
                .ok('درسته')
                .targetEvent(ev)
        );
    };
});

app.controller('OrderProductTable', function ($scope, htp, NgTableParams) {
    var _this = $scope;
    if (!_this.data) {
        _this.data = {};
        _this.data.order_item = [];
    }
    _this.tableParams = new NgTableParams({}, {
        dataset: _this.data.order_item,
        counts: [] // hides page sizes
    });
    _this.prc = {};
    _this.prc.remove = function ($index) {
        _this.data.order_item = _.without(_this.data.order_item, _this.data.order_item[$index]);
        _this.tableParams = new NgTableParams({}, {
            dataset: _this.data.order_item,
            counts: [] // hides page sizes
        });
    };
    _this.tableParams.show_filter = false;
    _this.addProduct = function (item) {
        if (!item.total) {
            item.total = 1;
        }
        _this.data.order_item.push(item);
        _this.tableParams.reload();
        _this.prc.itemOpt = {};
        _this.prc.item = {};
    };
    _this.$watch('prc.item.id', function (n) {
        if (n) {
            _this.addProduct(_this.prc.item);
        }
    });

    _this.$watch('data.order_item', function (n) {
        if (n) {
            _this.data.total = 0;
            for (var i in n) {
                _this.data.total += parseInt(n[i].price) * parseInt(n[i].total);
            }
        }
    }, true);
});

app.controller('OrderAddCtrl', function ($scope, htp, $controller, NgTableParams) {
    $controller('OrderProductTable', {$scope: $scope});
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/order/add';
    _this.submiterName = 'فاکتور';

    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
    if (!_this.data) {
        _this.data = {};
    }
    _this.data.when = 1;
    _this.data.total = 0;
    _this.afterSuccess = function () {
        // window.location.reload();
    };
    _this.data.sts = -1;
});

app.controller('OrderEditCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.data = _this.dt;
    _this.customer = {};
    _this.visitor = {};
    _this.sender = {};
    _this.customer.itemOpt = {};
    _this.visitor.itemOpt = {};
    _this.sender.itemOpt = {};
    htp(home('console/order/get-edit-data'), {id: _this.dt.id})
        .then(function (response) {
            _this.data = response;

            if (_this.data.customer) {
                _this.customer.itemOpt.searchText = _this.data.customer.value;
            }

            if (_this.data.visitor) {
                _this.visitor.itemOpt.searchText = _this.data.visitor.value;
            }

            if (_this.data.sender) {
                _this.sender.itemOpt.searchText = _this.data.sender.value;
            }
        })
        .error(function (response, sts) {
            if (sts == 422) {
                _this.errorItem = response;
            }
        })
        .after(function () {

        });
});
app.controller('DailyGenCtrl', function ($scope, $mdDialog, htp) {
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
            templateUrl: home('console/daily-generation/data'),
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

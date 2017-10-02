app.controller('OrderListCtrl', function ($scope, htp, $mdDialog, NgTableParams) {
    var _this = $scope;
    _this.tbl = {};


    _this.setVisitor = function (row) {
        row.visitor_loading = true;
        htp(home('console/order/set-visitor'), {id: row.id}).then(function (response) {
            _this.tbl.reload();
        }).after(function () {
            row.visitor_loading = false;
        });
    };

    _this.setSender = function (row) {
        row.sender_loading = true;
        htp(home('console/order/set-sender'), {id: row.id}).then(function (response) {
            _this.tbl.reload();
        }).after(function () {
            row.sender_loading = false;
        });
    };

    _this.setSts = function (row) {
        row.sts_loading = true;
        htp(home('console/order/set-sts'), {id: row.id, sts: row.sts}).then(function (response) {
            _this.tbl.reload();
        }).after(function () {
            row.sts_loading = false;
        });
    };

    _this.init = function (row) {
        row.extra_loading = true;
        row.order_items = undefined;
        htp(home('console/order/get-order-items'), {id: row.id}).then(function (response) {
            row.order_items = response;
        }).after(function () {
            row.extra_loading = false;
        });
    };
    _this.editProductListDialog = function (ev, row) {
        var dialog = $mdDialog.show({
                controller: function ($scope, $controller, row, id) {
                    $scope.data = row;
                    $scope.edit_mode = true;
                    $scope.hide = function () {
                        $mdDialog.hide();
                    };
                    $scope.cancel = function () {
                        $mdDialog.cancel();
                    };
                    $scope.editBtnDialog = function () {
                        $scope.preloader = true;
                        htp(home('console/order/edit-product-list'), {
                            id: id,
                            data: $scope.data
                        }).then(function (response) {
                            $scope.preloader = false;
                            $mdDialog.hide();
                            _this.init(row);
                            _this.tbl.reload();
                        });
                    };
                    var __this = $scope;
                    __this.data.order_item = [];
                    _.each(__this.data.order_items, function (item) {
                        __this.data.order_item.push(angular.extend(item, {value: item.product_name.title}));
                    });
                    $controller('OrderProductTable', {$scope: $scope});
                    __this.$watch('data.order_item', function (n) {
                        console.log('n', n);
                    }, true);

                },
                templateUrl: home('console/order/product-list-edit'),
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    row: row,
                    id: row.id
                },
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
            .then(function (answer) {

            });
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
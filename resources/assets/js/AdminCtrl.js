app.run(function ($window, $rootScope, htp) {
    $rootScope.online = navigator.onLine;
    $window.addEventListener("offline", function () {
        $rootScope.$apply(function () {
            $rootScope.online = false;
        });
    }, false);

    $window.addEventListener("online", function () {
        $rootScope.$apply(function () {
            $rootScope.online = true;
        });
    }, false);
});

app.controller('AdminCtrl', function ($scope, $window, htp, $interval, $rootScope, $timeout, $mdSidenav, $mdUtil, $log, NgTableParams, $resource, $http, $state, $stateParams, notify) {
    $scope.w_h = $window.innerHeight;
    var _this = $scope;
    $scope.show_leftbar = false;
    $scope.home = home;
    if ($scope.$parent.$id == 1) {

        $interval(function () {
            htp(home('check-auth')).then(function (response) {
                if (response != true) {
                    $window.location.reload();
                }
            });
        }, 10000);

        $rootScope.$on("$stateChangeStart", function (event, next, current) {
            $scope.preloder_page = true;
            $mdSidenav('menu').close();
        });
        $rootScope.$on('$stateChangeSuccess',
            function (event, toState, toParams, fromState, fromParams) {
                $scope.preloder_page = false;
                $scope.toolbarTitlePage = [];
                $scope.toolbarTitlePage.push(trans('page_title.' + toState.state.split('.').join('')));
                if (!_this.float_tab_active) {
                    _this.admin_tab = [];
                } else {
                    _this.float_tab_active = false;
                }
            });

        $rootScope.$on('$stateChangeError', function (event, toState, toParams, fromState, fromParams, error) {
            $scope.preloder_page = false;
            switch (error.status) {
                case 404:
                    notify('red', trans('message.not_found_state'));
                    break;
                case 500:
                    notify('red', trans('message.error_state'));
                    break;
                default:
                    notify('red', trans('message.error_public_state'));
                    break;
            }
        });

        $rootScope.$watch('online', function (n) {
            if (n == false) {
                notify('error', 'اینترنت شما متاسفانه قطع شده است. در صورت قطع اینترنت سامانه کارایی نخواهد داشت.');
            }
        });
    }


    $scope.toggleLeft = buildDelayedToggler('left');
    $scope.toggleRight = buildToggler('right');
    $scope.isOpenRight = function () {
        return $mdSidenav('right').isOpen();
    };
    function buildDelayedToggler(navID) {
        return debounce(function () {
            $mdSidenav(navID)
                .toggle()
                .then(function () {
                    $log.debug("toggle " + navID + " is done");
                });
        }, 200);
    }

    function buildToggler(navID) {
        return function () {
            $mdSidenav(navID)
                .toggle()
                .then(function () {
                    $log.debug("toggle " + navID + " is done");
                });
        }
    }

    function debounce(func, wait, context) {
        var timer;
        return function debounced() {
            var context = $scope,
                args = Array.prototype.slice.call(arguments);
            $timeout.cancel(timer);
            timer = $timeout(function () {
                timer = undefined;
                func.apply(context, args);
            }, wait || 10);
        };
    }

    $scope.demo = {};
    $scope.toggleMenu = function () {
        $mdSidenav('menu').open()
            .then(function () {
            });
    };


    _this.chartModel = new LineChart();
    _this.circleChart = new CircleChart();
    _this.compChart = new LineChart();
    _this.compChart.labels = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنج شنبه', 'جمعه'];
    _this.compChart.data = [
        [65, -59, 80, 81, -56, 55, -40],
        [28, 48, -40, 19, 86, 27, 90]
    ];
    _this.compChart.defaultOption();
    _this.compChart.datasetOverride = [
        {

            label: "Bar",
            borderWidth: 1,
            type: 'line'
        },
        {
            label: "Line chart",
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            type: 'bar'
        }
    ];
    _this.tblRegister = {};

    _this.notify_info = function () {
        notify('info', 'یک پیغام آزمایشی');
    };
    _this.notify_error = function () {
        notify('error', 'یک پیغام آزمایشی');
    };
});


app.controller('MenuCtrl', function ($scope, $timeout, $mdSidenav, $log) {

    $scope.last_menu = undefined;
    $scope.show_menu = true;

    $scope.toggle = function ($item) {
        $scope[$item] = !$scope[$item];
    };

    $scope.deactive_menu = function ($item) {
        //$scope.active_menu = false;
    };
    $scope.set_active_menu = function ($item, $event) {
        var elm = $($event.currentTarget).siblings('.menu-item-wrapper-inner');
        if ($scope.last_menu) {
            $scope.last_menu.height(0);
        }
        if ($scope.active_menu == $item) {
            $scope.active_menu = false;
            return;
        }
        $scope.last_menu = elm;
        var _h = elm.children().map(function (i) {
            return $(this).height();
        });
        var __h = 0;
        _h.each(function (i) {
            __h += _h[i];
        });
        elm.height(__h);

        $scope.active_menu = $item;
    };
});

app.controller('RightCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
        $mdSidenav('right').close()
            .then(function () {
                $log.debug("close RIGHT is done");
            });
    };

    var _this = $scope;
    _this.clickList = function () {

    };
});

app.controller('SubmitController', function ($scope, $http, notify) {
    var _this = $scope;
    _this.loading = function (sts) {
        _this._loading = sts;
        _this.Form.$setValidity('loading', (sts == false));
    };
    _this.clear = function () {
        _this.data = {};
        _this.Form.$setPristine();
    };
    _this.clearError = function () {
        _this.errorItem = {};
    };
    _this.submit = function () {
        _this.loading(true);
        _this.clearError();
        $http.post(home(_this.submiterUrl), _this.export())
            .success(function (response) {
                _this.clearError();
                _this.loading(false);
                _this.clear();
                notify('info', trans('message.set_record', {attr: _this.submiterName}));
                if (_this.afterSuccess) {
                    _this.afterSuccess.call(this, response);
                }
            })
            .error(function (response, sts) {
                _this.loading(false);
                notify('error', trans('message.unset_record', {attr: _this.submiterName}));
                if (sts == 422) {
                    _this.errorItem = response;
                }
            });
    };

    _this.export = function () {
        return _this.data;
    }
});


app.controller('PageListCtrl', function ($scope) {
    var _this = $scope;
    _this.tbl = {};
});

app.controller('MenusCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.$watch('menu', function (n) {
        _this.serv();
    });

    _this.data = {};
    _this.list = [];
    _this.serv = function () {
        _this.list = [];
        if (_this.menu) {
            htp(home('console/node/get-menu-item'), {id: _this.menu}).then(function (response) {
                _.each(response, function (item) {
                    item['items'] = [];
                    if (item['parent']) {
                        _.findWhere(_this.list, {id: item['parent']})['items'].push(item);
                    } else {
                        _this.list.push(item);
                    }
                });
            });
        }
    };

    _this.submit = function () {
        htp(home('console/node/save-menu'), {id: _this.menu, items: _this.list}).saveSend(trans('subject.menu'));
    };


    _this.addMenu = function () {
        _this.list.push({
            title: _this.data.title,
            url: _this.data.url,
            items: []
        });
        _this.data = {};
        // _this.add.$setPristine();
    };

    _this.remove = function (scope) {
        scope.remove();
    };
    _this.toggle = function (scope) {
        scope.toggle();

    };
});

app.controller('AddPageCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/node/add-page';
    _this.submiterName = trans('subject.page');


    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
});


app.controller('FeeCtrl', function ($scope, htp, $controller, notify) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/fee/set-fee';
    _this.submiterName = trans('subject.page');
    _this.data = {};
    htp(home('console/fee/get-date')).then(function (response) {
        _this.data.at = response;
    });

    htp(home('get-currency')).then(function (response) {
        _this.currency = response;
    });


    _this.$watch('data.currency', function (n) {
        if (n != undefined) {
            _this.illegal_change();
        }
    });


    _this.$watch('data.to', function (n) {
        if (n != undefined) {
            _this.illegal_change();
        }
    });

    _this.illegal_change = function () {
        _this.Form.$setValidity('illegal', !(_this.data.currency == _this.data.to));
        if (_this.data.currency == _this.data.to) {
            notify('error', trans('message.illegal_change'));
        }
    };

    _this.tbl = {};
});

app.controller('FeeListCtrl', function ($scope, htp, notify) {
    var _this = $scope;
    _this.tbl = {};
    _this.saveRow = function (row) {
        htp(home('console/fee/save-row'), row).then(function (n) {
            notify('info', trans('message.set_record'));
            row.extraRow = false;
        });
    }
});

app.controller('AddOrderCtrl', function ($scope, htp, $controller, Upload) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/order/set-order';
    _this.submiterName = trans('subject.order');

    _this.data = {};
    _this.mdAcTo = {};
    _this.mdAcIban = {};
    _this.mdAcCid = {};
    htp(home('get-currency')).then(function (respoonse) {
        _this.items = respoonse;
    });


    _this.$watch('data.iban_type', function (n) {
        _this.ibanCidInfo = undefined;
        if (n == 'cid') {
            _this.data.iban = undefined;
            _this.mdAcIban.searchText = _this.mdAcIban.selectedItem = undefined;
        } else if (n == 'iban') {
            _this.data.cid = undefined;
            _this.mdAcCid.searchText = _this.mdAcCid.selectedItem = undefined;
        }
    });


    _this.$watch('data.cid', function (n) {
        if (n && n.id) {
            _this.hasIban = true;
            htp(home('console/order/get-iban-from-cid'), {cid: n.id}).then(function (response) {
                _this.ibanCidInfo = response;
                console.log('ibanCidInfo', _this.ibanCidInfo);
            });
        } else {
            _this.hasIban = undefined;
        }
    });

    _this.$watch('data.iban', function (n) {
        if (n && n.id) {
            _this.hasIban = true;

        } else {
            _this.hasIban = undefined;
        }
    });

    _this.mdAcTo.getData = function () {
        return {from: _this.data.from.id};
    };

    _this.$watch('data.from', function (n) {
        if (n && n.id) {
            _this.data.to = {};
            _this.mdAcTo.searchText = undefined;
            _this.change();
        }
    });
    _this.$watch('data.to', function (n) {
        if (n && n.id) {
            _this.change();
        }
    });

    _this.change = function () {
        if (_this.data && _this.data.from && _this.data.to && _this.data.from.id && _this.data.to.id) {
            htp(home('console/order/get-fee'), {
                from: _this.data.from.id,
                to: _this.data.to.id
            }).then(function (response) {
                if (response) {
                    _this.dt = response;
                }
            });
        }
    };

    _this.$watch('dt', function (n) {
        if (n) {
            _this.calc();
        }
    });

    _this.$watch('data.from_value', function (n) {
        if (n) {
            _this.calc();
        }
    });

    _this.data.fls = {};
    _this.uploadFiles = function () {
        htp(home('console/order/upload-file'), _this.data.files).then(function (response) {
            console.log('response', response);
        });
        var fls = {};
        _this.data.fls = fls;
        fls.uploading = true;
        Upload.upload({
            url: home('console/order/upload-file'),
            data: {files: _this.data.files}
        }).then(function (resp) {
            fls.uploading = false;
            // fls.clear();
            fls.success = true;
            fls.finish = true;
            fls.url = resp.data.result;
            fls.progress = undefined;
        }, function (resp) {
            fls.errorUploading = true;
            fls.file = undefined;
            fls.uploading = false;
            fls.progress = undefined;
        }, function (evt) {
            fls.progress = parseInt(100.0 * evt.loaded / evt.total);
        });
        console.log('_this.data.files', _this.data.files);
    };

    _this.calc = function () {
        if (_this.data && _this.data.from_value && _this.dt && _this.dt.percent) {
            _this.exchange = _this.dt.percent * _this.data.from_value;
        } else {
            _this.exchange = undefined;
        }
        return _this.exchange;
    };
    _this.export = function () {
        return _.extend(_this.data, _this.dt);
    };
});


app.controller('OrderListCtrl', function ($scope, htp) {
    var _this = $scope;
    console.log('_this', _this);
    _this.tbl = {};
    _this.proceed = function (row) {
        row.preloader = true;
        htp(home('console/order/proceed-order'), row).then(function (response) {
            row.preloader = false;
            row.extraRow = false;
        });
    };
});


app.controller('UserCtrl', function ($scope, htp, $controller, Upload) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/manage/user-add';
    _this.submiterName = trans('subject.user_add');
    _this.tbl = {};


    _this.change = function (row) {
        htp(home('console/manage/active-user'), {id: row.id, active: row.active});
    };

    if (!_this.data) {
        _this.data = {};
    } else {
        console.log('_this.data', _this.data);
    }

    if (_this.edit_mode) {
        _this.data = _.extend(_this.data, _this.dt);
    }
    _this.confirm_pass = function () {
        if (_this.Form) {
            _this.Form.confirm.$setValidity('confirm', _this.data.password == _this.data.confirm);
        }
    };

    _this.$watch('data.password', function (n) {
        _this.confirm_pass();
    });

    _this.$watch('data.confirm', function (n) {
        _this.confirm_pass();
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
    htp(home('console/profile/get-user-data')).then(function (response) {
        // _this.data = response;
        _this.data.personal = new Fls('personal');
        _this.data.personal.url = '';
        _this.data.personal.url = home(_this.data.personal_picture);
    });


    _this._upload = function (fls) {
        fls.clearError();
        fls.uploading = true;
        Upload.upload({
            url: home('console/profile/upload-profile-image'),
            data: {file: fls.file, type: fls.name, uid: _this.data.id}
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


app.controller('DeleteCtrl', function ($scope, htp, $mdDialog, notify) {
    var _this = $scope;
    _this.destroy = function (id, where, ngTable) {
        htp(home('console/destroy'), {id: id, where: where})
            .then(function (response) {
                notify('warning', 'رکورد مورد نظر با موفقیت حذف شد');
                if (ngTable && ngTable != 'null') {
                    _this.$parent[ngTable].tableParams.reload();
                }

            });
    };

    _this.showConfirm = function (ev, id, where, title, ngTable) {
        var desc = trans('message.desc_delete');
        if (title) {
            desc = trans('message.content_delete', {title: title});
        }
        var confirm = $mdDialog.confirm()
            .title(trans('message.title_delete'))
            .textContent(desc)
            .ariaLabel('حدف رکورد')
            .targetEvent(ev)
            .ok('بلی')
            .cancel('خیر');
        $mdDialog.show(confirm).then(function () {
            _this.destroy(id, where, ngTable);
        }, function () {

        });
    };
});
app.controller('DeleteItemCtrl', function ($scope, htp, $mdDialog, notify) {
    var _this = $scope;
    _this.destroy = function (id, where) {
        htp(home('console/destroy'), {id: id, where: where})
            .then(function (response) {
                notify('warning', 'آیتم مورد نظر با موفقیت حذف شد');

            });
    };

    _this.showConfirm = function (ev, id, where, title, $index) {
        var desc = trans('message.desc_delete');
        if (title) {
            desc = trans('message.content_delete', {title: title});
        }
        var confirm = $mdDialog.confirm()
            .title(trans('message.title_delete'))
            .textContent(desc)
            .ariaLabel('حذف مورد')
            .targetEvent(ev)
            .ok('بلی')
            .cancel('خیر');
        $mdDialog.show(confirm).then(function () {
            _this.destroy(id, where);
            console.log($index);
            var index = _this.packet_type.items.indexOf($index);
            _this.packet_type.items.splice(index, 1);
        }, function () {

        });
    };
});
app.controller('EditCtrl', function ($scope, htp, $mdDialog, notify, $mdMedia) {
    var _this = $scope;
    _this.showEditDialog = function (ev, template_url, row, ctrl, where, id, ngTable) {
        var dialog = $mdDialog.show({
                controller: function ($scope, $controller, dt, $mdDialog, where, id, table) {
                    $scope.dt = dt;
                    $scope.edit_mode = true;
                    $scope.hide = function () {
                        $mdDialog.hide();
                    };
                    $scope.cancel = function () {
                        $mdDialog.cancel();
                    };
                    $scope.editBtnDialog = function () {
                        $scope.preloader = true;
                        htp(home('console/edit-dialog'), {
                            where: where,
                            id: id,
                            data: $scope.data
                        }).then(function (response) {
                            $scope.preloader = false;
                            $mdDialog.hide();
                            if (table && table != 'null') {
                                _this.$parent[table].reload();
                            }
                        });
                    };
                    $controller(ctrl, {$scope: $scope});
                },
                templateUrl: home(template_url),
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    dt: row,
                    where: where,
                    table: ngTable,
                    id: id
                },
                fullscreen: true // Only for -xs, -sm breakpoints.
            })
            .then(function (answer) {

            });
    };
});


app.directive('uiSelectAsyncUrl', function ($http) {
    return {
        restrict: 'A',
        link: function (scope, elm, attr) {
            scope.uiSelectSyncMethod = function (search) {
                var dt = {text: search};
                if (attr.uiSelectExtraData) {
                    dt.extra = scope[attr.uiSelectExtraData].call(this);
                }
                return $http.post(home(attr.uiSelectAsyncUrl), dt).then(function (response) {
                    scope[attr.uiSelectAsyncItems] = response.data;
                });
            };
        }
    }
});

app.filter('iif', function () {
    return function(input, trueValue, falseValue) {
        return input ? trueValue : falseValue;
    };
});
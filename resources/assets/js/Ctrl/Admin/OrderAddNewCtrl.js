app.controller('OrderPageCtrl', function ($scope, htp, $rootScope) {
    var _this = $scope;
    // _this.elm = $('#acrd');
    // _this.elm.فشذ();
    $('.menu .item').tab();
    _this._active = 1;
    _this.can = {};
    _this.active = function ($index) {
        _this._active = $index;
        var _c = {
            0: 'customer-tab',
            1: 'order-tab',
            2: 'pay-tab'
        };
        $('#' + _c[$index]).trigger('click');
        // _this.elm.accordion('open', $index);
    };

    $rootScope.$on('order:customer', function (data, dt) {
        _this.can.customer = dt;
    });

    $rootScope.$on('order:order', function (data, dt) {
        _this.can.order = dt;
    });

    $rootScope.$on('order:pay', function (data, dt) {
        _this.can.pay = dt;
    });

});


app.controller('OrderAddNewCtrl', function ($scope, htp, $rootScope, notify) {
    var _this = $scope;
    _this.data = {};
    _this.prc = {};
    _this.pay = {};
    _this.data.new_orders = [];
    _this.data.orders = [];
    _this.init = function () {
        $('.ui.accordion').accordion();
    };

    _this.type = function (item, $index) {
        item.type = $index;

    };

    angular.module('tabsDemoDynamicHeight', ['ngMaterial']);
    $('.ui.accordion').accordion();
    $rootScope.$on('order:customer', function (data, dt) {
        _this.data.customer = dt;
        htp(home('console/order/get-prc'), {cid: _this.data.customer.id}).then(function (res) {
            _this.data.orders = res;
            _this.flag = res.flag;


        });
    });

    _this.payType = function (item, $index) {
        item.pay_type = $index;
        // _this.loading = true;
        // htp(home('console/order/send-email'), _this.data).then(function (res) {
        //     notify('success', 'اطلاعات با موفقیت ثبت گردید')
        // }).error(function (res, sts) {
        //     if (sts == 422) {
        //         _this.errorItems = res;
        //     }
        // }).after(function (res) {
        //     _this.loading = false;
        // });
    };
    _this.addOrder = function () {
        _this.data.new_orders.push({type: 1, week: 1, time: 1, w: 1, total: 1});
        $('.ui.accordion').accordion();
    };

    _this.removenewOrder = function (item) {
        _this.data.new_orders = _.without(_this.data.new_orders, item);
    };


    // _this.$watch('pay.type',function (n) {
    //    if(n){
    //        $rootScope.$emit('order:pay' , n);
    //    } else{
    //        $rootScope.$emit('order:pay:not' , n);
    //    }
    // });


    _this.weekChange = function (item, index) {
        item.week = index;
    };

    _this.change_w = function (item) {
        item.w = '';
    };
    _this.wChange = function (item, index) {
        item.w = index;
    };
    _this.timeChange = function (item, index) {
        item.time = index;

    };
    // _this.v.Dt = Date.parse(item.order_packets[0]['send_at']);
    // _this.changeCheck =function (item) {
    //     console.log("s");
    // };

    _this.calcPrice = function (item) {
        var flag = _this.flag;
        var price = '';

        if (item.pck_type) {
            prc_part = item.pck_type.split("|");
            if (item.type == 1) {
                var count = item.week * 4;
                if (flag == 1 && item.flowerVase)
                    price = prc_part[1] * count;
                else
                    price = (prc_part[1] * count) + item.flowerVase;
                return price;
            } else if (item.type == 2) {
                return prc_part[1];
            }
        } else if (item.flw_type) {
            var prc_part = item.flw_type.split("|");
            if (item.type == 1) {
                var count = item.week * 4;
                if (flag == 1 && item.flowerVase)
                    price = (prc_part[1] * item.total * count) + item.flowerVase;
                else {
                    price = prc_part[1] * item.total * count;
                }
                return price;
            } else if (item.type == 2) {
                price = prc_part[1] * item.total;
                return price;
            }
        }



    };

    _this.week = [
        {
            id: 1,
            title: 'شنبه'
        },
        {
            id: 2,
            title: 'یکشنبه'
        },
        {
            id: 3,
            title: 'دوشنبه'
        },
        {
            id: 4,
            title: 'سه شنبه'
        },
        {
            id: 5,
            title: 'چهارشنبه'
        },
        {
            id: 6,
            title: 'پنح شنبه'
        },
        {
            id: 7,
            title: 'جمعه'
        },
    ];
    _this.time = [
        {
            id: 1,
            title: '9-12'
        },
        {
            id: 2,
            title: '12-15'
        },
        {
            id: 3,
            title: '15-18'
        },
        {
            id: 4,
            title: '18-21'
        }
    ];
    _this.w = [
        {
            id: 1,
            title: 'یک ماه'
        },
        {
            id: 3,
            title: 'سه ماهه'
        },
        {
            id: 6,
            title: 'شش ماهه'
        },
        {
            id: 12,
            title: 'دوازده ماهه'
        }
    ];


    _this.submit = function () {
        _this.loading = true;
        htp(home('console/order/submit'), _this.data, _this.data.msg).then(function (res) {
            notify('success', 'اطلاعات با موفقیت ثبت گردید')
        }).error(function (res, sts) {
            if (sts == 422) {
                notify('error', res['msg'])
            } else {
                _this.errorItems = res;
            }
        }).after(function (res) {
            _this.loading = false;
        });
    }


});

app.directive('useDropdown', function ($timeout) {
    function link(s, elm, attr, ngModel) {
        s.hasMultiple = $(elm).hasClass('multiple');
        $(elm).dropdown({
            onChange: function (value, text, $choise) {
                s.$apply(function () {
                    if (!s.hasMultiple) {
                        ngModel.$setViewValue(value);
                    } else {
                        ngModel.$setViewValue(value.split(','));
                    }
                });
            },
            message: {
                addResult: 'Add <b>{term}</b>',
                count: '{count} انتخاب شده',
                maxSelections: 'Max {maxCount} selections',
                noResults: 'نتیجه ای یافت نشد!'
            }
        });
        ngModel.$render = function () {
            $timeout(function () {
                if (ngModel.$viewValue != undefined) {
                    $(elm).dropdown('set selected', ngModel.$viewValue);
                } else {
                    $(elm).dropdown('restore defaults');
                }
            });
        }

    }

    return {
        restrict: 'A',
        require: 'ngModel',
        link: link,
    };
});


app.directive('useSearch', function ($timeout) {
    function link(scope, elm, attr, ngModel) {
        var xsrf = $('meta[name="csrf-token"]').attr('content');
        $(elm).search({
            apiSettings: {
                method: 'POST',
                minCharacters: 3,
                beforeSend: function (settings, param) {
                    settings.data = {
                        query: settings.urlData.query
                    };
                    return settings;
                },
                onResponse: function (response) {
                    return response;
                },
                url: home('console/order/customer-search'),
                beforeXHR: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', xsrf);
                },
            },
            onSelect: function (result, response) {
                if (attr.key) {
                    ngModel.$setViewValue(result[attr.key]);
                } else {
                    ngModel.$setViewValue(result);
                }
            },
            templates: {
                message: function (message, type) {
                    if (type == 'empty') {
                        return '<div class="p-md">هیچ نتیجه ای یافت نشد!</div>';
                    }
                    return message;
                }
            },

        });
        ngModel.$render = function () {
            $timeout(function () {
                $(elm).search('set value', ngModel.$viewValue);
            });
        };
        scope.useSearch = {};
    }

    return {
        restrict: 'A',
        require: 'ngModel',
        scope: {
            useSearch: '='
        },
        link: link
    };
});

app.controller('OrderListDayCtrl', function ($scope) {
    $scope.tbl = {};
});
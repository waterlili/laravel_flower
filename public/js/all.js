'use strict';
function deepFind(obj, path) {
    var paths = path.split('.')
        , current = obj
        , i;

    for (i = 0; i < paths.length; ++i) {
        if (current[paths[i]] == undefined) {
            return undefined;
        } else {
            current = current[paths[i]];
        }
    }
    return current;
}

function trans(where, attr) {
    var _tmp = deepFind(_trans_en, where);
    if (!_tmp) {
        return where;
    }
    for (var i in attr) {
        _tmp = _tmp.replace(':' + i, attr[i]);
    }

    return _tmp;
}

var _trans = {
    'message': {
        'title_delete': 'آیا مطمئن به حذف رکورد مورد نظر هستید؟',
        'content_delete': 'عنوان رکورد مورد نظر برای حذف :attr می باشد',
        'set_record': 'اطلاعات :attr با موفقیت در سامانه به ثبت رسید',
        'unset_record': 'متاسفانه در روند ذخیره سازی :attr مشکلی پیش آمده',
        'delete_record': ':attr مورد نظر با موفقیت حذف گردید.',
        'time_set': 'زمان فاکتور مورد نظر با موفقیت به ثبت رسید',
        'time_set_error': 'در روند ذخیره سازی زمان مورد نظر مشکلی پیش آمد.',
        'delete_record_error': 'متاسفانه در روند حذف :attr مورد نظر مشکلی رخ داده است.  لطفا مجددا تلاش کنید و یا با مدیر سامانه مشکل را اطلاع دهید.',
    }
};


var _trans_en = {
    'message': {
        'title_delete': 'آیا مطمئن به حذف رکورد مورد نظر هستید؟',
        'content_delete': 'عنوان رکورد مورد نظر برای حذف :attr می باشد',
        'desc_delete': 'درصورتی که رکورد مورد نظر حذف شود اطلاعات برگشت پذیر نخواهد بود.',
        'set_record': 'اطلاعات :attr با موفقیت در سامانه به ثبت رسید',
        'unset_record': 'Sorry! During Setting :attr has problem',
        'delete_record': ':attr مورد نظر با موفقیت حذف گردید.',
        'time_set': 'زمان فاکتور مورد نظر با موفقیت به ثبت رسید',
        'time_set_error': 'در روند ذخیره سازی زمان مورد نظر مشکلی پیش آمد.',
        'delete_record_error': 'متاسفانه در روند حذف :attr مورد نظر مشکلی رخ داده است.  لطفا مجددا تلاش کنید و یا با مدیر سامانه مشکل را اطلاع دهید.',
        'not_found_state': 'صفحه درخواستی وجود ندارد',
        'error_state': 'متاسفیم! برای سیستم یک خطای غیر منتظره بوجود آمده است . لطفا با مدیر سامانه این موضوع را در میان بگذارید.',
        'error_public_state': 'متاسفیم! سیستم یک خطای غیر منتظره دارد.',
    },
    'page_title': {
        'consoleprofilesettings': 'پروفایل کاربری',
        'consolemanageusers': 'مدیریت کاربران',
        'consolemanageroles': 'قوانین دسترسی',
        'consolemanageconst': 'مدیریت ثابت ها',
        'consolemanagelog': 'رویداد های سیستمی',
        'consoleproductlist': 'محصولات',
        'consoleproductadd': 'افزودن محصول',
        'consoleorderadd': 'افزودن سفارش مناسبتی',
        'consoleorderlistlist': 'سفارش ها',
        'consoleorderlistunverified': 'سفارش های تایید نشده',
        'consoleorderreport': 'گزارش سفارش',
        'consolecustomerlist': 'مشتریان',
        'consolecustomeradd': 'افزودن مشتری',
        'consolecustomergroup': 'گروه بندی مشتری',
        'consolecost': 'هزینه های جاری'
    },
    'subject': {
        'page': 'Page'
    },
    'w': {
        'yes': 'بلی',
        'cancel': 'انصراف',
    }
};

var app = angular.module('app', [
    'ngRoute',
    'ngMaterial',
    'ngMessages',
    'ui.router',
    'ckeditor',
    'ui.tree',
    'ngAnimate',
    'ngTable',
    'ngResource',
    'mdColors',
    'chart.js',
    'ngFileUpload',
    'angular-popover',
    'ui.mask',
    'mdPickers',
    'ui.select',
    'bcherny/formatAsCurrency',
    'ngJalaaliFlatDatepicker',
    'ngSanitize'
]);

function home($path) {
    return __domain + $path;

}

app.config(function ($mdThemingProvider) {

    var neonRedMap = $mdThemingProvider.extendPalette('cyan', {
        '500': '#00BBD3',
        '300': '#0097a7',
        '600': '#00bcd4',
        '400': '#212121',
        'contrastDefaultColor': 'light'
    });
    // Register the new color palette map with the name <code>neonRed</code>
    $mdThemingProvider.definePalette('araCyan', neonRedMap);
    $mdThemingProvider.theme('default')
        .primaryPalette('light-green', {'default': '700'})
        .accentPalette('teal', {'default': '500', 'hue-1': '900', 'hue-2': '400', 'hue-3': '300'})
        .warnPalette('red', {'default': '600'})
        .backgroundPalette('grey', {'default': '50'});
});


Chart.defaults.global.defaultFontFamily = 'yek';


var CircleChart = function () {
    this.labels = [];
    this.series = [];
    this.data = [];
    this.options = {};
    this.datasetOverride = {};
    this.defaultOption = function () {
        this.options = {
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false
                        }
                    }
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true
                        }
                    }
                ]
            }
        };
    };

    this.init = function () {
        this.data = [];
        this.series = ['Series 1'];
        for (var i = 0; i < 3; i++) {
            var date = new Date();
            this.labels.push(date.getDate() + i);
            this.data.push(getRandomInt(100, 250));
        }
    };
    this.init();
};

var LineChart = function () {
    this.labels = [];
    this.series = [];
    this.data = [];
    this.options = {};
    this.datasetOverride = [];

    this.defaultOption = function () {
        this.options = {
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [
                    {
                        gridLines: {
                            display: true
                        }
                    }
                ]
            }
        };
    };

    this.init = function () {
        this.data[0] = [];
        this.data[1] = [];
        this.data[2] = [];
        this.series = ['Series 1', 'Series 2', 'Series 3'];
        for (var i = 0; i < 10; i++) {
            var date = new Date();
            this.labels.push(date.getDate() + i);
            this.data[0].push(getRandomInt(100, 150));
            this.data[1].push(getRandomInt(100, 150));
            this.data[2].push(getRandomInt(100, 150));
        }
    };
    this.init();
};

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

app.factory('htp', function ($http, notify) {
    var _Htp = function (url, data) {
        this.options = {};
        this.afterSuccess = [];
        var that = this;
        $http.post(url, data)
            .success(function (response) {
                if (that.options.then) {
                    that.options.then.call(this, response);
                }

                if (that.options.after) {
                    that.options.after.call(this, response);
                }
                _.each(that.afterSuccess, function (item) {
                    item.call(that, response);
                });
            })
            .error(function (response, sts) {
                if (that.options.after) {
                    that.options.after.call(this, response, sts);
                }
                if (that.options.error) {
                    that.options.error.call(this, response, sts);
                }
                switch (sts) {
                    case 422:
                        if (that.errorItem) {
                            that.errorItem.call(this, response);
                        }
                        notify('error', trans('message.422'));
                        break;
                }
            });
    };


    _Htp.prototype.then = function (fn) {
        this.options.then = fn;
        return this;
    };

    _Htp.prototype.after = function (fn) {
        this.options.after = fn;
        return this;
    };

    _Htp.prototype.error = function (fn) {
        this.options.error = fn;
        return this;
    };

    _Htp.prototype.errorNotice = function (fn) {
        this.errorItem = fn;
        return this;
    };

    _Htp.prototype.saveSend = function (title) {
        this.afterSuccess.push(function () {
            notify('info', trans('message.set_record', {attr: title}))
        });
        return this;
    };


    return function (url, data) {
        return new _Htp(url, data);
    };
});
app.directive('useAc', function ($http) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }
        if (!s.o) {
            s.o = {}
        }
        s.o.querySearch = function ($search) {

            var _export = {textSearch: $search};

            if (s.o.getData) {
                _export.extra = s.o.getData();
            }
            return $http.post(home(s.link), _export).then(function (response) {
                return response.data;
            });
        };

        s.$watch('o.selectedItem', function (n) {
            s.n = n;
        });
    }

    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngModel',
            o: '=ngOpt',
            link: '=ngLink'
        }
    }
});
app.directive('useChip', function ($http) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }
        if (!s.o) {
            s.o = {}
        }
        s.o.transformChip = function (chip) {
            if (angular.isObject(chip)) {
                return chip;
            }
            return {name: chip, type: 'new'};
        };
        s.o.querySearch = function ($search) {
            return $http.post(home(s.link), {textSearch: $search}).then(function (response) {
                return response.data;
            });
        };
    }

    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngModel',
            o: '=ngOpt',
            link: '=ngLink'
        }
    }
});
app.factory('notify', function () {
    return function ($type, $text, $delay) {
        $delay = $delay || 7500;
        var scope = angular.element('#notify-wrapper').scope();
        if (scope)
            scope._notify($type, $text, $delay);
    }
});


app.controller('NotifyCtrl', function ($scope, $timeout) {
    $scope.admin_notify = [];
    $scope.times = [];
    $scope._notify = function ($type, $text, $delay) {
        $scope.admin_notify.push({type: $type, text: $text, delay: $delay});
        $scope.times.push($timeout(function () {
            $scope._destroy(0);
        }, $delay))
    };
    $scope._destroy = function ($index) {
        $scope.admin_notify = _.without($scope.admin_notify, $scope.admin_notify[$index]);
        $scope.times = _.without($scope.times, $scope.times[$index]);
    };
});
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



app.factory('loader', function () {
    return function ($sts) {
        var scope = angular.element('#main-progress-bar').scope();
        if($sts) {
            scope._on();
        }
        else{
            scope._off();
        }
    }
});

app.controller('PreloaderCtrl', function ($scope, $timeout) {
    $scope._off = function () {
        $scope._loader = false;
    };
    $scope._on = function () {
        $scope._loader = true;
    }
});
app.factory('httpRequestInterceptor', function ($q, $location, notify) {

    return {
        'responseError': function (rejection) {
            // do something on error
            switch (rejection.status) {
                case 404:
                    // notify('warning', 'صفحه درخواستی وجود ندارد');
                    if (rejection.config.method == 'GET')
                    // window.history.back();
                        break;
                case 401:
                    // notify('red', 'شما سطح دسترسی به این بخش از سامانه ندارید');
                    // if (rejection.config.method == 'GET')
                    // window.history.back();
                    
                    break;
                case 423:
                    notify('red', 'آخرین نشست شما باطل شده. لطفا مجددا وارد شوید.');
                    // window.location.href = home('auth/login');
                    break;
                case  406:
                    break;

            }
            return $q.reject(rejection);
        }
    };
});

app.config(function ($httpProvider, $stateProvider, $urlRouterProvider) {
    $httpProvider.interceptors.push('httpRequestInterceptor');
    var build_url = function ($url) {
        if ($url.indexOf(':') != -1) {
            return function ($param) {
                return home($url);
            }
        } else {
            return home($url);
        }
    };
    $$routes = angular.fromJson($$routes);


    var $redirect = {
        '/': '@/dashboard',
        'console/order/list': '@/order/list'
    };

    _.map($redirect, function (_to, _in) {
        if (/@/.test(_to)) {
            _to = _to.replace(new RegExp('@'), _in);
        }
        $urlRouterProvider.when('/' + _in, '/' + _to);
    });

    if ($$routes) {
        _.map($$routes, function (item) {
            var _item = {};
            _item.templateUrl = function (url) {
                if (_.isObject(url) && _.size(url)) {
                    return home(item.url + '/' + url.id);
                } else {
                    return home(item.url);
                }
            };
            if (item.ctrl != 'AdminCtrl') {
                _item.controller = item.ctrl;
                _item.controller = item.ctrl;
            } else {
                _item.controller = 'AdminCtrl';
            }

            _item.views = {
                "viewMaster": {
                    templateUrl: _item.templateUrl,
                    controller: _item.controller
                },
                "viewTab": {
                    templateUrl: _item.templateUrl,
                    controller: _item.controller
                }
            };

            if (item.sref) {
                _item.state = item.sref;
            } else {
                _item.state = item.url.replace(new RegExp('/', 'g'), '.');
                _item.state = item.url;
            }
            _item.url = '/' + item.ui_url;
            $stateProvider.state(_item.state, _item);
        });
    }
});
 
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
                notify('warning', 'ردکورد مورد نظر با موفقیت حذف شد');
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

app.controller('RegisterCtrl', function ($scope, $http) {
    $scope.data = {};
    $scope.mode = 0;
    $scope.form_title = ['فرم ثبت نام سریع رویش وب', 'ثبت نام شما با موفقیت انجام شد', 'در فرآیند ثبت نام شما خطایی رخ داده است'];
    $scope.valid_pass = function () {
        if ($scope.register_form) {
            $scope.register_form.$setValidity('pass', ($scope.data.password == $scope.data.password_confirmation));
        }
    };
    $scope.$watch('data.password', function () {
        $scope.valid_pass()
    });
    $scope.$watch('data.password_confirmation', function () {
        $scope.valid_pass()
    });

    $scope.submit = function ($event) {
        $event.preventDefault();
        $scope.loading(true);
        $http.post(home('auth/register'), $scope.data)
            .success(function (response) {
                $scope.loading(false);
                $scope.mode = 1;
                $scope.result = response;
            })

            
            .error(function (response, status) {
                $scope.loading(false);
                if (status == 422) {
                    $scope.server_error = response;
                }
                else if (status == 500 || 400) {
                    $scope.mode = 2;
                }
            });
    };
    $scope.loading = function ($mode) {
        $scope.preloader = $mode;
    }
});


app.controller('LoginCtrl', function ($scope, $http) {
    $scope.data = {};

    $scope.submit = function ($event) {
        $scope.loading(true);
        $scope.server_error = $scope.unauthorized = $scope.not_acceptable = undefined;
        $event.preventDefault();
        $http.post(home('auth/login'), $scope.data)
            .success(function (response) {
                if (response['result'] == true) {
                    window.location.href = response['redirectPath'];
                }
            })
            .error(function (response, status) {
                $scope.loading(false);
                if (status == 422) {
                    $scope.server_error = response;
                } else if (status == 401) {
                    $scope.unauthorized = true;
                } else if (status == 406) {
                    $scope.not_acceptable = true;
                }
            });
    };

    $scope.loading = function ($mode) {
        $scope.preloader = $mode;
    }
});

app.directive('useNgTable', function (NgTableParams, $http, $window) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }

        if (!(s.n.filter)) {
            s.n.filter = {};
        }

        if (!s.n.cols) {
            s.n.cols = {};
        }

        s.n.filter.$items = [];
        s.n.filter.adder = {};
        s.n.btnFilter = [];


        s.n.filter.showFS = function () {
            s.n.filter.showFilterSelect = true;
        };

        s.n.isActiveBtnFilter = function (id) {
            return _.indexOf(s.n.btnFilter, id) != -1;
        };

        s.n.toggleBtnFilter = function (id) {
            if (s.n.isActiveBtnFilter(id)) {
                s.n.btnFilter = _.without(s.n.btnFilter, id);
            } else {
                s.n.btnFilter.push(id);
            }
            s.n.serv();
        };

        s.n.filter.hideFS = function () {
            s.n.filter.showFilterSelect = false;
        };

        s.n.filter.changeCritical = function (item) {
            switch (item.cr) {
                case 'or':
                    item.cr = 'and';
                    break;
                case 'and':
                    item.cr = 'not';
                    break;
                case 'not':
                    item.cr = 'or';
                    break;
            }
        };

        s.n.filter.cr = {
            'or': {title: 'یا', icon: 'device_hub'},
            'and': {title: 'و', icon: 'all_inclusive'},
            'not': {title: 'نباشد', icon: 'not_interested'},
        };


        s.n.offProgress = function () {
            s.n.progress = false;
        };

        s.n.onProgress = function () {
            s.n.progress = true;
        };

        var _post = function (params) {
            s.n.onProgress();
            return $http.post(home(s.n.ngtRoute), s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting()
            })).error(function () {
                s.n.offProgress();
            }).then(function (response) {
                s.n.offProgress();
                if (response.status == 200) {
                    params.total(response.data.total);
                    return response.data.rows;
                }
            });
        };

        s.n.filter.addFilter = function () {
            var _t = _.findWhere(s.n.filter.$data, {value: s.n.filter.mdSelect});

            s.n.filter.$items.push({
                title: _t.title,
                value: _t.value,
                type: _t.type,
                select: _t.select,
                cr: 'and'
            });

            s.n.filter.mdSelect = undefined;
            s.n.filter.showFilterSelect = false;
        };

        s.n.filter.when = function (item) {
            item.when++;
            if (item.when == 4) {
                item.when = 1;
            }
        };
        s.n.filter.removeItem = function (item) {
            s.n.filter.$items = _.without(s.n.filter.$items, _.findWhere(s.n.filter.$items, {value: item.value}));
        };
        s.n.filter.adder.isOpen = false;

        s.n.tableParams = new NgTableParams({
            count: 5
        }, {
            counts: [5, 10, 20],
            paginationMaxBlocks: 10,
            paginationMinBlocks: 2,
            getData: _post
        });

        s.n.serv = function () {
            s.n.tableParams.reload();
        };

        s.n.servData = function (params) {
            params = params || {};
            if (s.n.postData) {
                params = _.extend(params, s.n.postData());
            }
            if (s.n.btnFilter) {
                params = _.extend(params, {btnFilter: s.n.btnFilter});
            }
            return _.extend(params, {
                cols: s.n.getCols(),
                filter: s.n.filter.$items,
                ngtRoute: s.n.ngtRoute
            });
        };

        s.n.getCols = function () {
            var tmp = [];
            _.each(s.n.cols, function (item, key) {
                if (_.isBoolean(item)) {
                    if (item)
                        tmp.push(key);
                } else {
                    for (var i in item) {
                        if (item[i]) {
                            tmp.push(key + '.' + i);
                        }
                    }
                }
            });
            return tmp;
        };
        s.n.exportExcel = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                excelExport: true
            });
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                if (response && response.file) {
                    window.location = home('console/excel-file?url=' + response.file);
                }
            });
        };


        s.n.print = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                exportPrint: true
            });
            console.log('100', 100);
            var w = $window.open("", '_blank');
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                console.log('window', window);
                w.location.href = home('console/print-table');
            });
        };

        s.n.exportPDF = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                excelExport: true,
                pdfExport: true
            });
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                if (response && response.file) {
                    window.location = home('console/excel-file?url=' + response.file);
                }
            });
        };

        s.n.reload = function () {
            s.n.tableParams.reload();
        };

    }

    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngtModel'
        }
    }
});
app.controller('ConstCtrl', function ($scope, htp, notify) {
    var _this = $scope;
    var CONST = function ($set, $get) {
        var that = this;
        this.items = [];
        this.errorItems = undefined;
        this.loading = false;
        this.set = $set;
        this.get = $get;
        this.init = function () {
            this.loading = true;
            htp(home(this.get)).then(function (res) {
                if (res && res.result == true) {
                    that.items = res.data;
                }
            }).error(function (res, sts) {
                if (sts == 422) {
                    that.errorItems = res;
                }
            }).after(function () {
                that.loading = false;
            });
        };
        this.add = function () {
            that.errorItems = undefined;
            htp(home(this.set), {title: this.name}).then(function (res) {
                that.init();
                that.name = undefined;
            }).error(function (res, sts) {
                if (sts == 422) {
                    that.errorItems = res;
                }
            }).after(function () {
                that.loading = false;
            });
        };
        this.init();
    };
    _this.flower = new CONST('console/manage/set-const-flower', 'console/manage/get-const-flower');
    _this.pack = new CONST('console/manage/set-const-pack', 'console/manage/get-const-pack');
    _this.cost = new CONST('console/manage/set-const-cost', 'console/manage/get-const-cost');
    _this.user_type = new CONST('console/manage/set-const-user-type', 'console/manage/get-const-user-type');
    
});
app.controller('CostCtrl', function ($scope, htp, notify) {
    var _this = $scope;
    _this.tbl = {};
    _this.uidOpt = {};
    _this.parentOpt = {};
    _this.show_form = false;
    _this.submit = function () {
        _this.loading = true;
        _this.Form.$setValidity('loading', false);
        htp(home('console/cost/add'), _this.data).then(function (res) {
            notify('info', 'سند با موفقیت به ثبت رسید');
            _this.data = {};
            _this.uidOpt.searchText = undefined;
            _this.parentOpt.searchText = undefined;
            _this.Form.$setPristine();
            
            _this.tbl.reload();
        }).error(function (res, sts) {
            if (sts == 422) {
                _this.errorItem = res;
            }
        }).after(function () {
            _this.loading = false;
            _this.Form.$setValidity('loading', true);
        });
    };
});
app.controller('CustomerAddCtrl', function ($scope, htp, $controller, notify, $rootScope) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/customer/add';
    _this.submiterName = 'مشتری';

    if (_this.edit_mode) {
        _this.data = _this.dt;
        _.each(_this.data.user_info, function (item, key) {
            if (!_this.data.hasOwnProperty(key)) {
                _this.data[key] = item;
            }
        });
    }
    _this.afterSuccess = function (response) {
        if (response.id)
            notify('info', 'کد مشتری ثبت شده :' + response.id);
    };


    var GROUP = function () {
        this.text = undefined;
        this.parent = undefined;
        this.all = [];
        var that = this;
        this.init = function () {
            htp(home('console/customer/get-groups')).then(function (response) {
                if (response && response.result == true) {
                    that.all = response.data;
                }
            });
        };
        this.add = function () {
            this.loading = true;
            var that = this;
            that.errorItem = undefined;
            htp(home('console/customer/add-group'), {
                title: this.text,
                parent: (this.parent) ? this.parent.id : null
            }).then(function (response) {
                that.text = '';
                that.init();
            }).error(function (response, sts) {
                if (sts == 422) {
                    that.errorItem = response;
                }
            }).after(function (response) {
                that.loading = false;
            });
        };
        this.init();
    };
    _this.group = new GROUP();

    _this.export = function () {
        var arr = _this.findDeep(_this.group.all);
        _this.data.groups = _.map(arr, function (val) {
            return val.id;
        });
        return _this.data;
    };

    _this.findDeep = function (items) {
        var $export = [];

        function traverse(value) {
            _.forEach(value, function (val) {
                if (_.isObject(val) && val.hasOwnProperty('child')) {
                    traverse(val.child);
                }
                if (val.has && val.has == true) {
                    $export.push(val);
                }
            });
        }

        traverse(items);
        return $export;
    };

    _this.$watch('customer', function (n) {
        if (n) {
            $rootScope.$emit('order:customer', n);
        }
    });

    _this.getData = function () {
        _this.data = undefined;
        htp(home('console/order/get-data'), {customer: _this.customer}).then(function (res) {
            _this.data = res
        }).error(function () {

        });
    }
});
app.controller('CustomerListCtrl', function ($scope) {
    var _this = $scope;
    _this.tbl = {};

});
app.controller('CustomerGroupCtrl', function ($scope, htp , notify) {
    var _this = $scope;
    _this.chipOpt = {};
    _this.chipCusOpt = {};
    _this.data = {};
    _this.data.groups = [];
    _this.data.customers = [];

    _this.submit = function () {
        _this.loading = true;
        htp(home('console/customer/set-groups'), _this.data).then(function (response) {
            notify('info', 'انتصاب با موفقیت اعمال گردید');
            _this.data.groups = [];
            _this.data.customers = [];
        }).after(function (response) {
            _this.loading = false;
        }).error(function (response, sts) {
            if (sts == 422) {
                _this.errorItem = response;
            }
        });
    };
    var GROUP = function () {
        this.text = undefined;
        this.parent = undefined;
        this.all = [];
        var that = this;
        this.init = function () {
            htp(home('console/customer/get-groups')).then(function (response) {
                if (response && response.result == true) {
                    that.all = response.data;
                }
            });
        };
        this.add = function () {
            this.loading = true;
            var that = this;
            that.errorItem = undefined;
            htp(home('console/customer/add-group'), {
                title: this.text,
                parent: (this.parent) ? this.parent.id : null
            }).then(function (response) {
                that.text = '';
                that.init();
            }).error(function (response, sts) {
                if (sts == 422) {
                    that.errorItem = response;
                }
            }).after(function (response) {
                that.loading = false;
            });
        };
        this.init();
    };
    _this.group = new GROUP();

});
app.controller('LogCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.tbl = {};
});
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
app.controller('OrderReportCtrl', function ($scope, htp) {
    var _this = $scope;
    var REPORT = function (url) {
        this.url = url;
        this.date = undefined;
        var that = this;
        if (!this.chart) {
            this.chart = {};
        }
        this.load = function () {
            this.loading = true;
            htp(home(this.url), {date: this.date}).then(function (res) {
                that.dt = res.dt;
                that.date = res.date;
                that.chart.load();
            }).error(function (res, sts) {
                if (sts == 422) {
                    that.errorItem = res;
                }
            }).after(function () {
                that.loading = false;
            });
        };
        this.chart.send = function () {
            return angular.extend(that.dt, {date: that.date});
        };
        this.load();
    };
    _this.day = new REPORT('console/order/get-day-report-data');
    _this.week = new REPORT('console/order/get-week-report-data');
    _this.month = new REPORT('console/order/get-month-report-data');

    _this.week.chart.options =
    {
        scales: {
            yAxes: [{
                stacked: true,
                ticks: {
                    stepSize: 1
                }
            }]
        }
    };

    _this.month.chart.options =
    {
        scales: {
            yAxes: [{
                stacked: true,
                ticks: {
                    stepSize: 1
                }
            }]
        }
    };

});
app.controller('ProductAddCtrl', function ($scope, htp, $controller) {
    $controller('SubmitController', {$scope: $scope});
    var _this = $scope;
    _this.submiterUrl = 'console/product/add';
    _this.submiterName = 'محصول';

    if (_this.edit_mode) {
        _this.data = _this.dt;
    }
    _this.data = {};
    _this.data.composit = [];
    var COMP = function () {
        this.disabled = false;
        this.flower = this.total = undefined;
        this.add = function () {
            _this.data.composit.push({
                flower: this.flower,
                total: this.total
            });
            this.flower = this.total = undefined;
            this.flowerOpt.searchText = undefined;
            this.flowerOpt.selectedItem = undefined;
        };

        this.remove = function ($index) {
            _this.data.composit = _.without(_this.data.composit, _this.data.composit[$index]);
        };
    };
    _this.afterSuccess = function () {
        _this.data = {};
        _this.data.composit = [];
        _this.comp = new COMP();
    };
    _this.comp = new COMP();
});


app.controller('ProductListCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.tbl = {};
});
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
app.controller('RoleCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.check = {};
    _this.submit = function () {
        _this._export();
        htp(home('console/manage/set-roles'), _this.data).saveSend('قوانین');
    };
    _this.data = {};


    _this.init = function () {
        _this.loading = true;
        htp(home('console/manage/get-roles'), {user_type: _this.data.user_type}).then(function (response) {
            _this.data.roles = response;
            _this.data_back = true;
        }).after(function () {
            _this.loading = false;
        });
    };

    _this.$watch('data.user_type', function (n) {
        if (n) {
            _this.init();
        }
    });

    _this.isIndeterminate = function () {
        return true;
    };

    _this._export = function () {
        var _tmp = [];
        var hasExport = function (obj) {
            if (obj.children) {
                _.each(obj.children, function (item) {
                    hasExport(item);
                });
            }
            if (obj.has && obj.has == true) {
                _tmp.push(obj._rid);
            }
        };
        _.each(_this.data.roles, function (ite) {
            hasExport(ite);
        });
        return _this.data.export = _tmp;
    };

    _this.parent = function (type, rid) {
        if (_this.data[type][rid] == true) {
            for (var i = rid; Math.floor(i / 100) > 0;) {
                i = Math.floor(i / 100);
                _this.data[type][i] = true;
            }
        }

    };
});

app.directive('collection', function () {
    return {
        restrict: "E",
        replace: true,
        scope: {
            collection: '='
        },
        template: "<div class='inner collection'><member ng-repeat='member in collection' member='member'></member></div>"
    }

});

app.directive('member', function ($compile) {
    return {
        restrict: "E",
        replace: true,
        scope: {
            member: '='
        },
        templateUrl: home('console/manage/role-list-template'),
        link: function (scope, element, attrs) {
            scope.isIn = function () {
                var r = false;
                var e = _.map(scope.member.children, function (item, key) {
                    if (item.has || item.parent) {
                        r = true;
                        scope.member.children[key].parent = true;
                    }
                    return item.has;
                });
                return r;
            };
            if (angular.isObject(scope.member.children)) {
                var tmp = "<collection collection='member.children' ng-show='member.show' class='collection'></collection>";
                var $content = $compile(tmp)(scope);
                element.append($content);

                scope.toggleShow = function (member) {
                    if (member.show == undefined) {
                        member.show = true;
                    } else {
                        member.show = !member.show;
                    }
                };
            }
        }
    }
});

app.directive('useChartJs', function (htp) {
    function link(s, elem, attr) {
        if (!s.n) {
            s.n = {};
        }
        s.n.load = function () {
            var dt = {};
            if (s.n.send) {
                dt = s.n.send();
            }
            htp(home(attr.link), dt).then(function (response) {
                console.log('response', response);
                s.n = angular.extend(s.n, response);
            });
        };

        s.n.load();




    }

    return {
        restrict: 'A',
        scope: {
            n: '=ngModel'
        },
        link: link
    };
});

app.directive('useSelectSm', function (htp) {
    function link(s, elem, attr) {
        $(elem).dropdown({
            onChange: function (value, text, choise) {
                s.n = value;
                s.$apply();
            }
        });
        if (s.n) {
            $(elem).dropdown('set selected', s.n);
        }
    }

    return {
        restrict: 'A',
        scope: {
            n: '=ngModel'
        },
        link: link
    };
});

app.directive('groupCollection', function () {
    return {
        restrict: "E",
        replace: true,
        scope: {
            collection: '=',
            url: '='
        },
        template: "<div class='inner collection group'><group-member ng-repeat='member in collection' member='member' url='url'></group-member></div>"
    }
});

app.directive('groupMember', function ($compile) {
    return {
        restrict: "E",
        replace: true,
        scope: {
            member: '=',
            url: '='
        },
        templateUrl: function (element, attr) {
            return home('console/group-collection');
        },
        link: function (scope, element, attrs) {
            if (angular.isObject(scope.member.child)) {
                var tmp = "<group-collection collection='member.child' class='collection'></group-collection>";
                var $content = $compile(tmp)(scope);
                element.append($content);
            }
        }
    }
});
//# sourceMappingURL=all.js.map

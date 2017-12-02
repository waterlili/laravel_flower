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
 
app.controller('CustomerAddCtrl', function ($scope, htp, $controller, notify, $rootScope) {
    $controller('SubmitController', {$scope: $scope});


    var _this = $scope;

    _this.data = {};
    _this.information = [];
    _this.information1 = [];
    _this.information2 = [];
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
app.controller('CustomerAddCtrl', function ($scope, htp, $controller, notify) {
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
});
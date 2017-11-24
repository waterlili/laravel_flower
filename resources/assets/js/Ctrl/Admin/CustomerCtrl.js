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

    $scope.$on('child1', function (event, data) {
        // _this.lastAddress = [];
        // console.log(data);

        _this.arr = [];
        _this.arr = data;
        _this.information.push(_this.arr);
        _this.lastAddress = _this.information[_this.information.length - 1];


    });
    $scope.$on('child2', function (event, data) {
        // _this.lastAddress = [];
        // console.log(data);

        _this.arr1 = [];
        _this.arr1 = data;
        _this.information1.push(_this.arr1);
        _this.lastAddress1 = _this.information1[_this.information1.length - 1];


    });
    $scope.$on('child3', function (event, data) {
        // _this.lastAddress = [];
        // console.log(data);

        _this.arr2 = [];
        _this.arr2 = data;
        _this.information2.push(_this.arr2);
        _this.lastAddress2 = _this.information2[_this.information2.length - 1];


    });
    // $scope.$on('child1', function (event, data) {
    //     // var $export = [];
    //     _this.information.push(data);
    //     console.log(_this.information);
    //
    // });
    // $scope.$on('child2', function (event, data) {
    //     // var $export = [];
    //     _this.information.push(data);
    //     console.log(_this.information);
    //
    // });

    _this.afterSuccess = function (response) {

        if (response.id)
            notify('info', 'کد مشتری ثبت شده :' + response.id);
    };


    // var GROUP = function () {
    //     this.text = undefined;
    //     this.parent = undefined;
    //     this.all = [];
    //     var that = this;
    //     this.init = function () {
    //         htp(home('console/customer/get-groups')).then(function (response) {
    //             if (response && response.result == true) {
    //                 that.all = response.data;
    //             }
    //         });
    //     };
    //     this.add = function () {
    //         this.loading = true;
    //         var that = this;
    //         that.errorItem = undefined;
    //         htp(home('console/customer/add-group'), {
    //             title: this.text,
    //             parent: (this.parent) ? this.parent.id : null
    //         }).then(function (response) {
    //             that.text = '';
    //             that.init();
    //         }).error(function (response, sts) {
    //             if (sts == 422) {
    //                 that.errorItem = response;
    //             }
    //         }).after(function (response) {
    //             that.loading = false;
    //         });
    //     };
    //     this.init();
    // };
    // _this.group = new GROUP();
    //
    // _this.export = function () {
    //     var arr = _this.findDeep(_this.group.all);
    //     _this.data.groups = _.map(arr, function (val) {
    //         return val.id;
    //     });
    //     return _this.data;
    // };

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
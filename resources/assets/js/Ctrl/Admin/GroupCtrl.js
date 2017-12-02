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
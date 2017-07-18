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
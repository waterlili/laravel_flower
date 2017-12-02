app.controller('ConstCtrl', function ($scope, htp, notify, $mdDialog) {
    var _this = $scope;
    _this.tbl = {};
    _this.tbl.tableParams = {};
    var CONST = function ($which) {

        var that = this;
        this.items = [];
        this.errorItems = undefined;
        this.loading = false;
        this.set = 'console/manage/set-const';
        this.get = 'console/manage/get-const';
        this.save_url = 'console/manage/save-const';
        this.init = function () {
            this.loading = true;
            htp(home(this.get), {w: $which}).then(function (res) {
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
            htp(home(this.set), {name: this.name, title: this.name, price: this.price, w: $which}).then(function (res) {
                that.init();
                that.title = undefined;
                that.name = undefined;
                that.price = undefined;
            }).error(function (res, sts) {
                if (sts == 422) {
                    that.errorItems = res;
                }
            }).after(function () {
                that.loading = false;
            });
        };
        this.init();

        this.rename = function (item) {
            item._edit_mode = true;
        };

        this.save = function (item) {
            htp(home(this.save_url), item).then(function (response) {
                item._edit_mode = false;
            });
        };
        this.init();
    };
    _this.packet_type = new CONST();
    _this.flower = new CONST(1);
    _this.job = new CONST(6);
    _this.attraction = new CONST(7);
    _this.skill = new CONST(8);
    _this.color = new CONST(5);

    _this.tbl.tableParams.reload = function () {
        _this.flower.init();
        _this.job.init();
        _this.attraction.init();
        _this.skill.init();
        _this.color.init();
        _this.packet_type.init();


    };

});
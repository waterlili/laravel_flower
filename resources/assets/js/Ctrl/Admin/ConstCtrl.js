app.controller('ConstCtrl', function ($scope, htp, notify, $mdDialog) {
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
            htp(home(this.set), {name: this.name, title: this.title, price: this.price}).then(function (res) {
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
        this.remove = function (ev, item, tbl_name) {
            var id = item.id;
            var index = _this.packet_type.items.indexOf(item);
            _this.destroy = function (id, where) {
                htp(home('console/destroy'), {id: id, where: where})
                    .then(function (response) {
                        _this.packet_type.items.splice(index, 1);
                        notify('warning', 'رکورد مورد نظر با موفقیت حذف شد');

                    });
            };
            var desc = trans('message.desc_delete');
            var confirm = $mdDialog.confirm()
                .title(trans('message.title_delete'))
                .textContent(desc)
                .ariaLabel('حدف رکورد')
                .targetEvent(ev)
                .ok('بلی')
                .cancel('خیر');
            $mdDialog.show(confirm).then(function () {
                _this.destroy(id, tbl_name);
            }, function () {

            });
        };
        this.init();
    };
    _this.flower = new CONST('console/manage/set-const-flower', 'console/manage/get-const-flower');
    _this.pack = new CONST('console/manage/set-const-pack', 'console/manage/get-const-pack');
    _this.cost = new CONST('console/manage/set-const-cost', 'console/manage/get-const-cost');
    _this.user_type = new CONST('console/manage/set-const-user-type', 'console/manage/get-const-user-type');
    _this.packet_type = new CONST('console/manage/set-const-packet-type', 'console/manage/get-const-packet-type');
});
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
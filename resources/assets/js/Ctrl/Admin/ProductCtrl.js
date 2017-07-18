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
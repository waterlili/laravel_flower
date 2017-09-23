app.directive('useNgTable', function (NgTableParams, $http, $window) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }

        if (!(s.n.filter)) {
            s.n.filter = {};
        }

        if (!s.n.cols) {
            s.n.cols = {};
        }

        s.n.filter.$items = [];
        s.n.filter.adder = {};
        s.n.btnFilter = [];


        s.n.filter.showFS = function () {
            s.n.filter.showFilterSelect = true;
        };

        s.n.isActiveBtnFilter = function (id) {
            return _.indexOf(s.n.btnFilter, id) != -1;
        };

        s.n.toggleBtnFilter = function (id) {
            if (s.n.isActiveBtnFilter(id)) {
                s.n.btnFilter = _.without(s.n.btnFilter, id);
            } else {
                s.n.btnFilter.push(id);
            }
            s.n.serv();
        };

        s.n.filter.hideFS = function () {
            s.n.filter.showFilterSelect = false;
        };

        s.n.filter.changeCritical = function (item) {
            switch (item.cr) {
                case 'or':
                    item.cr = 'and';
                    break;
                case 'and':
                    item.cr = 'not';
                    break;
                case 'not':
                    item.cr = 'or';
                    break;
            }
        };

        s.n.filter.cr = {
            'or': {title: 'یا', icon: 'device_hub'},
            'and': {title: 'و', icon: 'all_inclusive'},
            'not': {title: 'نباشد', icon: 'not_interested'},
        };


        s.n.offProgress = function () {
            s.n.progress = false;
        };

        s.n.onProgress = function () {
            s.n.progress = true;
        };

        var _post = function (params) {
            s.n.onProgress();
            return $http.post(home(s.n.ngtRoute), s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting()
            })).error(function () {
                s.n.offProgress();
            }).then(function (response) {
                s.n.offProgress();
                if (response.status == 200) {
                    params.total(response.data.total);
                    return response.data.rows;
                }
            });
        };

        s.n.filter.addFilter = function () {
            var _t = _.findWhere(s.n.filter.$data, {value: s.n.filter.mdSelect});

            s.n.filter.$items.push({
                title: _t.title,
                value: _t.value,
                type: _t.type,
                select: _t.select,
                cr: 'and'
            });

            s.n.filter.mdSelect = undefined;
            s.n.filter.showFilterSelect = false;
        };

        s.n.filter.when = function (item) {
            item.when++;
            if (item.when == 4) {
                item.when = 1;
            }
        };
        s.n.filter.removeItem = function (item) {
            s.n.filter.$items = _.without(s.n.filter.$items, _.findWhere(s.n.filter.$items, {value: item.value}));
        };
        s.n.filter.adder.isOpen = false;

        s.n.tableParams = new NgTableParams({
            count: 5
        }, {
            counts: [5, 10, 20],
            paginationMaxBlocks: 10,
            paginationMinBlocks: 2,
            getData: _post
        });

        s.n.serv = function () {
            s.n.tableParams.reload();
        };

        s.n.servData = function (params) {
            params = params || {};
            if (s.n.postData) {
                params = _.extend(params, s.n.postData());
            }
            if (s.n.btnFilter) {
                params = _.extend(params, {btnFilter: s.n.btnFilter});
            }
            return _.extend(params, {
                cols: s.n.getCols(),
                filter: s.n.filter.$items,
                ngtRoute: s.n.ngtRoute
            });
        };

        s.n.getCols = function () {
            var tmp = [];
            _.each(s.n.cols, function (item, key) {
                if (_.isBoolean(item)) {
                    if (item)
                        tmp.push(key);
                } else {
                    for (var i in item) {
                        if (item[i]) {
                            tmp.push(key + '.' + i);
                        }
                    }
                }
            });
            return tmp;
        };
        s.n.exportExcel = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                excelExport: true
            });
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                if (response && response.file) {
                    window.location = home('console/excel-file?url=' + response.file);
                }
            });
        };


        s.n.print = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                exportPrint: true
            });
            console.log('100', 100);
            var w = $window.open("", '_blank');
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                console.log('window', window);
                w.location.href = home('console/print-table');
            });
        };

        s.n.exportPDF = function () {
            var params = s.n.tableParams;
            var _export = s.n.servData({
                page: params.page(),
                count: params.count(),
                sorting: params.sorting(),
                excelExport: true,
                pdfExport: true
            });
            $http.post(home(_export.ngtRoute), _export).success(function (response) {
                if (response && response.file) {
                    window.location = home('console/excel-file?url=' + response.file);
                }
            });
        };

        s.n.reload = function () {
            s.n.tableParams.reload();
        };

    }

    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngtModel'
        }
    }
});
app.controller('RoleCtrl', function ($scope, htp) {
    var _this = $scope;
    _this.check = {};
    _this.submit = function () {
        _this._export();
        htp(home('console/manage/set-roles'), _this.data).saveSend('قوانین');
    };
    _this.data = {};


    _this.init = function () {
        _this.loading = true;
        htp(home('console/manage/get-roles'), {user_type: _this.data.user_type}).then(function (response) {
            _this.data.roles = response;
            _this.data_back = true;
        }).after(function () {
            _this.loading = false;
        });
    };

    _this.$watch('data.user_type', function (n) {
        if (n) {
            _this.init();
        }
    });

    _this.isIndeterminate = function () {
        return true;
    };

    _this._export = function () {
        var _tmp = [];
        var hasExport = function (obj) {
            if (obj.children) {
                _.each(obj.children, function (item) {
                    hasExport(item);
                });
            }
            if (obj.has && obj.has == true) {
                _tmp.push(obj._rid);
            }
        };
        _.each(_this.data.roles, function (ite) {
            hasExport(ite);
        });
        return _this.data.export = _tmp;
    };

    _this.parent = function (type, rid) {
        if (_this.data[type][rid] == true) {
            for (var i = rid; Math.floor(i / 100) > 0;) {
                i = Math.floor(i / 100);
                _this.data[type][i] = true;
            }
        }

    };
});

app.directive('collection', function () {
    return {
        restrict: "E",
        replace: true,
        scope: {
            collection: '='
        },
        template: "<div class='inner collection'><member ng-repeat='member in collection' member='member'></member></div>"
    }

});

app.directive('member', function ($compile) {
    return {
        restrict: "E",
        replace: true,
        scope: {
            member: '='
        },
        templateUrl: home('console/manage/role-list-template'),
        link: function (scope, element, attrs) {
            scope.isIn = function () {
                var r = false;
                var e = _.map(scope.member.children, function (item, key) {
                    if (item.has || item.parent) {
                        r = true;
                        scope.member.children[key].parent = true;
                    }
                    return item.has;
                });
                return r;
            };
            if (angular.isObject(scope.member.children)) {
                var tmp = "<collection collection='member.children' ng-show='member.show' class='collection'></collection>";
                var $content = $compile(tmp)(scope);
                element.append($content);

                scope.toggleShow = function (member) {
                    if (member.show == undefined) {
                        member.show = true;
                    } else {
                        member.show = !member.show;
                    }
                };
            }
        }
    }
});

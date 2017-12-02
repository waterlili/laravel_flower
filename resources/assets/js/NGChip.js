app.directive('useChip', function ($http) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }
        if (!s.o) {
            s.o = {}
        }
        s.o.transformChip = function (chip) {
            if (angular.isObject(chip)) {
                return chip;
            }
            return {name: chip, type: 'new'};
        };
        s.o.querySearch = function ($search) {
            return $http.post(home(s.link), {textSearch: $search}).then(function (response) {
                return response.data;
            });
        };
    }

    return {
        restrict: 'A',
        link: link,
        scope: {
            n: '=ngModel',
            o: '=ngOpt',
            link: '=ngLink'
        }
    }
});
app.directive('useAc', function ($http) {
    function link(s, elm, attrs) {
        if (!s.n) {
            s.n = {};
        }
        if (!s.o) {
            s.o = {}
        }
        s.o.querySearch = function ($search) {

            var _export = {textSearch: $search};

            if (s.o.getData) {
                _export.extra = s.o.getData();
            }
            return $http.post(home(s.link), _export).then(function (response) {
                return response.data;
            });
        };

        s.$watch('o.selectedItem', function (n) {
            s.n = n;
        });
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
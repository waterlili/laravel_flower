app.directive('useChartJs', function (htp) {
    function link(s, elem, attr) {
        if (!s.n) {
            s.n = {};
        }
        s.n.load = function () {
            var dt = {};
            if (s.n.send) {
                dt = s.n.send();
            }
            htp(home(attr.link), dt).then(function (response) {
                console.log('response', response);
                s.n = angular.extend(s.n, response);
            });
        };

        s.n.load();




    }

    return {
        restrict: 'A',
        scope: {
            n: '=ngModel'
        },
        link: link
    };
});

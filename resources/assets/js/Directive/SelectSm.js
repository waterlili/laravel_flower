app.directive('useSelectSm', function (htp) {
    function link(s, elem, attr) {
        $(elem).dropdown({
            onChange: function (value, text, choise) {
                s.n = value;
                s.$apply();
            }
        });
        if (s.n) {
            $(elem).dropdown('set selected', s.n);
        }
    }

    return {
        restrict: 'A',
        scope: {
            n: '=ngModel'
        },
        link: link
    };
});

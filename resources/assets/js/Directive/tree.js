app.directive('groupCollection', function () {
    return {
        restrict: "E",
        replace: true,
        scope: {
            collection: '=',
            url: '='
        },
        template: "<div class='inner collection group'><group-member ng-repeat='member in collection' member='member' url='url'></group-member></div>"
    }
});

app.directive('groupMember', function ($compile) {
    return {
        restrict: "E",
        replace: true,
        scope: {
            member: '=',
            url: '='
        },
        templateUrl: function (element, attr) {
            return home('console/group-collection');
        },
        link: function (scope, element, attrs) {
            if (angular.isObject(scope.member.child)) {
                var tmp = "<group-collection collection='member.child' class='collection'></group-collection>";
                var $content = $compile(tmp)(scope);
                element.append($content);
            }
        }
    }
});
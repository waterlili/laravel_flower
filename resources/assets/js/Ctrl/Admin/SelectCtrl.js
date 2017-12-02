app.controller('JobController', function ($element, $timeout, htp, $q, $log, $scope) {
    // app.module('autocompleteCustomTemplateDemo', ['ngMaterial']);
    var self = this;

    self.data = {};
    self.detail = [];


    self.simulateQuery = false;
    self.isDisabled = false;

    self.repos = loadAll();
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;

    // ******************************
    // Internal methods
    // ******************************

    /**
     * Search for repos... use $timeout to simulate
     * remote dataservice call.
     */




    function querySearch(query) {

        htp(home('console/manage/get-const'), {w: 6}).then(function (response) {

            if (response && response.result == true) {
                self.detail = response;


            }

        });

        var results = query ? self.detail.data.filter(createFilterFor(query)) : self.detail.data,
            deferred;
        if (self.simulateQuery) {
            deferred = $q.defer();
            $timeout(function () {
                deferred.resolve(results);
            }, Math.random() * 1000, false);
            return deferred.promise;
        } else {
            return results;
        }


    }

    self.txt = [];

    function searchTextChange(text) {
        // $log.info('Text changed to ' + text);

        self.txt.push(text);
        self.one = self.txt[self.txt.length - 1]
        $scope.$emit('child1', self.one);
    }

    function selectedItemChange(item) {
        // $log.info('Item changed to ' + JSON.stringify(item));
        $scope.$emit('child1', {'txt': item});

    }

    /**
     * Build `components` list of key/value pairs
     */

    function loadAll() {
        htp(home('console/manage/get-const'), {w: 6}).then(function (response) {
            if (response && response.result == true) {
                self.detail = response;


            }
            var repos = self.detail.data;
            return repos.map(function (repo) {
                repo.value = repo.title.toLowerCase();
                return repo;
            });

        });

    }

    /**
     * Create filter function for a query string
     */
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);

        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };

    }


});
app.controller('SkillCtrl', function ($scope, $element, $timeout, htp, $q, $log) {
    // app.module('autocompleteCustomTemplateDemo', ['ngMaterial']);
    var self = this;

    angular.module('firstApplication', ['ngMaterial']);
    self.data = {};
    self.detail1 = [];


    self.simulateQuery = false;
    self.isDisabled = false;

    self.repos = loadAll();
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;

    // ******************************
    // Internal methods
    // ******************************

    /**
     * Search for repos... use $timeout to simulate
     * remote dataservice call.
     */




    function querySearch(query) {

        htp(home('console/manage/get-const'), {w: 8}).then(function (response) {

            if (response && response.result == true) {
                self.detail1 = [];
                self.detail1 = response;

            }
        });

        var results = query ? self.detail1.data.filter(createFilterFor(query)) : self.detail1.data,
            deferred;
        if (self.simulateQuery) {
            deferred = $q.defer();
            $timeout(function () {
                deferred.resolve(results);
            }, Math.random() * 1000, false);
            return deferred.promise;
        } else {
            return results;
        }


    }

    self.txt = [];

    function searchTextChange(text) {
        // $log.info('Text changed to ' + text);

        self.txt.push(text);
        self.one = self.txt[self.txt.length - 1]


        $scope.$emit('child2', self.one);
    }


    function selectedItemChange(item) {
        // $log.info('Item changed to ' + JSON.stringify(item));
        $scope.$emit('child2', {'txt1': item});
    }

    /**
     * Build `components` list of key/value pairs
     */

    function loadAll() {
        htp(home('console/manage/get-const'), {w: 8}).then(function (response) {
            if (response && response.result == true) {
                self.detail1 = response;

            }
            var repos = self.detail1.data;
            return repos.map(function (repo) {
                repo.value = repo.title.toLowerCase();
                return repo;
            });

        });

    }

    /**
     * Create filter function for a query string
     */
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);

        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };

    }

});
app.controller('AttractionCtrl', function ($scope, $element, $timeout, htp, $q, $log) {
    // app.module('autocompleteCustomTemplateDemo', ['ngMaterial']);
    var self = this;

    self.data = {};
    self.detail2 = [];


    self.simulateQuery = false;
    self.isDisabled = false;

    self.repos = loadAll();
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;

    // ******************************
    // Internal methods
    // ******************************

    /**
     * Search for repos... use $timeout to simulate
     * remote dataservice call.
     */




    function querySearch(query) {

        htp(home('console/manage/get-const'), {w: 7}).then(function (response) {

            if (response && response.result == true) {
                self.detail2 = response;

            }
        });

        var results = query ? self.detail2.data.filter(createFilterFor(query)) : self.detail2.data,
            deferred;
        if (self.simulateQuery) {
            deferred = $q.defer();
            $timeout(function () {
                deferred.resolve(results);
            }, Math.random() * 1000, false);
            return deferred.promise;
        } else {
            return results;
        }


    }

    self.txt = [];

    function searchTextChange(text) {
        // $log.info('Text changed to ' + text);

        self.txt.push(text);
        self.one = self.txt[self.txt.length - 1]


        $scope.$emit('child3', self.one);
    }

    function selectedItemChange(item) {
        // $log.info('Item changed to ' + JSON.stringify(item));
        $scope.$emit('child3', {'txt2': item});
    }

    /**
     * Build `components` list of key/value pairs
     */

    function loadAll() {
        htp(home('console/manage/get-const'), {w: 7}).then(function (response) {
            if (response && response.result == true) {
                self.detail2 = response;

            }
            var repos = self.detail2.data;
            return repos.map(function (repo) {
                repo.value = repo.title.toLowerCase();
                return repo;
            });

        });

    }

    /**
     * Create filter function for a query string
     */
    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);

        return function filterFn(item) {
            return (item.value.indexOf(lowercaseQuery) === 0);
        };

    }

});


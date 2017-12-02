app.controller('OrderReportCtrl', function ($scope, htp) {
    var _this = $scope;
    var REPORT = function (url) {
        this.url = url;
        this.date = undefined;
        var that = this;
        if (!this.chart) {
            this.chart = {};
        }
        this.load = function () {
            this.loading = true;
            htp(home(this.url), {date: this.date}).then(function (res) {
                that.dt = res.dt;
                that.date = res.date;
                that.chart.load();
            }).error(function (res, sts) {
                if (sts == 422) {
                    that.errorItem = res;
                }
            }).after(function () {
                that.loading = false;
            });
        };
        this.chart.send = function () {
            return angular.extend(that.dt, {date: that.date});
        };
        this.load();
    };
    _this.day = new REPORT('console/order/get-day-report-data');
    _this.week = new REPORT('console/order/get-week-report-data');
    _this.month = new REPORT('console/order/get-month-report-data');

    _this.week.chart.options =
    {
        scales: {
            yAxes: [{
                stacked: true,
                ticks: {
                    stepSize: 1
                }
            }]
        }
    };

    _this.month.chart.options =
    {
        scales: {
            yAxes: [{
                stacked: true,
                ticks: {
                    stepSize: 1
                }
            }]
        }
    };

});
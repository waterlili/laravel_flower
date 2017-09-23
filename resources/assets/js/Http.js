app.factory('htp', function ($http, notify) {
    var _Htp = function (url, data) {
        this.options = {};
        this.afterSuccess = [];
        var that = this;
        $http.post(url, data)
            .success(function (response) {
                if (that.options.then) {
                    that.options.then.call(this, response);
                }

                if (that.options.after) {
                    that.options.after.call(this, response);
                }
                _.each(that.afterSuccess, function (item) {
                    item.call(that, response);
                });
            })
            .error(function (response, sts) {
                if (that.options.after) {
                    that.options.after.call(this, response, sts);
                }
                if (that.options.error) {
                    that.options.error.call(this, response, sts);
                }
                switch (sts) {
                    case 422:
                        if (that.errorItem) {
                            that.errorItem.call(this, response);
                        }
                        notify('error', trans('message.422'));
                        break;
                }
            });
    };


    _Htp.prototype.then = function (fn) {
        this.options.then = fn;
        return this;
    };

    _Htp.prototype.after = function (fn) {
        this.options.after = fn;
        return this;
    };

    _Htp.prototype.error = function (fn) {
        this.options.error = fn;
        return this;
    };

    _Htp.prototype.errorNotice = function (fn) {
        this.errorItem = fn;
        return this;
    };

    _Htp.prototype.saveSend = function (title) {
        this.afterSuccess.push(function () {
            notify('info', trans('message.set_record', {attr: title}))
        });
        return this;
    };


    return function (url, data) {
        return new _Htp(url, data);
    };
});
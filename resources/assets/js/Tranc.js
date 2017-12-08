'use strict';
function deepFind(obj, path) {
    var paths = path.split('.')
        , current = obj
        , i;

    for (i = 0; i < paths.length; ++i) {
        if (current[paths[i]] == undefined) {
            return undefined;
        } else {
            current = current[paths[i]];
        }
    }
    return current;
}

function trans(where, attr) {
    var _tmp = deepFind(_trans_en, where);
    if (!_tmp) {
        return where;
    }
    for (var i in attr) {
        _tmp = _tmp.replace(':' + i, attr[i]);
    }

    return _tmp;
}

var _trans = {
    'message': {
        'title_delete': 'آیا مطمئن به حذف رکورد مورد نظر هستید؟',
        'content_delete': 'عنوان رکورد مورد نظر برای حذف :attr می باشد',
        'set_record': 'اطلاعات :attr با موفقیت در سامانه به ثبت رسید',
        'unset_record': 'متاسفانه در روند ذخیره سازی :attr مشکلی پیش آمده',
        'delete_record': ':attr مورد نظر با موفقیت حذف گردید.',
        'time_set': 'زمان فاکتور مورد نظر با موفقیت به ثبت رسید',
        'time_set_error': 'در روند ذخیره سازی زمان مورد نظر مشکلی پیش آمد.',
        'delete_record_error': 'متاسفانه در روند حذف :attr مورد نظر مشکلی رخ داده است.  لطفا مجددا تلاش کنید و یا با مدیر سامانه مشکل را اطلاع دهید.',
    }
};


var _trans_en = {
    'message': {
        'title_delete': 'آیا مطمئن به حذف رکورد مورد نظر هستید؟',
        'content_delete': 'عنوان رکورد مورد نظر برای حذف :attr می باشد',
        'desc_delete': 'درصورتی که رکورد مورد نظر حذف شود اطلاعات برگشت پذیر نخواهد بود.',
        'set_record': 'اطلاعات :attr با موفقیت در سامانه به ثبت رسید',
        'unset_record': 'Sorry! During Setting :attr has problem',
        'delete_record': ':attr مورد نظر با موفقیت حذف گردید.',
        'time_set': 'زمان فاکتور مورد نظر با موفقیت به ثبت رسید',
        'time_set_error': 'در روند ذخیره سازی زمان مورد نظر مشکلی پیش آمد.',
        'delete_record_error': 'متاسفانه در روند حذف :attr مورد نظر مشکلی رخ داده است.  لطفا مجددا تلاش کنید و یا با مدیر سامانه مشکل را اطلاع دهید.',
        'not_found_state': 'صفحه درخواستی وجود ندارد',
        'error_state': 'متاسفیم! برای سیستم یک خطای غیر منتظره بوجود آمده است . لطفا با مدیر سامانه این موضوع را در میان بگذارید.',
        'error_public_state': 'متاسفیم! سیستم یک خطای غیر منتظره دارد.',
    },
    'page_title': {
        'consoleprofilesettings': 'پروفایل کاربری',
        'consolemanageusers': 'مدیریت کاربران',
        'consolemanageroles': 'قوانین دسترسی',
        'consolemanageconst': 'مدیریت ثابت ها',
        'consolemanagelog': 'رویداد های سیستمی',
        'consoleproductlist': 'محصولات',
        'consoleproductadd': 'افزودن محصول',
        'consoleflowerslist': 'گلها',
        'consoleflowersvaselist': 'گلدان ها',
        'consoleorderadd': 'افزودن سفارش',
        'consoleorderlistlist': 'سفارش ها',
        'consoleorderlistunverified': 'سفارش های تایید نشده',
        'consoleorderreport': 'گزارش سفارش',
        'consolecustomerlist': 'مشتریان',
        'consolecustomeradd': 'افزودن مشتری',
        'consolecustomergroup': 'گروه بندی مشتری',
        'consolecost': 'هزینه های جاری',
        'consolefloweradd': 'افزودن گل جدید',
        'consoleflower_vaseadd': 'افزودن گلدان جدید',
        'consoleflower_vaselist': 'لیست گلدان ها',
        'consoleflowerlist': 'لیست گل ها',
        'consoleflower_packageadd': 'افزودن ترکیب گل جدید',
        'consoleflower_packagelist': 'لیست ترکیب گل ها',
        'consoleflower_packetadd': 'افزودن بسته جدید',
        'consoleflower_packetlist': 'لیست بسته ها',
        'consoleorderdaily-generation': 'گزارش تولید روزانه',
        'consoleorderdaily-orders': 'لیست سفارشات ارسالی روز',

    },
    'subject': {
        'page': 'Page'
    },
    'w': {
        'yes': 'بلی',
        'cancel': 'انصراف',
    }
};

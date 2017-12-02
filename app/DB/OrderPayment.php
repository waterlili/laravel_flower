<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\jDate;

class OrderPayment extends Model
{
    protected $table = 'order_payments';
    public $timestamps = TRUE;

    use SoftDeletes;
    public static $SELECT_STS_STR = 'sts as sts_str';
    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'type',
        'refID',
        'price',
        'bank',
        'issue_tracking',
        'sts',


    );
    public static $StsStr = [
        '-2' => 'لغو سفارش',
        '-1' => 'پرداخت نشده',
        1 => 'پرداخت شده',
    ];

    public function scopePaid($q)
    {
        return $q->where(function ($q) {
            return $q->whereSts(1);
        });
    }

    public function scopeUnpaid($q)
    {
        return $q->where(function ($q) {
            return $q->whereSts(-1);
        });
    }

    public function getStsStrAttribute($value)
    {
        return array_get(self::$StsStr, $value, '');
    }

    public function getSubmitStrAttribute($value)
    {
        return array_get(self::$StsSubmit, $value, '');
    }
}

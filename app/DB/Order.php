<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\jDate;
use App\DB\OrderPacket;

class Order extends Model {

    protected $table = 'orders';
  public $timestamps = TRUE;


  use SoftDeletes;

  public static $SELECT_TYPE_STR = 'type as type_str';
  public static $SELECT_CLOSEAT_J = 'closed_at as closed_at_j';
  public static $SELECT_AUTOMATE_STR = 'automate as automate_str';
    public static $SELECT_DAY_STR = 'daysOfWeek as week_str';
    public static $SELECT_TIME_STR = 'time_duration as time_str';
    public static $SELECT_Dur_STR = 'time_duration as duration_str';
    public static $SELECT_FIRST_J = 'started_at as first_j';
    public static $SELECT_Vase_str = 'vid as vase_str';
    public static $SELECT_Type_str = 'type as type_str';
    public static $SELECT_Type2_str = 'type2 as type2_str';




    protected $dates = ['deleted_at'];


    protected $fillable = array(
      'cid',
      'number',
      'vid',
      'type',
      'type2',
      'amount',
      'time_duration',
      'daysOfWeek',
      'sending',
      'month',
      'sending_name',
      'sending_mobile',
      'sending_address',
      'sts',
      'sent_count',
      'started_at',
      'expired_at'


  );

    protected static function GetMonths()
    {
        return [
            1 => 'یک ماهه',
            2 => 'دو ماهه',
            3 => 'سه ماهه',
            4 => 'چهار ماهه',
        ];
    }

  public static $NORMAL_TYPE = 1;

  public static function GetDays() {
    return [
      1 => 'شنبه',
      2 => 'یکشنبه',
      3 => 'دوشنبه',
      4 => 'سه شنبه',
      5 => 'چهارشنبه',
      6 => 'پنج شنبه',
      7 => 'جمعه',
    ];
  }

  public static function GetWhen() {
    return [
      1 => 'صبح',
      2 => 'عصر',
    ];
  }

    public static function GetTime()
    {
        return [
            1 => '9-12',
            2 => '12-15',
            3 => '15-18',
            4 => '18-21'
        ];
    }

  public static function GetType() {
    return [
      1 => 'نوع اول',
      2 => 'نوع دوم',
    ];
  }

    public static $TYPE = [
        1 => 'اشتراکی',
        2 => 'هدیه',
    ];
    public static $TYPE2 = [
        1 => 'بسته',
        2 => 'گل',
    ];


    public static $PayType = [
//        1 => 'ارسال لینک پرداخت به ایمیل',
//      2 => 'دریافت نقدی',
//    3 => 'واریز بانکی',
        3 => 'ارسال لینک پرداخت با پیامک',
//      4 => 'کارت به کارت',
        5 => 'عدم پرداخت',
  ];

  public static $StsSubmit = [
    '-1' => 'تحویل داده نشده',
    1 => 'تحویل داده شده',
  ];


  public function users() {
    return $this->belongsTo('App\DB\User', 'uid');
  }
  protected function _get_from_user($col) {
    return $this->belongsTo('App\DB\User', $col)->select([
      'id',
      DB::raw("CONCAT(fname , ' ' ,lname) as name")
    ]);
  }

  protected function _get_from_user_for_ac($col) {
    return $this->belongsTo('App\DB\User', $col)->select([
      'id',
      DB::raw("CONCAT(fname , ' ' ,lname) as value")
    ]);
  }


  public function scopeDate($query, $col, $date) {
    if (is_array($date)) {
      return $query->whereBetween($col, $date);
    }
    else {
      return $query->whereDate($col, '=', $date);
    }
  }

  public function sender() {
    return $this->belongsTo('App\DB\User', 'sender');
  }

    public function customer()
    {
        return $this->belongsTo('App\DB\Customer', 'cid')->select(['id', 'fname', 'lname', 'address', 'mobile', 'description']);
    }

    public function user()
    {
        return $this->belongsTo('App\DB\User', 'uid')->select(['id', 'lname']);
  }

  public function sender_name() {
    return $this->_get_from_user('sender');
  }

  public function visitor_name() {
    return $this->_get_from_user('visitor');
  }

  public function creator_name() {
    return $this->_get_from_user('creator');
  }

  public function visitor() {
    return $this->belongsTo('App\DB\User', 'visitor');
  }

  public function creator() {
    return $this->belongsTo('App\DB\User', 'creator');
  }

    public function getTimeStrAttribute($value)
    {
    return array_get(self::GetWhen(), $value, 'تعریف نشده');
  }

    public function getDurationStrAttribute($value)
    {
        return array_get(self::GetTime(), $value, 'تعریف نشده');
    }

    public function getVaseStrAttribute($value)
    {
        if (is_null($value)) {
            return 'ندارد';
        } else {

            return 'دارد';
        }
    }

    public function getWeekStrAttribute($value)
    {
    if (is_null($value)) {
      return NULL;
    }
    return array_get(self::GetDays(), $value, 'تعریف نشده');
  }

    public function getFirstDateAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        } else {
            $date = explode(" ", $value);
            return $date[0];
        }
    }
    public function getStartedAtAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        } else {
            $date = explode(" ", $value);
            return $date[0];
        }
    }


    public function getMonthStrAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        }
        return array_get(self::GetMonths(), $value, 'تعریف نشده');
    }

  public function getTypeStrAttribute($value) {
      return array_get(self::$TYPE, $value, 'تعریف نشده');
  }

    public function getType2StrAttribute($value)
    {
        return array_get(self::$TYPE2, $value, 'تعریف نشده');
  }

  public function getClosedAtJAttribute($value) {
    return self::convertDate($value);
  }

  public function getSendAtJAttribute($value) {
    return self::convertDate($value);
  }


  public function uid_ac() {
    return $this->_get_from_user_for_ac('uid');
  }

  public function sender_ac() {
    return $this->_get_from_user_for_ac('sender');
  }

  public function visitor_ac() {
    return $this->_get_from_user_for_ac('visitor');
  }

  public function getAutomateStrAttribute($value) {
    return ($value == 1) ? 'بلی' : 'خیر';
  }


    public function getFirstAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        }
        if (!is_string($value)) {
            return $value;
        } else {
            return jDate::forge($value)->format('Y/m/d');
        }

    }

    public static function GetPrc()
    {
        return Order::select(['id', 'amount'])->get()->toArray();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->select(['*', 'period as duration_str']);
    }
    public function orderPayment()
    {
        return $this->hasOne(OrderPayment::class, 'oid')->select(['*', 'sts as sts_str']);
    }


}
<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model {

  protected $table = 'order';
  public $timestamps = TRUE;

  use SoftDeletes;

  public static $SELECT_TYPE_STR = 'type as type_str';
  public static $SELECT_CLOSEAT_J = 'closed_at as closed_at_j';
  public static $SELECT_STS_STR = 'sts as sts_str';
  public static $SELECT_AUTOMATE_STR = 'automate as automate_str';
  public static $SELECT_DAY_STR = 'day as day_str';
  public static $SELECT_WHEN_STR = 'when as when_str';
  public static $SELECT_SEND_AT_J = 'send_at as send_at_j';


  protected $dates = ['deleted_at'];
  protected $fillable = array(
    'type',
    'when',
    'day',
    'uid',
    'price',
    'total_product',
    'automate',
    'creator',
    'closed_at',
    'closed',
    'submit',
    'sender',
    'send_at',
    'pay_number',
    'visitor',
    'sts',
    'feedback',
    'description'
  );

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

  public static function GetType() {
    return [
      1 => 'نوع اول',
      2 => 'نوع دوم',
    ];
  }

  public static $StsStr = [
    '-2' => 'لغو سفارش',
    '-1' => 'پرداخت نشده',
    1 => 'پرداخت شده',
  ];

  public static $PayType = [
    1 => 'نقدی',
    2 => 'اینترنتی',
    3 => 'واریز به حساب',
    4 => 'پوز',
  ];

  public static $StsSubmit = [
    '-1' => 'تحویل داده نشده',
    1 => 'تحویل داده شده',
  ];


  public function users() {
    return $this->belongsTo('App\DB\User', 'uid');
  }


  public function scopePaid($q) {
    return $q->where(function ($q) {
      return $q->whereSts(1);
    });
  }

  public function scopeUnpaid($q) {
    return $q->where(function ($q) {
      return $q->whereSts(-1);
    });
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

  public function user_name() {
    return $this->_get_from_user('uid');
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

  public function getWhenStrAttribute($value) {
    return array_get(self::GetWhen(), $value, 'تعریف نشده');
  }

  public function getDayStrAttribute($value) {
    if (is_null($value)) {
      return NULL;
    }
    return array_get(self::GetDays(), $value, 'تعریف نشده');
  }

  public function getTypeStrAttribute($value) {
    return array_get(self::GetType(), $value, 'تعریف نشده');
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

  public function getStsStrAttribute($value) {
    return array_get(self::$StsStr, $value, '');
  }

  public function getSubmitStrAttribute($value) {
    return array_get(self::$StsSubmit, $value, '');
  }

  public function getAutomateStrAttribute($value) {
    return ($value == 1) ? 'بلی' : 'خیر';
  }

}
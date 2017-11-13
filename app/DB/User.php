<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Morilog\Jalali\jDate;

class User extends Authenticatable {

  use SoftDeletes;
  protected $table = 'users';
  public $timestamps = TRUE;
  protected $dates = ['deleted_at'];
  protected $guarded = array('password');
  protected $fillable = array(
    'fname',
    'lname',
    'email',
    'type',
    'username',
    'last_login',
    'active',
    'gender',
      'rememberToken',
    'personal_picture',
    'sts'
  );


  public static $SELECT__CUS_TYPE_STR = 'type as cus_type_str';
  public static $SELECT__ACTIVE_STR = 'active as active_atr';
  public static $SELECT__STS_STR = 'sts as sts_str';
  public static $SELECT__GENDER_STR = 'gender as gender_str';

  public static $TYPES = [
    1 => 'مدیر',
    2 => 'بازاریاب',
    3 => 'تحویل دهنده',
  ];


  public static $Gender = [
    1 => 'آقا',
    2 => 'خانم',
  ];


  public static $JOBTYPES = [
    1 => 'دکتر',
    2 => 'وکیل',
    3 => 'دفتر مهندسی',
    4 => 'دفتر اسناد رسمی',
    5 => 'آژانس',
    6 => 'دفتر بیمه',
  ];


  public static $STATUS = [
    1 => 'فعال',
    -1 => 'غیر فعال'
  ];


  public function scopeCustomer($query) {
    return $query->where('type', '>', 9);
  }

  public function scopeEmployer($query) {
    return $query->where(function ($q) {
      return $q->where('type', '<', 4);
    });
  }

  public static function CUSTOMER_TYPE() {
    return array_pluck(Cnt::usertype()->get()->toArray(), 'title', 'id');
  }

  public function scopeSender($query) {
    return $query->where('type', 3);
  }

  public function scopeVisitor($query) {
    return $query->where('type', 2);
  }

  public function user_info() {
    return $this->hasOne('App\DB\UserInfo', 'uid')->select([
      '*',
      'job_type as job_type_str',
      'att_type as att_type_str',
    ]);
  }

  public function getStsStrAttribute($value) {
      if (is_null($value)) {
          return NULL;
      }
    return array_get(User::$STATUS, $value, 'تعریف نشده');
  }

  public function getCusTypeStrAttribute($value) {
      if (is_null($value)) {
          return NULL;
      }
    return array_get(self::CUSTOMER_TYPE(), $value, 'تعریف نشده');
  }

  public function getTypeStrAttribute($value) {
      if (is_null($value)) {
          return NULL;
      }
    return array_get(User::$TYPES, $value, 'تعریف نشده');
  }

  public function getGenderStrAttribute($value) {
    if (is_null($value)) {
      return NULL;
    }
    return array_get(User::$Gender, $value, 'تعریف نشده');
  }

  public function getActiveStrAttribute($value) {
    return ($value == 1) ? 'بلی' : 'خیر';
  }


  public function getCreatedAtJAttribute($value) {
    return $this->convertDate($value);
  }

  public function getUpdatedAtJAttribute($value) {
    return $this->convertDate($value);
  }

  protected function convertDate($value, $format = NULL) {
    if (is_null($value)) {
      return NULL;
    }
    if (is_null($format)) {
      $format = Model::$formatJ;
    }
    return jDate::forge($value)->format($format, TRUE);
  }

  public function getActiveAttribute($value) {
    if ($value == '1') {
      return TRUE;
    }
    return $value;
  }
}
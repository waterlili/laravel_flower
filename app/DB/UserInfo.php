<?php

namespace App\DB;

class UserInfo extends Model {

  protected $table = 'user_info';
  public $timestamps = TRUE;
  protected $fillable = array(
    'uid',
    'job',
    'job_type',
    'skill',
    'address',
    'address2',
    'zip_code',
    'phone',
    'mobile',
    'sts',
    'att_type',
    'attraction',
    'description',
    'softDeletes'
  );


  public static $SELECT_JOB_TYPE_STR = 'job_type as job_type_str';
  public static $SELECT_ATT_TYPE_STR = 'att_type as att_type_str';


  public static $ATTTYPE = [
    1 => "بازاریاب",
    2 => "معرفی",
    3 => "تبلیغات"
  ];

  public function getJobTypeStrAttribute($value) {
    if (is_null($value)) {
      return NULL;
    }
    return array_get(User::$JOBTYPES, $value, 'تعریف نشده');
  }

  public function getAttTypeStrAttribute($value) {
    if (is_null($value)) {
      return NULL;
    }
    return array_get(self::$ATTTYPE, $value, 'تعریف نشده');
  }
}
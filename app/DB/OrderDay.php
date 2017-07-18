<?php

namespace App\DB;

use Morilog\Jalali\jDate;

class OrderDay extends Model {
  protected $table = 'order_day';
  protected $fillable = [
    'oid',
    'cid',
    'when',
    'count',
    'w',
    'sts',
    'type',
    'prc',
    'total'
  ];

  public function customer() {
    return $this->belongsTo('App\DB\Customer', 'cid');
  }

  public function order() {
    return $this->belongsTo('App\DB\Product', 'oid');
  }

  public function product() {
    return $this->belongsTo('App\DB\Product', 'prc');
  }


  public function getTypeStrAttribute($value) {
    if (is_null($value)) {
      return $value;
    }
    return array_get(Order::$TypeStr, $value, '');
  }


  public function getWhenStrAttribute($value) {
    if (is_null($value)) {
      return $value;
    }
    return jDate::forge($value)->format('Y/m/d');
  }

  public function getWhenDayAttribute($value) {
    if (is_null($value)) {
      return $value;
    }
    return jDate::forge($value)->format('l');
  }

  public function getStsStrAttribute($value) {
    if (is_null($value)) {
      return $value;
    }

    return array_get(Order::$StsStr, $value, '');
  }
}

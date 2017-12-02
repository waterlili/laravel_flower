<?php

namespace App\DB;


use Illuminate\Support\Facades\DB;

class Cost extends Model {
  protected $table = 'cost';
  public $fillable = [
    'title',
    'paraph',
    'description',
    'price',
    'type',
    'uid',
    'reviewer',
    'parent',
    'sts',
  ];


  public static function getStsStr() {
    return [
      -1 => 'بدون بازبینی',
      2 => 'بازبینی شده'
    ];
  }

  public static function getTypes() {
    $select = Cnt::cost()->get()->toArray();
    return array_pluck($select, 'title', 'title');
  }


  public function user_full_name() {
    return $this->belongsTo('App\DB\User', 'uid')->select([
      'id',
      DB::raw('CONCAT(fname , " " , lname) as name')
    ]);
  }

  public function user() {
    return $this->belongsTo('App\DB\User', 'uid');
  }

  public function reviewer_full_name() {
    return $this->belongsTo('App\DB\User', 'reviewer')->select([
      'id',
      DB::raw('CONCAT(fname , " " , lname) as name')
    ]);
  }

  public function reviewer() {
    return $this->belongsTo('App\DB\User', 'reviewer');
  }


  public function getStsStrAttribute($value) {
    return array_get(self::getStsStr(), $value, 'تعریف نشده');
  }
}

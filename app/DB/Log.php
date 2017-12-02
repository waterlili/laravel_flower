<?php

namespace App\DB;


use Illuminate\Support\Facades\DB;

class Log extends Model {

  protected $table = 'log';
  public $timestamps = TRUE;


  protected $fillable = [
    'uid',
    'type',
    'message',
    'data',
    'severity',
    'hostname',
    'location',
  ];


  public static function getTypes() {
    return [
      1 => "کاربری",
      2 => "سیستمی",
      3 => "محاوره ای",
    ];
  }

  public function getTypeStrAttribute($value) {
    return array_get(self::getTypes(), $value, 'تعریف نشده');
  }

  public function user_full_name() {
    return $this->belongsTo('App\DB\User', 'uid')->select([
      'id',
      DB::raw('CONCAT(fname ,  " " , lname) as name')
    ]);
  }
}
<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cnt extends Model {
  use SoftDeletes;
  protected $table = 'const';
  public $timestamps = FALSE;
  protected $fillable = [
    'title',
    'w'
  ];

  public static $FLOWER = 1;
  public static $PACK = 2;
  public static $COST = 3;
  public static $USERTYPE = 4;


  public function scopeFlower($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$FLOWER);
    });
  }

  public function scopePack($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$PACK);
    });
  }

  public function scopeCost($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$COST);
    });
  }

  public function scopeUsertype($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$USERTYPE);
    });
  }
  
  
}

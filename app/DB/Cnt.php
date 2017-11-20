<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cnt extends Model {
  use SoftDeletes;
    protected $table = 'consts';
  public $timestamps = FALSE;
  protected $fillable = [
    'title',
    'w'
  ];

  public static $FLOWER = 1;
  public static $PACK = 2;
  public static $COST = 3;
  public static $USERTYPE = 4;
    public static $COLOR = 5;



  public function scopeFlower($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$FLOWER);
    });
  }

    public function scopeColor($q)
    {
        return $q->where('w', self::$COLOR);
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

    public function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
  
}

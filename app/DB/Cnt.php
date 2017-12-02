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
    public static $JOB = 6;
    public static $ATR = 7;
    public static $SKILL = 8;



  public function scopeFlower($q) {
    return $q->where(function ($query) {
      $query->where('w', self::$FLOWER);
    });
  }

    public function scopeJob($q)
    {
        return $q->where(function ($query) {
            $query->where('w', self::$JOB);
        });
    }

    public function scopeAttraction($q)
    {
        return $q->where(function ($query) {
            $query->where('w', self::$ATR);
        });
    }

    public function scopeSkill($q)
    {
        return $q->where(function ($query) {
            $query->where('w', self::$SKILL);
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

    public static function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function barcodeNumberExists($number)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Order::where('number', $number)->first();
    }

    public static function random_number($type)
    {
        if (!empty($type) && $type == 'order') {
            $code = $six_digit_random_number = mt_rand(10000000, 99999999);
            $number = 'BNT-' . $code;
            // call the same function if the barcode exists already
            if (self::barcodeNumberExists($number)) {
                return self::order_number();
            }
        } else {
            $number = $six_digit_random_number = mt_rand(100000, 999999);

        }


        // otherwise, it's valid and can be used
        return $number;
    }


  
}

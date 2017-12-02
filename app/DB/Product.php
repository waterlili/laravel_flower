<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model {

  protected $table = 'product';
  public $timestamps = TRUE;

  use SoftDeletes;

  protected $dates = ['deleted_at'];
  protected $fillable = array(
    'price',
    'pack_type',
    'title',
    'description',
    'code',
    'body',
    'price',
    'is_active',
    'thumb',
    'sales',
    'sts',
    'uid'
  );


  public static $SELECT_IS_ACTIVE_STR = 'is_active as is_active_str';
  public static $SELECT_PACK_TYPE_STR = 'pack_type as pack_type_str';


  public static $STS_STR = [
    1 => 'موجود',
    -1 => 'ناموجود'
  ];

  public static function PACK_TYPE() {
    return config('pack_type');
  }

  public function getIsActiveStrAttribute($value) {
    return ($value == 1) ? 'بلی' : 'خیر';
  }


  public function getPackTypeStrAttribute($value) {
    return array_get(config('pack_type'), $value, 'تعریف نشده');
  }

  public function getStsStrAttribute($value) {
    return array_get(self::$STS_STR, $value, 'تعریف نشده');
  }


  public function users() {
    return $this->belongsTo('App\DB\User', 'uid')->select([
      '*',
      DB::raw('CONCAT(fname , " " , lname) as name')
    ]);
  }


    public function scopeActive($qurey)
    {
        return $qurey->where('is_active', 1);
    }

    public static function GetPrc()
    {
        return Product::active()->select(['id', 'title', 'price'])->get()->toArray();
    }
}
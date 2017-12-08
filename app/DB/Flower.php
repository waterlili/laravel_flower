<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Flower extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flowers';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'name',
        'nemad',
        'vahed',
        'price',
        'rade',
        'has_boo',
        'saghe',
        'mandegari'
    );

    public static $SELECT_VAHED_STR = 'vahed as vahed_str';
    public static $SELECT_SAGHE_STR = 'saghe as saghe_str';
    public static $SELECT_MANDEGARI_STR = 'mandegari as mandegari_str';
    public static $SELECT_RADE_STR = 'rade as rade_str';

    public function getVahedStrAttribute($value) {
        return ($value == 'shakhe') ? 'شاخه' : 'دسته';
    }

    public function items()
    {
        return $this->morphMany('App\DB\OrderItem', 'itemable');
    }
    public function getSagheStrAttribute($value) {
        if($value == 'kootah')
            return "کوتاه";
        if($value == 'motvaset')
            return "متوسط";
        if($value == 'boland')
            return "بلند";
    }

    public function getMandegariStrAttribute($value) {
        if($value == 'kam')
            return "کم";
        if($value == 'motvaset')
            return "متوسط";
        if($value == 'ziad')
            return "زیاد";
    }

    public function getRadeStrAttribute($value) {
        if($value == 'arzan')
            return "ارزان";
        if($value == 'geran')
            return "گران";
    }

    public static function vahed()
    {
        return [
            'daste'  => 'دسته',
            'shakhe' => 'شاخه'
        ];
    }

    public static function radeGheimati()
    {
        return [
            'arzan' => 'ارزان',
            'geran' => 'گران'
        ];
    }

    public static function saghe()
    {
        return [
            'kootah'   => 'کوتاه',
            'motvaset' => 'متوسط',
            'boland'   => 'بلند'
        ];
    }

    public static function has_or_not()
    {
        return [
            '0'   => 'ندارد',
            '1' => 'دارد',
        ];
    }

    public static function mandegari()
    {
        return [
            'kam'      => 'کم',
            'motvaset' => 'متوسط',
            'ziad'     => 'زیاد'
        ];
    }

    public function variations()
    {
        return $this->hasMany(FlowerVariation::class);
    }

    public static function GetFlw()
    {
        return Flower::select(['id', 'name', 'price'])->get()->toArray();
    }

}
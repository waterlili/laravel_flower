<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class FlowerVase extends Model
{
    protected $fillable = [
        'title',
        'material',
        'weight',
        'size',
        'quality',
        'capacity',
        'color_id',
        'images',
        'price'
    ];
    public static $SIZE = [
        1 => 'کوچک',
        2 => 'متوسط',
        3 => 'بزرگ'
    ];
    public static $QUALITY = [
        1 => 'بالا',
        2 => 'متوسط',
        3 => 'پایین'
    ];
}

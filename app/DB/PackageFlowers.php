<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class PackageFlowers extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_packages';

    public static $SELECT_LEAF_STR = 'has_leaf as leaf_str';

    protected $fillable = array(
        'name',
        'has_leaf',
    );

    public static function flowers()
    {
        $flowers = Flower::with('variations')->get();
        $flowers_array = [];
        foreach ($flowers as $flower) {
            foreach ($flower->variations as $variation) {
                $flowers_array[$variation->id] = $flower->name . ' - ' . $variation->color;
            }
        }
        return $flowers_array;
    }

    public function getLeafStrAttribute($value)
    {
        return ($value) ? 'دارد' : 'ندارد';
    }
}
<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class FlowerPackage extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_packages';

    public static $SELECT_LEAF_STR = 'has_leaf as leaf_str';

    protected $fillable = array(
        'name',
        'has_leaf',
        'combination_flowers',
    );


    public static function types(){
        return [
            'normal' => 'عادی',
            'luxury' => 'لاکچری',
            'managerial' => 'مدیریتی',
        ];
    }
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

    public function packets()
    {
        return $this->belongsToMany(FlowerPacket::class);
    }


    public function flower(){
        return $this->belongsToMany(Flower::class, 'package_flowers', 'package_id', 'flower_id')->withPivot('count');
    }

    public function getLeafStrAttribute($value)
    {
        return ($value) ? 'دارد' : 'ندارد';
    }

    public function getCombinationFlowersAttribute($value)
    {
        return unserialize($value);
    }
}
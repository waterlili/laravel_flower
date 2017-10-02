<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class FlowerPacket extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_packets';

    protected $fillable = array(
        'name',
        'type',
    );

    public static $SELECT_TYPE_STR = 'type as type_str';
    public function packages()
    {
        return $this->belongsToMany(FlowerPackage::class);
    }

}
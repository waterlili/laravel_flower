<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Packet extends Model
{

    public $timestamps = TRUE;
    protected $table = 'packets';

    protected $fillable = array(
        'name',
    );

    public function packages()
    {
        return $this->belongsToMany(FlowerPackage::class);
    }

}
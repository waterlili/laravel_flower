<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class FlowerPacket extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_packets';

    protected $fillable = ['title', 'price'];


    public function packages()
    {
        return $this->belongsToMany(FlowerPackage::class);
    }

    public static function GetPckt()
    {
        return FlowerPacket::select(['id', 'title', 'price'])->get()->toArray();
    }
}

<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class FlowerPacket extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_packets';
    protected $with = 'pkg_limit';

    protected $fillable = ['title', 'price'];

    public static function GetPckt()
    {
        return FlowerPacket::select(['id', 'title', 'price'])->get()->toArray();
    }

    public function flowerPackets()
    {
        return $this->hasMany(FlowerPacket::class, 'pck_type', 'id');
    }
    public function packages()
    {
        return $this->belongsToMany(FlowerPackage::class);
    }

    public function pkg_limit()
    {
        return $this->belongsToMany(FlowerPackage::class)->select('name');

    }

}


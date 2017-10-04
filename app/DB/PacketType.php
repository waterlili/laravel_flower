<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class PacketType extends Model
{
    protected $table = 'packet_types';
    public $timestamps = FALSE;
    protected $fillable = ['title', 'price'];

    public function scopePackettype($q)
    {
        return $q;
    }

    public function flowerPackets()
    {
        return $this->belongsToMany(FlowerPacket::class);
    }

    public static function GetPckt()
    {
        return PacketType::select(['id', 'title', 'price'])->get()->toArray();
    }


}

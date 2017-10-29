<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class OrderPacket extends Model
{
    protected $table = 'order_packets';
    public $timestamps = true;
    protected $with = 'packet';
    protected $fillable = ['sent_at'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function packet()
    {
        return $this->belongsTo(FlowerPacket::class);
    }
}

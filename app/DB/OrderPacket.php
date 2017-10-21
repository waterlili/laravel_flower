<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class OrderPacket extends Model
{
    protected $table = 'order_packets';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

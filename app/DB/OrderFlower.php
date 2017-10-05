<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class OrderFlower extends Model
{
    protected $table = 'order_flowers';
    public $timestamps = true;
    public $timestamp = true;
    protected $fillable = ['order_id', 'name', 'stalk_counter', 'type', 'send_at'];
}

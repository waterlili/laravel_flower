<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class OrderPacket extends Model
{
    protected $table = 'order_packets';
    public $timestamps = true;
    protected $with = 'packet';
    protected $fillable = ['sent_at', 'period'];
    public static $SELECT_SENT_AT = 'sent_at as sent';
    public static $SELECT_PERIOD = 'period as period_str';
    public static $PERIOD = [
        1 => 'صبح',
        2 => 'عصر'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function packet()
    {
        return $this->belongsTo(FlowerPacket::class);
    }

    public function getSentAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        } else {
            $date = explode(" ", $value);
//            return date('yyyy/mm/dd',$date[0]);
            $newFormat = strtotime($date[0]);
            $new = date('Y/m/d', $newFormat);
            return $new;
        }
    }

    public function getPeriodStrAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        }
        return array_get(self::$PERIOD, $value, 'تعریف نشده');

    }

}

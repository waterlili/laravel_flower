<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['period'];
    public static $SELECT_SENT_AT = 'sent_at as sent';
    public static $SELECT_PERIOD = 'period as period_str';
    public static $SELECT_VASE = 'order.vid as vase_str';
    public static $PERIOD = [
        1 => 'صبح',
        2 => 'عصر'
    ];
    public static $VASE = [
        1 => 'دارد',

    ];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function orderItem($item)
    {
        $this->setAttribute('itemable_id', $item->id);
        $this->setAttribute('itemable_type', class_basename($item));
    }

    public function flower()
    {
        return $this->hasOne('App\DB\Flower', 'id', 'itemable_id');
    }

    public function flowerPacket()
    {
        return $this->hasOne('App\DB\FlowerPacket', 'id', 'itemable_id');
    }

    public function getSentAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        } else {
            $date = explode(" ", $value);
//            return date('yyyy/mm/dd',$date[0]);
            $newFormat = strtotime($date[0]);
            $new = date('Y-m-d', $newFormat);
            return $new;
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->select(['id', 'vid', 'cid'])->with('customer');

    }
    public function getPeriodStrAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        }
        return array_get(self::$PERIOD, $value, 'تعریف نشده');

    }

    public function getVaseStrAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        }
        return array_get(self::$VASE, $value, 'تعریف نشده');

    }

    public static function timeDuration()
    {

        $periods = [
            1 => 'صبح',
            2 => 'عصر'
        ];
        return $periods;
    }

}




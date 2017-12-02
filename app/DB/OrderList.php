<?php

namespace App\DB;

class OrderList extends Model {

  protected $table = 'order_list';
  public $timestamps = FALSE;
  protected $fillable = array('price', 'oid', 'pid', 'total');


  public function product_name() {
    return $this->belongsTo('App\DB\Product', 'pid')->select([
      'id',
      'code',
      'title',
      'price'
    ]);
  }
}
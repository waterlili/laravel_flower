<?php

namespace App\DB;

class FlowerComposit extends Model {

  protected $table = 'composit';
  public $timestamps = TRUE;
  protected $fillable = array(
    'title',
    'total',
    'level',
    'session',
    'p_level',
    'exp',
    'product',
    'flower'
  );

  public function product() {
    return $this->belongsTo('App\DB\Product', 'product');
  }

  public function flower() {
    return $this->belongsTo('App\DB\Flower', 'flower');
  }

}
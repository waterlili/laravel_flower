<?php

namespace App\DB;

class CustomerGroup extends Model {
  public $table = 'customer_group';
  public $timestamps = FALSE;
  protected $fillable = [
    'group',
    'customer'
  ];


  public function group() {
    return $this->belongsTo('App\DB\Group', 'group');
  }

  public function customer() {
    return $this->belongsTo('App\DB\Users', 'customer');
  }
}

<?php

namespace App\DB;

class Group extends Model {
  public $table = 'group';
  public $timestamps = FALSE;
  protected $fillable = [
    'title',
    'parent',
    'depth'
  ];


  public function customer() {
    return $this->hasMany('App\DB\CustomerGroup', 'group');
  }

  public function parent() {
    return $this->belongsTo('App\DB\Group', 'parent');
  }

  public function child() {
    return $this->hasMany('App\DB\Group', 'parent')->with('child');
  }
}

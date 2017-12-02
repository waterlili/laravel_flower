<?php

namespace App\DB;

class Permission extends Model {

  protected $table = 'permission';
  public $timestamps = FALSE;

  protected $fillable = [
    'utid',
    'rid',
    'sts'
  ];

}
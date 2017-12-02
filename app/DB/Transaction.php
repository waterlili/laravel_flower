<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model {

  protected $table = 'transaction';
  public $timestamps = TRUE;

  use SoftDeletes;

  protected $dates = ['deleted_at'];

}
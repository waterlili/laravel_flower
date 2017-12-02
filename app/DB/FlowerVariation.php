<?php

namespace App\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class FlowerVariation extends Model
{

    public $timestamps = TRUE;
    protected $table = 'flower_variations';

    protected $fillable = array(
        'flower_id',
        'color',
        'image',
    );
}
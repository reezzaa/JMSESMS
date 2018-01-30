<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
     protected $fillable = [
      'RateDesc',
      'RateValue',
      'todelete',
      'status',
    ];
    public $timestamps = false;
    protected $table = 'tblrate';
}

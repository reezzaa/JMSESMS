<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
     protected $fillable = [
      'FeeDesc',
      'FeeValue',
      'todelete',
      'status',
    ];
    public $timestamps = false;
    protected $table = 'tblfee';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    //
     protected $fillable = [
      'TaxValue',
      'status',
      'todelete',
    ];
    public $timestamps = false;
    protected $table = 'tbltax';
}

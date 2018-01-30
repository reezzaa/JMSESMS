<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recoupment extends Model
{
    //
     protected $fillable = [
      'RecValue',
      'status',
      'todelete',
    ];
    public $timestamps = false;
    protected $table = 'tblrecoupment';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retention extends Model
{
    //
     protected $fillable = [
      'RetValue',
      'status',
      'todelete',
    ];
    public $timestamps = false;
    protected $table = 'tblretention';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    //
     protected $fillable = [
      'MiscDesc',
      'MiscValue',
      'status',
      'todelete',
    ];
    public $timestamps = false;
    protected $table = 'tblmiscellaneous';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialClass extends Model
{
    protected $fillable = [
      'MatClassName',
      'MatTypeID',
      'todelete',
      'status',
    ];
    public $timestamps = false;
    protected $table = 'tblMaterialClass';
}

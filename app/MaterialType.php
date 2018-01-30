<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $fillable = [
      'MatTypeName',
      'todelete',
      'status',
    ];
    public $timestamps = false;
    protected $table = 'tblMaterialType';
}

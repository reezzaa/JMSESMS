<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
      'MatClassID',
      'MatUOM',
      'MaterialName',
      'MaterialBrand',
      'MaterialSize',
      'MaterialColor',
      'MaterialDimension',
      'MaterialUnitPrice',
      'todelete',
      'status',
      'date',
    ];
    public $timestamps = false;
    protected $table = 'tblmaterial';
}

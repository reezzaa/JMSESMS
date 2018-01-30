<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
     protected $fillable = [
      'EquipName',
      'EquipTypeDesc',
      'EquipLeaser',
      'EquipKey',
      'EquipPrice',
      'todelete',
      'status',
      'rent',
    ];
    public $timestamps = false;
    protected $table = 'tblEquipment';
}
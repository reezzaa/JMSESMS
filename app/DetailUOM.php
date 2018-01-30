<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUOM extends Model
{
    protected $fillable = [
      'GroupUOMID',
      'DetailUOMText',
      'UOMUnitSymbol',
      'status',
      'todelete'
    ];
    public $timestamps = false;
    protected $table = 'tblDetailUOM';
}

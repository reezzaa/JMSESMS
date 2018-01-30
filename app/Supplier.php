<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
      'SuppDesc',
      'todelete',
      'status',
    ];
    public $timestamps = false;
    protected $table = 'tblsupplier';
     
}

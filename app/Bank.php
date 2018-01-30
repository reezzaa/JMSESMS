<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //
    protected $fillable = [
      'BankName',
      'todelete',
      'status'
    ];
    public $timestamps = false;
    protected $table = 'tblbank';
}

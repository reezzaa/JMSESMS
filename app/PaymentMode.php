<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    //
    protected $fillable = [
      'ModeValue',
      'status',
      'todelete',
    ];
    public $timestamps = false;
    protected $table = 'tblpaymentmode';
}

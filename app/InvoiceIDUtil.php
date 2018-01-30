<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceIDUtil extends Model
{
    //
    protected $fillable = [
      'strInvoiceIDUtil'
    ];
    public $timestamps = false;
    protected $primaryKey = 'strInvoiceIDUtil';
    protected $table = 'tblInvoiceIDUtil';
}

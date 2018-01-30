<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tblcontract';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractOrder extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'ContractID';
    protected $table = 'tblcontractorder';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractTask extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tblcontracttask';
}

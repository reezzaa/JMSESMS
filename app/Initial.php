<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initial extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'ContractID';
    protected $table = 'tblinitial';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'ServMatID';
    protected $table = 'tblstocks';
}

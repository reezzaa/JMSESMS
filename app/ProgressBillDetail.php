<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressBillDetail extends Model
{
    //
     public $timestamps = false;
    public $primaryKey = 'PB_ID';
    protected $table = 'tblprogressdetail';
}

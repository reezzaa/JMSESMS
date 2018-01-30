<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServTotal extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'ServID';
    protected $table = 'tblservtotal';
}

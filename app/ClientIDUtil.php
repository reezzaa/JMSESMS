<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientIDUtil extends Model
{
    protected $fillable = [
      'strClientIDUtil'
    ];
    public $timestamps = false;
    protected $primaryKey = 'strClientIDUtil';
    protected $table = 'tblClientIDUtil';
}

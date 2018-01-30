<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrIDUtil extends Model
{
    //
     protected $fillable = [
      'strOrIDUtil'
    ];
    public $timestamps = false;
    protected $primaryKey = 'strOrIDUtil';
    protected $table = 'tblOrIDUtil';
}

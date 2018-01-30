<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServTask extends Model
{
    //
    protected $fillable = [
      'ServID',
      'ServTask',
      'status',
      'duration',
    ];
    public $timestamps = false;
    protected $table = 'tblservtask';
}

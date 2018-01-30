<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesOffered extends Model
{
    protected $fillable = [
      'ServiceOffName',
      'todelete',
      'status',
      'duration',
      'remarks',
      
    ];
    public $timestamps = false;
    protected $table = 'tblServicesOffered';
}

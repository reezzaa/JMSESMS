<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
      protected $fillable = [
      'SpecDesc',
      'rpd',
      'date',
      'todelete',
      'status',
    ];
    public $timestamps =false;
    protected $table = 'tblspecialization';

    // public function categories()
    // {
    //     return $this->belongsToMany('App\Employee');
    // }
}

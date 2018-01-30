<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
      'strCompClientID',
      'strCompClientImage',
      'strCompClientName',
      'strCompClientRepresentative',
      'strCompClientPosition',
      'strCompClientTIN',
      'strCompClientContactNo',
      'strCompClientEmail',
      'strCompClientAddress',
      'strCompClientCity',
      'strCompClientProv',
      'status',
      'todelete'
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'strCompClientID';
    protected $table = 'tblClient';
}

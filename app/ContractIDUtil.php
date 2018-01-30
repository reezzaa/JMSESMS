<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractIDUtil extends Model
{
    protected $fillable = [
      'strContractIDUtil',
    ];
    public $timestamps = false;
    protected $primaryKey = 'strContractIDUtil';
    protected $table = 'tblContractIDUtil';
}

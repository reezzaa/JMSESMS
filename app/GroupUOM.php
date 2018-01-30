<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUOM extends Model
{
    protected $fillable = [
      'GroupUOMText',
      'status',
      'todelete'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tblGroupUOM';
}

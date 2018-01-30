<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUtil extends Model
{
    protected $fillable = [
      'intCompanyUtilID',
      'strCompanyAddress',
      'strCompanyName',
      'strCompanyTIN',
      'strCompanyEmail',
      'strGeneralManagerName',
      'strCompanyLogo'
    ];
    public $timestamps = true;
    protected $primaryKey = 'intCompanyUtilID';
    protected $table = 'tblCompanyUtil';
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BudgetDepartment extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps= true;
    protected $guard = 'budgetdepartment';
    // protected $table = 'budgetdepartment';
    protected $table = 'budgetdept';
    protected $fillable = [
        'username','email','password','fname','mname','lname','suffix','active','status',
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

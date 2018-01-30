<?php

use Illuminate\Database\Seeder;
use App\Operations;
use App\BudgetDepartment;
use App\ProjectManager;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed for operations user
    	Operations::create([
           'username' => 'operations',
           'fname' => 'Criszel',
           'lname' => 'Murillo',
           'email' => 'o@email.com',
           'password'=> bcrypt('admin'),
           'active' => 1,
           'status' => 1,
           'remember_token' => str_random(10),
    	]);

      BudgetDepartment::create([
           'username' => 'budgetdept',
           'fname' => 'Brenda',
           'lname' => 'Pasadas',
           'email' => 'bd@email.com',
           'password'=> bcrypt('admin'),
           'active' => 1,
           'status' => 1,
           'remember_token' => str_random(10),
      ]);
      ProjectManager::create([
           'username' => 'pm',
           'fname' => 'Ambrosio',
           'lname' => 'Cruz',
           'email' => 'pm@email.com',
           'password'=> bcrypt('admin'),
           'active' => 1,
           'status' => 1,
           'remember_token' => str_random(10),
      ]);
    }
}

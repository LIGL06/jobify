<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $admin = \App\Role::create([
            'name' => 'admin',
            'description' => 'Administrator'
        ]);
        $employee = \App\Role::create([
            'name' => 'employee',
            'description' => 'Employee'
        ]);
        $employer = \App\Role::create([
            'name' => 'employer',
            'description' => 'Employer'
        ]);
        $user = \App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $user->roles()->attach($admin);
        $user = \App\User::create([
            'name' => 'Employer',
            'email' => 'employer@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $user->roles()->attach($employee);
        $user = \App\User::create([
            'name' => 'Employee',
            'email' => 'employee@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $user->roles()->attach($employer);
    }
}

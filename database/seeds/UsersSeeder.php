<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = \App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $adminUser->roles()->attach([
            'userId' => $adminUser->id,
            'roleId' => 1
        ]);

        $employerUser = \App\User::create([
            'name' => 'Employer',
            'email' => 'employer@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $employerUser->roles()->attach([
            'userId' => $employerUser->id,
            'roleId' => 2
        ]);

        $employeeUser = \App\User::create([
            'name' => 'Employee',
            'email' => 'employee@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $employeeUser->roles()->attach([
            'userId' => $employeeUser->id,
            'roleId' => 3
        ]);
    }
}

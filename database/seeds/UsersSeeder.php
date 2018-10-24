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
            'roleId' => 3
        ]);

        $employeeUser = \App\User::create([
            'name' => 'Employee',
            'email' => 'employee@madero.gob.mx',
            'password' => bcrypt('Password00')
        ]);
        $employeeUser->roles()->attach([
            'userId' => $employeeUser->id,
            'roleId' => 2
        ]);

        \App\UserInfo::create([
            'userId' => $employeeUser->id,
            'fName' => 'Empleado',
            'lName' => 'Prueba',
            'doB' => \Carbon\Carbon::now()->subYears(10),
            'civilStatus' => 'soltero',
            'address' => 'Dirección Prueba',
            'pictureUrl' => 'https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png',
            'professional' => true,
            'handyCap' => false,
            'uniqueKey' => 'XXXXXXXXXX',
            'socialKey' => '1234567890',
            'salary' => 9999
        ]);
    }
}

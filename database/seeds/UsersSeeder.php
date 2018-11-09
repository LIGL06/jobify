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
            'password' => bcrypt('Password00'),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $employeeUser = \App\User::create([
            'name' => 'Employee',
            'email' => 'employee@madero.gob.mx',
            'password' => bcrypt('Password00'),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $employerUser = \App\User::create([
            'name' => 'Employer',
            'email' => 'employer@madero.gob.mx',
            'password' => bcrypt('Password00'),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        \App\UserInfo::create([
            'userId' => $employeeUser->id,
            'fName' => 'Empleado',
            'lName' => 'Prueba',
            'doB' => \Carbon\Carbon::now()->subYears(10),
            'civilStatus' => 'soltero',
            'address' => 'Dirección Prueba',
            'phone' => '123456789',
            'profession' => 'Ing. Tecnologías',
            'pictureUrl' => 'https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png',
            'professional' => true,
            'handyCap' => false,
            'uniqueKey' => 'XXXXXXXXXX',
            'socialKey' => '1234567890',
            'salary' => 9999
        ]);
        $adminUser->roles()->attach([
            'roleId' => 1,
            'userId' => $adminUser->id
        ]);
        $employeeUser->roles()->attach([
            'roleId' => 2,
            'userId' => $employeeUser->id
        ]);
        $employerUser->roles()->attach([
            'roleId' => 3,
            'userId' => $employerUser->id
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'admin',
            'description' => 'Administrator'
        ]);
        \App\Role::create([
            'name' => 'employee',
            'description' => 'Employee'
        ]);
        \App\Role::create([
            'name' => 'employer',
            'description' => 'Employer'
        ]);
    }
}

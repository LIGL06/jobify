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
        \App\Company::create([
            'name' => 'Empresa demo',
            'rotation' => 'demo',
            'phone' => '123456789',
            'email' => 'demo@madero.gob.mx',
            'address' => 'Dirección demo'
        ]);

        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            JobsSeeder::class
        ]);


    }
}

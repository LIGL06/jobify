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
        /*
        \App\Company::create([
            'name' => 'Empresa demo',
            'rotation' => 'demo',
            'phone' => '123456789',
            'email' => 'demo@madero.gob.mx',
            'address' => 'Dirección demo'
        ]);
        */
        $jobs = array(['name' => 'Psicólogo'],
            ['name' => 'Recursos humanos'],
            ['name' => 'Recepcionista'],
            ['name' => 'Auxiliar admnistrativo'],
            ['name' => 'Fisioterapeuta'],
            ['name' => 'Gerente planta'],
            ['name' => 'Administrativo'],
            ['name' => 'Gerente'],
            ['name' => 'Diseñador gráfico'],
            ['name' => 'Ventas'],
            ['name' => 'Jefe mantenimiento'],
            ['name' => 'Médico'],
            ['name' => 'Gerente proyecto'],
            ['name' => 'Chófer'],
            ['name' => 'Contador'],
            ['name' => 'Gerente crédito'],
            ['name' => 'Ejecutivo ventas'],
            ['name' => 'Promotor'],
            ['name' => 'Jefe almacén'],
            ['name' => 'Almacenista'],
            ['name' => 'Ing. Electrónica'],
            ['name' => 'Gerente producción'],
            ['name' => 'Ninéra'],
            ['name' => 'Cuidadora'],
            ['name' => 'Mantenimiento'],
            ['name' => 'Supervisor'],
            ['name' => 'Abogado'],
            ['name' => 'Mensajero'],
            ['name' => 'Asesos ventas'],
            ['name' => 'Representante ventas'],
            ['name' => 'Auditor'],
            ['name' => 'Programador']);
        DB::table('job_subdescription')->insert($jobs);

        /*
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            JobsSeeder::class
        ]);
        */


    }
}

<?php

use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employer = \App\Employer::create([
            'userId' => 3,
            'companyId' => 1,
            'approved' => true
        ]);

        $job = \App\Job::create([
            'title' => 'Puesto demo',
            'subTitle' => 'Especialización demo',
            'required' => false,
            'vacancies' => 9,
            'companyId' => 1,
            'employerId' => $employer->id
        ]);

        \App\Employee::create([
            'userId' => 2,
            'companyId' => 1,
            'jobId' => $job->id,
        ]);


    }
}

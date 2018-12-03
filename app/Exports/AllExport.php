<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new CompaniesExport();
        $sheets[1] = new EmployersExport();
        $sheets[2] = new EmployeesExport();
        $sheets[3] = new JobsExport();
        $sheets[4] = new UsersExport();
        return $sheets;
    }

}

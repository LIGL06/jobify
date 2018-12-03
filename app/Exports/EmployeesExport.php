<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmployeesExport implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            '# Usuario',
            '# Empresa',
            '# Empleo',
            'Status',
            'Aprobado',
            'Creado',
            'Actualizado'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Aspirantes';
    }
}

<?php

namespace App\Exports;

use App\Employer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


class EmployersExport implements FromCollection, WithHeadings, WithTitle
{

    /**
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employer::all();
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
        return 'Empleadores';
    }
}

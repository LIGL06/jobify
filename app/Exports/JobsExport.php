<?php

namespace App\Exports;

use App\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class JobsExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Job::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Titulo',
            'Profesión',
            'Urgencia',
            'Vacantes',
            'Sexo',
            '# Empresa',
            'Aprobado',
            'Creado',
            'Actualizado',
            '# Empleador'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Empleos';
    }
}

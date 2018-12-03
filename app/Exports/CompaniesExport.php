<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CompaniesExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Company::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Giro',
            'Telefono',
            'Correo electronico',
            'Dirección',
            'Link de imagen',
            'Observaciones',
            'Carta de antecedentes penales',
            'Aprobada',
            'Contacto de empresa',
            'Es operadora de franquicias',
            'Empresa padre',
            'Creado',
            'Actualizado'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Empresas';
    }
}

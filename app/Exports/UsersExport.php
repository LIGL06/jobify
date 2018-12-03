<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Correo electronico',
            'Verificacion',
            'Creado',
            'Actualizado'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Usuarios';
    }
}

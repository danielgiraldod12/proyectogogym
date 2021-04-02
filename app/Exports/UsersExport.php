<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::query() //Creo la variable datatables con el modelo User y el metodo query
        ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
        ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
        ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
        ->select([ //Selecciono
            'users.id', //Id de Usuario
            'users.name', //Nombre usuario
            'users.email', //Email usuario
            'users.typeOfIdentification', //Tipo de Doc
            'users.identification_num', //Num de Doc
            'record_nums.record_num', //Ficha del usuario con inner join
            'training_programs.name_program', //Programa del usuario con inner join
            'training_centers.name_center']) //Centro del usuario con inner join
        ->orderBy('id', 'asc')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Email',
            'Tipo de Doc',
            'Num de Doc',
            'Ficha',
            'Programa',
            'Centro'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}

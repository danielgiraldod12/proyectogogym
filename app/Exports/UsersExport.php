<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;


class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithStrictNullComparison

{
    /**
     * Retorna la informacion de la tabla usuarios.
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::query() //Creo la variable datatables con el modelo User y el metodo query
        ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
        ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
        ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
        ->leftJoin('asists','asists.id_user','=','users.id')
        ->select([ //Selecciono
            'users.id', //Id de Usuario
            'users.name as Nombre', //Nombre usuario
            'users.email as Email', //Email usuario
            'users.typeOfIdentification as Tipo Doc', //Tipo de Doc
            'users.identification_num as Num Doc', //Num de Doc
            'record_nums.record_num as Ficha', //Ficha del usuario con inner join
            'training_programs.name_program as Programa', //Programa del usuario con inner join
            'training_centers.name_center as Centro', //Centro del usuario con inner join
            DB::raw('count(`asists`.`id_user`) as cantAsistencias')]) //Cant. de asistencias por usuario
        ->orderBy('id', 'asc') //Ordeno ascendentemente por el id
        ->groupBy('users.id') //Agrupo por el id de usuario
        ->get();
    }

    /**
     * Retorna una cabecera, que sera la informacion que se pondra en la primera fila del
     * archivo de Excel
     * @return string[]
     */
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
            'Centro',
            'Cant. Asist'
        ];
    }

    /**
     * Se le asignan estilos a la hoja de excel
     * @param Worksheet $sheet
     * @return \bool[][][]
     */
    public function styles(Worksheet $sheet)
    {
        /**
         * Le asigna negrita a la primera fila.
         */
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Asist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AsistsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Retorna la informacion de la tabla asistencias.
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Asist::query()
            ->select([
                'id', //Id asistencia
                'name', //Nombre al que pertenece la asistencia
                'id_user', //Id al que pertenece la asistencia
                'record_num', //Ficha al que pertenece la asistencia
                'createdBy', //Creado por
            ])->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as Fecha") //Fecha en que se creo
            ->selectRaw("DATE_FORMAT(created_at, '%h:%i %p') as Hora") //Hora en que se creo
            ->orderBy('id','asc') //Ordenar ascendentemente por id
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
            'Nombre del Usuario',
            'Id del Usuario',
            'Ficha del Usuario',
            'Creado por',
            'Fecha',
            'Hora'
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

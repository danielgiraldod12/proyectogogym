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
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Asist::query()
            ->select([
                'id',
                'name',
                'id_user',
                'record_num',
                'createdBy',
                'created_at'
            ])->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nombre del Usuario',
            'Id del Usuario',
            'Ficha del Usuario',
            'Creado por',
            'Fecha'
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

<?php

namespace App\Exports;

use App\Models\Asist;
use App\Models\Event;
use App\Models\Record_num;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GeneralExport implements FromCollection, ShouldAutoSize, WithStrictNullComparison
{
    private $collection;

    public function __construct($arrays)
    {
        $output = [];

        foreach($arrays as $num => $array){
            if($num == 0){
                $output[] = ['Usuarios'];
            }
            if($num == 1){
                $output[] = ['Asistencias'];
            }
            if($num == 2){
                $output[] = ['Eventos'];
            }
            if($num == 3){
                $output[] = ['Fichas'];
            }
            foreach($array as $row => $value){
                if($row == 0){
                    $output[] = array_keys($value);
                }
                $output[] = array_values($value);
            }
            $output[] = [''];
        }
        $this->collection = collect($output);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->collection;
    }

}

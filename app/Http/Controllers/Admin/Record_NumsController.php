<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record_num;
use App\Models\Training_program;
use Illuminate\Http\Request;

class Record_NumsController extends Controller
{
    /////////////////////////////////////

    public function record_num(){

        //Consulta para tabla usuarios
        $datatablesRecord = Record_num::query() //Creo la variable datatables con el modelo User y el metodo query
        ->join('training_programs','training_programs.id', '=', 'record_nums.id_training_program') //Inner join con la tabla programa
        ->select([ //Selecciono
            'record_nums.id', //Id de ficha
            'record_nums.record_num', //Nombre ficha
            'training_programs.name_program' //Programa de la ficha con inner join
        ])
            ->get();
        //Le retorno la vista al controlador y le digo que puede usar la variable datatables en la vista con el compact
        return view('record_num/record_nums', compact('datatablesRecord'));
    }

    public function creatern(){
        /* Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario create */
        $queryPrograma = Training_program::all();
        // Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
        return view('record_num/createrecord_num', compact('queryPrograma'));
    }

    public function crearrn(Request $request){

        $id = new Record_num(); //Le digo que me cree un nuevo registro en el modelo User
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista create y los guarde en cada columna de la tabla users */

        $id->record_num = $request->record_num;
        $id->id_training_program = $request->id_training_program;

        $id->save(); //Le digo que guarde la informacion

        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('record_num' , $id)->with('message','¡Ficha creada satisfactoriamente!');
    }

    public function editrn(Record_num $id){
        /* Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario edit */
        $record_num = Record_num::all();
        $training_program = Training_program::all();

        $query = $id; //Le mando la id

        return view('record_num/editrecord_num', compact('id','query','training_program','record_num'));
    }

    public function updatern(Request $request, Record_num $id){
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista edit y actualice el registro correspondiente */
        $id->record_num = $request->record_num;
        $id->id_training_program = $request->id_training_program;

        $id->save(); //Le digo que guarde la informacion
        return redirect()->route('record_num' , $id)->with('message','¡Actualización de ficha satisfactoria!');
    }

    public function destroyrn(Record_num $id){
        $id->delete(); //Le digo que elimine un registro utilizando la variable id y el metodo delete
        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('record_num' , $id)->with('message','¡Eliminación de ficha satisfactoria!');
    }
}
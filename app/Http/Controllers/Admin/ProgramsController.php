<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\States_event;
use App\Models\Training_program;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function programs(){

        //Consulta para tabla eventos
        $datatablesProgram = Training_program::all(); //Creo la variable datatables con el modelo event y el metodo query


        //Le retorno la vista al controlador y le digo que puede usar la variable datatables en la vista con el compact
        return view('program/program-list', compact('datatablesProgram'));
    }

    public function createprog(){
        // Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
        return view('program/program-create');
    }

    public function crearprog(Request $request){

        $id = new Training_program(); //Le digo que me cree un nuevo registro en el modelo event
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista create y los guarde en cada columna de la tabla events */

        $id->name_program = $request->name_program;

        try {
            $error = !$id->save();
        } catch (QueryException $e) {
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡Ya existe un programa con ese nombre!";
            }
        }

        if (!$error) {
            /* Le digo que me redireccione a la vista de datatables con un mensaje */
            return redirect()->route('programs' , $id)->with('message','¡Programa creado satisfactoriamente!');
        } else {
            return redirect()->route('createprog' , $id)->with('message', $message);
        }


    }

    public function editprog(Training_program $id){

        $query = $id; //Le mando la id

        return view('program/program-edit', compact('id','query'));
        //lo paso a la vista de editar eventos con el compact para utlizar el id query
    }

    public function updateprog(Request $request, Training_program $id){
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista edit y actualice el evento correspondiente */
        $id->name_program = $request->name_program;

        try {
            $error = !$id->save();
        } catch (QueryException $e) {
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡Ya existe un programa con ese nombre!";
            }
        }

        if (!$error) {
            /* Le digo que me redireccione a la vista de datatables con un mensaje */
            return redirect()->route('programs' , $id)->with('message','¡Actualizacion de programa satisfactoria!');
        } else {
            //$request->session()->flash('danger', $message ? $message : 'Error inesperado al intentar almacenar el usuario.');
            return redirect()->route('editprog' , $id)->with('message', $message);
        }

    }

    public function destroyprog(Training_program $id){
        $id->delete(); //Le digo que elimine un registro utilizando la variable id y el metodo delete
        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('programs' , $id)->with('message','¡Eliminación de programa satisfactorio!');
    }
}

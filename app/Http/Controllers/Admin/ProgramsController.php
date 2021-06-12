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
    /**
     * Renderizo la vista de la tabla de programas, aunque la informacion de la tabla se manda
     * desde la funcion ajaxProgram() que se encuentra en el controlador
     * app/Http/Controllers/Admin/AjaxController.php.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function programs(){
        return view('program/program-list');
    }

    /**
     * Renderizo la vista del formulario crear programa
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createprog(){
        return view('program/program-create');
    }

    /**
     * Creo un nuevo registro en la tabla programa
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearprog(Request $request){

        /**
         * Le digo que cree un nuevo registro
         */
        $id = new Training_program();

        /**
         * Rellena la informacion con lo que viene en el request
         */
        $id->name_program = $request->name_program;

        /**
         * Se hace un try catch para verificar y controlar si hay errores
         * En el try catch se utilizara el QueryException para capturar el error en caso de que
         * exista alguno.
         */
        try {
            /**
             * Aquí le asignaremos a la variable $error la respuesta del método save.
             * La respuesta del método save puede ser un true si guardo o un false si no guardo.
             * Si la respuesta es true es porque el proceso de guardado funcionó correctamente sin ningun error
             * por lo cual se niega la respuesta de tal manera que quedará como false y le indique al try catch que no hay error el cual capturar.
             * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
             * por lo cual se niega la respuesta de tal manera que quedará como true y le indique al try catch que hay un error el cual capturar.
             */
            $error = !$id->save();
        } catch (QueryException $e) {
            /**
             * Aquí simplemente le asignamos a la variable $error un true para indicarle a
             * los siguiente procesos que contenga la función de que hubo un error con el
             * proceso de guardado.
             */
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡Ya existe un programa con ese nombre!";
            }
        }
        /**
         * Si no hay ningun error a la hora de crear el programa, se redirigira a la tabla programas
         * con el mensaje de que se creo correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('programs' , $id)->with('message','¡Programa creado satisfactoriamente!');
        } else {
            return redirect()->route('createprog' , $id)->with('message', $message);
        }
    }

    /**
     * Renderizo la vista del formulario de editar programa y con el compact le mando informacion
     * del programa que va a ser editado para que el formulario sea rellenado con esta
     * informacion
     * @param Training_program $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editprog(Training_program $id){

        $query = $id; //Le mando la id

        return view('program/program-edit', compact('id','query'));
    }

    /**
     * Edito un registro en la tabla programas
     * @param Request $request
     * @param Training_program $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateprog(Request $request, Training_program $id){
        /**
         * Relleno la informacion con lo que viene en el request
         */
        $id->name_program = $request->name_program;

        /**
         * Se hace un try catch para verificar y controlar si hay errores
         * En el try catch se utilizara el QueryException para capturar el error en caso de que
         * exista alguno.
         */
        try {
            /**
             * Aquí le asignaremos a la variable $error la respuesta del método save.
             * La respuesta del método save puede ser un true si guardo o un false si no guardo.
             * Si la respuesta es true es porque el proceso de guardado funcionó correctamente sin ningun error
             * por lo cual se niega la respuesta de tal manera que quedará como false y le indique al try catch que no hay error el cual capturar.
             * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
             * por lo cual se niega la respuesta de tal manera que quedará como true y le indique al try catch que hay un error el cual capturar.
             */
            $error = !$id->save();
        } catch (QueryException $e) {
            /**
             * Aquí simplemente le asignamos a la variable $error un true para indicarle a
             * los siguiente procesos que contenga la función de que hubo un error con el
             * proceso de guardado.
             */
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡Ya existe un programa con ese nombre!";
            }
        }
        /**
         * Si no hay ningun error a la hora de editar el programa, se redirigira a la tabla programas
         * con el mensaje de que se edito correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('programs' , $id)->with('message','¡Actualizacion de programa satisfactoria!');
        } else {
            return redirect()->route('editprog' , $id)->with('message', $message);
        }

    }

    /**
     * Elimina un registro en la tabla programas
     * @param Training_program $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyprog(Training_program $id){
        /**
         * Si viene el id lo elimina, si no, retorna falso
         */
        if($id){
            $id->delete();
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record_num;
use App\Models\Training_program;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class Record_NumsController extends Controller
{
    /**
     * Renderizo la vista de la tabla fichas, aunque la informacion se manda desde
     * la funcion ajaxRecordNum() que se encuentra en el controlador
     * app/Http/Controllers/Admin/AjaxController.php.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function record_num(){
        return view('record_num/record_nums');
    }

    /**
     * Renderizo la vista del formulario para crear una ficha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function creatern(){
        /**
         * Hago las querys de cada tabla para posteriormente usarlas en los selects del formulario create
         */
        $queryPrograma = Training_program::all();

        /**
         * Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
         */

        return view('record_num/createrecord_num', compact('queryPrograma'));
    }

    /**
     * Creo un registro nuevo en la tabla fichas con la informacion que viene en el request del formulario
     * para crear la ficha
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearrn(Request $request){
        /**
         * Le digo que me cree un nuevo registro en la tabla ficha
         */
        $id = new Record_num();

        /**
         * Relleno la informacion con el request
         */
        $id->record_num = $request->record_num;
        $id->id_training_program = $request->id_training_program;

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
                $message = "¡Ya existe una ficha con ese numero!";
            }
        }

        /**
         * Si no hay ningun error a la hora de crear la ficha, se redirigira a la tabla fichas
         * con el mensaje de que se creo correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('record_num' , $id)->with('message','¡Ficha creada satisfactoriamente!');
        } else {
            return redirect()->route('creatern' , $id)->with('message', $message);
        }
    }

    /**
     * Renderizo el formulario para editar una ficha y le mando la informacion de otras tablas para que la
     * utilice en los selects del formulario
     * @param Record_num $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editrn(Record_num $id){
        $training_programs = Training_program::all();

        $query = $id; //Le mando la id

        return view('record_num/editrecord_num', compact('id','query','training_programs'));
    }

    /**
     * Edito un registro en la tabla ficha con la informacion que viene por el request del formulario de editar
     * ficha
     * @param Request $request
     * @param Record_num $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatern(Request $request, Record_num $id){
        /**
         * Reemplazo la informacion del registro con la que viene por el request
         */
        $id->record_num = $request->record_num;
        $id->id_training_program = $request->id_training_program;

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
                $message = "¡Ya existe una ficha con ese numero!";
            }
        }

        /**
         * Si no hay ningun error a la hora de editar la ficha, se redirigira a la tabla fichas
         * con el mensaje de que se edito correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('record_num' , $id)->with('message','¡Actualización de ficha satisfactoria!');
        } else {
            return redirect()->route('creatern' , $id)->with('message', $message);
        }

    }

    /**
     * Elimino un registro de la tabla fichas
     * @param Record_num $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyrn(Record_num $id){
        /**
         * Si viene algun id lo elimino, si no, retorno falso
         */
        if($id){
            $id->delete();
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }
}

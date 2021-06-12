<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Record_num;

class AsistsController extends Controller
{
    /**
     * Renderizo la vista de la tabla asistencia, aunque la informacion se envia
     * desde la funcion ajaxAsists() que se encuentra en el controlador
     * app/Http/Controllers/Admin/AjaxController.php.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function asistencia(){
        return view('asist.asist-list');
    }

    /**
     * Creo un registro en la tabla asistencias y redirecciono a la vista de usuarios
     * @param User $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createasistencia(User $id){
        /**
         * Busco la ficha del usuario en la tabla de fichas, utilizando el $id que viene en la funcion
         */
        $userRn = Record_num::query()->where('id',$id->id_record_num)->get()->first();

        $asist = new Asist();

        /**
         * Relleno la informacion del registro y guardo
         */
        $asist->id_user = $id->id; //Id del usuario al que pertenece la asistencia
        $asist->name = $id->name; //Nombre del usuario al que pertenece la asistencia
        $asist->createdBy = Auth::user()->email; //Email del usuario que creo la asistencia
        $asist->record_num = $userRn->record_num; //Ficha del usuario al que pertenece la asistencia

        $asist->save(); //Guardo

        /**
         * Redirecciono a la ruta users
         */
        return redirect()->route('users');
    }

    /**
     * Elimino un registro en la tabla asistencias
     * @param Asist $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyasistencia(Asist $id){
        /**
         * Si viene algun id, lo eliminara, si no, retornara un falso
         */
        if($id){
            $id->delete();
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }
}

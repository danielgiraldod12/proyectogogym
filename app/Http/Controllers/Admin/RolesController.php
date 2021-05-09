<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Renderizo la vista de la tabla roles y le mando la informacion con el compact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function roles(){

        $user = User::all();

        return view('role/user-roles', compact('user'));
    }

    /**
     * Renderizo la vista para editar/asignar roles a un usuario en especifico
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editroles($id){

        /**
         * Traigo la informacion de diferentes tablas para usarla en la vista.
         */
        $roles = Role::all();
        $user = User::query()->where('id','=',$id)->first();
        $idLog = Auth::user()->id;

        return view('role/roles', compact('user', 'roles','idLog','id'));
    }

    /**
     * Edito/Asigno roles a un usuario en especifico
     * @param Request $request
     * @param User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateroles(Request $request, User $id){
        /**
         * Sincronizo los roles que vienen por el request
         */
        $id->syncRoles($request->roles);
        /**
         * Redirecciono a la misma ruta con un mensaje
         */
        return redirect()->route('editroles', $id)->with('message','Se asignaron los roles correctamente!');
    }
}

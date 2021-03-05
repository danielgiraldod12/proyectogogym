<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    //Roles

    public function roles(){

        //Consulta para tabla usuarios
        $user = User::all();

        return view('role/user-roles', compact('user'));
    }

    public function editroles($id){

        $roles = Role::all();
        $user = User::query()->where('id','=',$id)->first();
        $idLog = Auth::user()->id;

        return view('role/roles', compact('user', 'roles','idLog','id'));
    }

    public function updateroles(Request $request, User $id){

        $id->syncRoles($request->roles);
        return redirect()->route('editroles', $id)->with('message','Se asignaron los roles correctamente!');
    }
}

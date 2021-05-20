<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRequestController extends Controller
{
    /**
     * Retorna la vista de solicitudes con la tabla, pero la informacion se envia por otro lado
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function requests(){
        return view('user.users-requests');
    }

    /**
     * Si acepta la solicitud de registro, se creara un nuevo usuario con la misma informacion
     * de la solicitud (la informacion viene por la url en el parametro llamado id), y despues
     * de que se cree el usuario, la solicitud se elimina
     * @param UserRequest $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function accept(UserRequest $id){
        $createUser = new User();

        $createUser->name = $id->name;
        $createUser->typeOfIdentification = $id->typeOfIdentification;
        $createUser->identification_num = $id->identification_num;
        $createUser->email = $id->email;
        $createUser->id_record_num = $id->id_record_num;
        $createUser->id_training_program = $id->id_training_program;
        $createUser->id_training_center = $id->id_training_center;
        $createUser->password = Hash::make($id->identification_num);

        $createUser->save();

        $id->delete();

        return redirect()->route('users')->with('message','Usuario aceptado con exito!');
    }

    /**
     * Si rechaza la solicitud, simplemente se eliminara y respondera en formato json para el datatables
     * @param UserRequest $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deny(UserRequest $id){
        if($id){
            $id->delete();
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }
}

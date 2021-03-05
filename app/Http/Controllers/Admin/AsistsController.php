<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistsController extends Controller
{
    public function asistencia(){
        $asists = Asist::all();

        return view('asist.asist-list', compact('asists'));
    }

    public function createasistencia($id){
        $nameUser = User::query()->where('id','=',$id)->first();

        $asist = new Asist();

        $asist->id_user = $id;
        $asist->name = $nameUser->name;
        $asist->createdBy = Auth::user()->email;

        $asist->save();

        return redirect()->route('users')->with('message','Asistencia creada correctamente!');
    }

    public function destroyasistencia(Asist $id){

        $id->delete();

        return redirect()->route('asistencia')->with('message','Asistencia eliminada correctamente!');
    }
}

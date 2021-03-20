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
    public function asistencia(){
        $asists = Asist::all();

        return view('asist.asist-list', compact('asists'));
    }

    public function createasistencia(User $id){

        $userRn = Record_num::query()->where('id',$id->id_record_num)->get()->first();

        $asist = new Asist();

        $asist->id_user = $id->id;
        $asist->name = $id->name;
        $asist->createdBy = Auth::user()->email;
        $asist->record_num = $userRn->record_num;

        $asist->save();

        return redirect()->route('users')->with('message','Asistencia creada correctamente!');
    }

    public function destroyasistencia(Asist $id){

        $id->delete();

        return redirect()->route('asistencia')->with('message','Asistencia eliminada correctamente!');
    }
}

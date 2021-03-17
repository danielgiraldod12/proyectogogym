<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Record_num;
use App\Models\Training_center;
use App\Models\Training_program;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Models\States_event;
use App\Http\Controllers\Controller;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Database\QueryException;

class AdminController extends Controller

{

    public function dompdfuser($id){ //Le paso el id

    $datatables = User::query()->where('users.id','=',$id) //Creo la variable datatables con el modelo User y el metodo query y hago el where con el id de usuario
            ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
            ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
            ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
            ->select([ //Selecciono
                'users.id', //Id de Usuario
                'users.typeOfIdentification', //Tipo de Doc
                'users.identification_num', //Num de Doc
                'users.name', //Nombre usuario
                'users.email', //Email usuario
                'record_nums.record_num', //Ficha del usuario con inner join
                'training_programs.name_program', //Programa del usuario con inner join
                'training_centers.name_center']) //Centro del usuario con inner join
            ->first(); //Creo la variable datatables con el modelo User y el metodo query*/

        $pdf = PDF::loadView('pdf.userpdf', compact ('datatables'));

        return $pdf->download('user-list.pdf');

      //return view('pdf.userpdf');
    }

    public function dashboard(){

        $NumUsers = User::all()->count(); //Estoy contando todos los registros de la tabla users
        $NumFichas = Record_num::all()->count(); //Estoy contando todos los registros de la tabla fichas
        $NumEvents = Event::all()->count(); //Estoy contando todos los registros de la tabla eventos

        return view('dashboard', compact('NumUsers', 'NumFichas', 'NumEvents')); //mostrar numero de usurios,eventos y fichas en la vista dashboard
    }

    public function users(){

        //Consulta para tabla usuarios
        $datatables = User::query() //Creo la variable datatables con el modelo User y el metodo query
            ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
            ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
            ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
            ->select([ //Selecciono
                'users.id', //Id de Usuario
                'users.typeOfIdentification', //Tipo de Doc
                'users.identification_num', //Num de Doc
                'users.name', //Nombre usuario
                'users.email', //Email usuario
                'record_nums.record_num', //Ficha del usuario con inner join
                'training_programs.name_program', //Programa del usuario con inner join
                'training_centers.name_center']) //Centro del usuario con inner join
            ->get();
        //Le retorno la vista al controlador y le digo que puede usar la variable datatables en la vista con el compact

        return view('user/users', compact('datatables'));
    }

    public function create(){
        /* Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario create */
        $queryCentro = Training_center::all();
        $queryPrograma = Training_program::all();
        $queryFicha = Record_num::all();
        // Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
        return view('user/create', compact('queryFicha','queryPrograma','queryCentro'));
    }

    public function crear(Request $request){

        $id = new User(); //Le digo que me cree un nuevo registro en el modelo User
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista create y los guarde en cada columna de la tabla users */

        $id->name = $request->name;
        $id->email = $request->email;
        $id->typeOfIdentification = $request->typeOfIdentification;
        $id->identification_num = $request->identification_num;
        $id->id_record_num = $request->id_record_num;
        $id->id_training_program = $request->id_training_program;
        $id->id_training_center = $request->id_training_center;
        $id->password = Hash::make($request->identification_num);
        $id->assignRole('Usuario');

        //$id->save(); //Le digo que guarde la informacion

        try {
            $error = !$id->save();
        } catch (QueryException $e) {
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡El correo electronico y/o el numero de identidad ya estan en uso!";
            }
        }

        if (!$error) {
            /* Le digo que me redireccione a la vista de datatables con un mensaje */
            return redirect()->route('users' , $id)->with('message','¡Usuario creado satisfactoriamente!');
        } else {
            return redirect()->route('create' , $id)->with('message', $message);
        }
    }

    public function edit(User $id){
        /* Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario edit */
        $training_center = Training_center::all();
        $training_program = Training_program::all();
        $record_num = Record_num::all();

        $query = $id; //Le mando la id

        return view('user/edit', compact('id','query','training_program','training_center','record_num'));
    }

    public function update(Request $request, User $id){
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista edit y actualice el registro correspondiente */
        $id->name = $request->name;
        $id->email = $request->email;
        $id->typeOfIdentification = $request->typeOfIdentification;
        $id->identification_num = $request->identification_num;
        $id->id_record_num = $request->id_record_num;
        $id->id_training_program = $request->id_training_program;
        $id->id_training_center = $request->id_training_center;
        if($request->password){
            $id->password = Hash::make($request->password);
        }

        try {
            $error = !$id->save();
        } catch (QueryException $e) {
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "¡El correo electronico y/o el numero de identidad ya estan en uso, volveremos a poner los datos que tenia antes!";
            }
        }

        if (!$error) {
            /* Le digo que me redireccione a la vista de datatables con un mensaje */
            return redirect()->route('users' , $id)->with('message','¡Actualizacion de usuario satisfactoria!');
        } else {
            //$request->session()->flash('danger', $message ? $message : 'Error inesperado al intentar almacenar el usuario.');
            return redirect()->route('edit' , $id)->with('message', $message);
        }

    }

    public function destroy(User $id){
        $id->delete(); //Le digo que elimine un registro utilizando la variable id y el metodo delete
        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('users' , $id)->with('message','¡Eliminación de usuario satisfactoria!');
    }

    public function profile(){
        $user = Auth::user();

        return view("profile")->with("user", $user);
        //return view('profile'); //Vista perfil
    }

    public function updateprofile(Request $request, User $id){
        $user = Auth::user();
        $UserPassword = User::query()->select('password')->where('id',$id)->first();
        if ($request->current_password == $UserPassword) {
            $id->password = $request->password;
            $id->save();
        }
        return redirect()->route('dashboard.profile');
    }

}


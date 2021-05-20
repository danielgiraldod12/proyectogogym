<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asist;
use App\Models\Event;
use App\Models\Record_num;
use App\Models\Training_program;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use DataTables;
use DB;

class AjaxController extends Controller
{
    /**
     * Hago una consulta a la tabla usuarios haciendo con diferentes inner joins y
     * un left join para traer informacion de otras tablas
     * @return mixed
     * @throws \Exception
     */
   public function ajaxUser(){
       $users = User::query() //Creo la variable datatables con el modelo User y el metodo query
       ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
       ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
       ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
       ->leftJoin('asists','asists.id_user','=','users.id') // Left join con asists
       ->select([ //Selecciono
           'users.id', //Id de Usuario
           'users.typeOfIdentification', //Tipo de Doc
           'users.identification_num', //Num de Doc
           'users.name', //Nombre usuario
           'users.email', //Email usuario
           'record_nums.record_num', //Ficha del usuario con inner join
           'training_programs.name_program', //Programa del usuario con inner join
           'training_centers.name_center',//Centro del usuario con inner join
            DB::raw('count(`asists`.`id_user`) as cantAsists')]) //Cantidad de asistencias que tiene el usuario con left join
       ->groupBy('users.id') //Agrupo por id de usuario
       ->get();

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */

       return datatables()->of($users)
           ->toJson();

   }

    /**
     * Creo una consulta que me trae todos los registro de la tabla asists
     * @return mixed
     * @throws \Exception
     */

   public function ajaxAsist(){

       $asists = Asist::all();

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */

       return datatables()->of($asists)->toJson();
   }

    /**
     * Creo una consulta a la tabla fichas con un inner join
     * @return mixed
     * @throws \Exception
     */
   public function ajaxRecordnum(){
       $Records = Record_num::query() //Creo la variable datatables con el modelo User y el metodo query
       ->join('training_programs','training_programs.id', '=', 'record_nums.id_training_program') //Inner join con la tabla programa
       ->select([ //Selecciono
           'record_nums.id', //Id de ficha
           'record_nums.record_num', //Nombre ficha
           'training_programs.name_program' //Programa de la ficha con inner join
       ])
       ->get();

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */

       return datatables()->of($Records)->toJson();
   }

    /**
     *
     * Creo una consulta que me trae todos los registros de la tabla eventos
     * @return mixed
     * @throws \Exception
     */
   public function ajaxEvent(){


       $events = Event::query() //Creo la variable datatables con el modelo event y el metodo query
       ->select([ //Selecciono
           'events.id', //Id de evento
           'events.title', //Titulo evento
           'events.date', //Fecha del evento
           'events.description', //Descripcion de evento
           'events.state', //Estado del evento
       ])
       ->get();

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */

       return datatables()->of($events)->toJson();
   }
   public function ajaxProgram(){
       /**
        * Creo una consulta que me trae todos los registros de la tabla programas
        */
       $programs = Training_program::all(); //Creo la variable datatables con el modelo event y el metodo query

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */

       return datatables()->of($programs)->toJson();
   }

    /**
     *
     * Hago una consulta a la tabla solicitud de usuarios haciendo diferentes inner joins
     * para traer informacion de otras tablas
     * @return mixed
     * @throws \Exception
     */
   public function ajaxRequests(){
       $usersRequests = UserRequest::query() //Creo la variable datatables con el modelo User y el metodo query
       ->join('record_nums','record_nums.id', '=', 'user_requests.id_record_num') //Inner join con la tabla ficha
       ->join('training_programs','training_programs.id', '=', 'user_requests.id_training_program') //Inner join con la tabla programa
       ->join('training_centers','training_centers.id', '=', 'user_requests.id_training_center') //Inner join con la tabla centro
       ->select([ //Selecciono
           'user_requests.id', //Id de Usuario
           'user_requests.typeOfIdentification', //Tipo de Doc
           'user_requests.identification_num', //Num de Doc
           'user_requests.name', //Nombre usuario
           'user_requests.email', //Email usuario
           'record_nums.record_num', //Ficha del usuario con inner join
           'training_programs.name_program', //Programa del usuario con inner join
           'training_centers.name_center'
       ])//Centro del usuario con inner join
       ->get();

       /**
        * Retorno la informacion en formato json para poder utilizarla en el ajax
        * del datatables
        */
       return datatables()->of($usersRequests)->toJson();
   }

}

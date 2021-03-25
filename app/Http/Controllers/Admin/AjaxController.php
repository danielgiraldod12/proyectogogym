<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asist;
use App\Models\Event;
use App\Models\Record_num;
use App\Models\Training_program;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class AjaxController extends Controller
{
   public function ajaxUser(){
       $users = User::query() //Creo la variable datatables con el modelo User y el metodo query
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


       return datatables()->of($users)
           ->toJson();

   }

   public function ajaxAsist(){
       $asists = Asist::all();

       return datatables()->of($asists)->toJson();
   }

   public function ajaxRecordnum(){
       $Records = Record_num::query() //Creo la variable datatables con el modelo User y el metodo query
       ->join('training_programs','training_programs.id', '=', 'record_nums.id_training_program') //Inner join con la tabla programa
       ->select([ //Selecciono
           'record_nums.id', //Id de ficha
           'record_nums.record_num', //Nombre ficha
           'training_programs.name_program' //Programa de la ficha con inner join
       ])
       ->get();

       return datatables()->of($Records)->toJson();
   }

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

       return datatables()->of($events)->toJson();
   }
   public function ajaxProgram(){
       $programs = Training_program::all(); //Creo la variable datatables con el modelo event y el metodo query

       return datatables()->of($programs)->toJson();
   }


}

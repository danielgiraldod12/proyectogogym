<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContactanos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Retorno la vista principal
     */
    public function home()
    {
        return view('home'); //Le paso la vista principal
    }

    /**
     * Envio un correo de contacto con toda la informacion que venga por
     * el request
     */
    public function store(StoreContactanos $request){

        $correo=new ContactanosMailable($request->all());

        Mail::to('sweden@gmail.com')->send($correo);
        //dd($request->ip());
      return redirect()->route('home')->with('info','Mensaje enviado');
    }

    /**
     * Renderizo la vista de eventos y le mando la variable eventos
     */
    public function calendar(){

        /**
         * Hago una consulta a la tabla eventos para que me traiga los eventos
         * que esten activos y le pido que me lo convierta a array
         */
        $events = Event::query()->where('state','Activo')->get()->toArray();

        /**
         * Creo un array vacio
         */
        $eventos = array();

        /**
         * Recorro cada uno de los elementos de la consulta que hice antes con un foreach
         * y los guardo en un array, en la posicion title guardo el titulo y la descripcion
         * y la fecha la guardo en la posicion start, ya que asi me la pide el fullcalendar
         */
        foreach($events as $event){
            $evento = [
                'title' => $event['title']." | ".$event['description'],
                'start' => $event['date'],
            ];
            /**
             * Guardo el array anterior en el array vacio que cree antes
             */
            array_push($eventos,$evento);
        }
        return view('calendar' , compact('eventos'));
    }

}

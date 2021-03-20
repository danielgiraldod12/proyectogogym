<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContactanos;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        return view('home'); //Le paso la vista principal
    }
    public function store(StoreContactanos $request){

        $correo=new ContactanosMailable($request->all());

        Mail::to('sweden@gmail.com')->send($correo);
        //dd($request->ip());
      return redirect()->route('home')->with('info','Mensaje enviado');
    }

    public function calendar(){

        $events = Event::query()->where('state',1)->get()->toArray();

        $eventos = array();


        foreach($events as $event){
            $evento = [
                'title' => $event['title']." | ".$event['description'],
                'start' => $event['date'],
            ];
            array_push($eventos,$evento);
        }
//       dd($eventos);
        return view('calendar' , compact('eventos'));
    }

}

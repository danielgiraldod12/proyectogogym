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

      return redirect()->route('home')->with('info','Mensaje enviado');
    }

    public function calendar(){

//        $events = Event::query()->first();
//        $title = $events->title;
//        $date = $events->date;
//        $description = $events->description;
//        $state = $events->state;

        $events = Event::query()->get()->toArray();

        $titulo = array();
        $fecha = array();

        foreach($events as $event){
            array_push($titulo,$event['title']);
            array_push($fecha,$event['date']);
        }
//        dd($titulo,$fecha);
        return view('calendar' , compact('titulo','fecha'));
    }

}

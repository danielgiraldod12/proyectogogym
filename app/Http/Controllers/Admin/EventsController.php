<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\States_event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /* Eventos */

    public function events(){

        //Consulta para tabla eventos
        $datatablesEvent = Event::query() //Creo la variable datatables con el modelo event y el metodo query
        ->select([ //Selecciono
            'events.id', //Id de evento
            'events.title', //Titulo evento
            'events.date', //Fecha del evento
            'events.description', //Descripcion de evento
            'events.state', //Estado del evento
        ])
            ->get();

        //Le retorno la vista al controlador y le digo que puede usar la variable datatables en la vista con el compact
        return view('event/events', compact('datatablesEvent'));
    }

    public function createevents(){
        // Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
        return view('event/createevents');
    }

    public function crearevents(EventRequest $request){

        $id = new Event(); //Le digo que me cree un nuevo registro en el modelo event
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista create y los guarde en cada columna de la tabla events */

        $id->title = $request->title;
        $id->date = $request->date;
        $id->description = $request->description;
        $id->state = $request->state;

        $id->save(); //Le digo que guarde la informacion

        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('events' , $id)->with('message','¡Evento creado satisfactoriamente!');
    }

    public function editevents(Event $id){
        /* Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario edit */
        $stateEvents = States_event::all();

        $query = $id; //Le mando la id

        return view('event/editevents', compact('id','query','stateEvents'));
        //lo paso a la vista de editar eventos con el compact para utlizar el id query
    }

    public function updateevents(EventRequest $request, Event $id){
        /* Le digo que utilice el request para que llame la informacion de los
        inputs de la vista edit y actualice el evento correspondiente */
        $id->title = $request->title;
        $id->date = $request->date;
        $id->description = $request->description;
        $id->state = $request->state;

        $id->save(); //Le digo que guarde la informacion
        return redirect()->route('events' , $id)->with('message','¡Actualización de evento satisfactorio!');
    }

    public function destroyevents(Event $id){
        $id->delete(); //Le digo que elimine un registro utilizando la variable id y el metodo delete
        /* Le digo que me redireccione a la vista de datatables con un mensaje */
        return redirect()->route('events' , $id)->with('message','¡Eliminación de evento satisfactorio!');
    }
}

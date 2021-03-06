<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\States_event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Renderizo la tabla de eventos, aunque la informacion de la tabla se envia desde desde
     * la funcion ajaxEvents() que se encuentra en el controlador
     * app/Http/Controllers/Admin/AjaxController.php.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function events(){
        return view('event/events');
    }

    /**
     * Renderizo la vista del formulario para crear un evento
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createevents(){
        return view('event/createevents');
    }

    /**
     * Creo un registro en la tabla eventos utilizando la informacion que viene por el request
     * desde el formulario de crear evento.
     * @param EventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearevents(EventRequest $request){
        /**
         * Le digo que me cree un nuevo registro en el modelo event
         */

        $id = new Event();

        /**
         * Rellena la informacion con lo que viene por el request
         */
        $id->title = $request->title; //Titulo del evento
        $id->date = $request->date; //Fecha del evento
        $id->description = $request->description; //Descripcion del evento
        $id->state = $request->state; //Estado del evento
        $id->id_user = Auth::user()->id; //Id del usuario que creo el evento
        /**
         * Guarda el registro
         */
        $id->save();

        /**
         * Me redirecciona a la tabla eventos con un mensaje
         */
        return redirect()->route('events' , $id)->with('message','??Evento creado satisfactoriamente!');
    }

    /**
     * Renderizo la vista que contiene el formulario para editar un evento y con el compact
     * le mando las variables que quiero que utilice en la vista
     * @param Event $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editevents(Event $id){

        return view('event/editevents', compact('id'));
    }

    /**
     * Actualizo un registro de la tabla eventos con la informacion que viene en el request
     * del formulario de editar evento
     * @param EventRequest $request
     * @param Event $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateevents(EventRequest $request, Event $id){

        /**
         * Reemplaza la informacion del registro con la que viene en el request
         */

        $id->title = $request->title; //Titulo del evento
        $id->date = $request->date; //Fecha del evento
        $id->description = $request->description; //Descripcion del evento
        $id->state = $request->state; //Estado del evento

        /**
         * Guarda
         */
        $id->save();

        /**
         * Redirecciona a la tabla eventos con un mensaje
         */
        return redirect()->route('events' , $id)->with('message','??Actualizaci??n de evento satisfactorio!');
    }

    /**
     * Elimino un registro de la tabla eventos
     * @param Event $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyevents(Event $id){
        /**
         * Si viene el id, lo eliminara, si no retornara falso
         */
        if($id){
            $id->delete(); //Le digo que elimine un registro utilizando la variable id y el metodo delete
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }
}

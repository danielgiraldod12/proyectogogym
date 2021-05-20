<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Record_num;
use App\Models\Training_center;
use App\Models\Training_program;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContactanos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRequest;

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

    /**
     * Retorno la vista de registrarse y le paso las fichas, los programas y los centros
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function register(){
        $record_nums = Record_num::all();
        $training_programs = Training_program::all();
        $training_centers = Training_center::all();

        return view('auth.register', compact('record_nums','training_centers','training_programs'));
    }

    /**
     * Proceso de enviar solicitud de registro validado con otra tabla
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function requestUser(Request $request){

        /**
         * Hago una consulta a la tabla usuarios donde el num de doc sea igual a la que viene por el request
         * o donde el email sea igual a lo que viene por el request y cuento los registros que vienen
         * y lo guardo en la variable validation.
         */

        $validation = User::query()
            ->where('identification_num',$request->identification_num)
            ->orWhere('email', $request->email)
            ->count();

        /**
         * Si validation es igual a 0, es porque no existe ningun registro en la tabla usuarios
         * con ese doc o ese email, si es diferente de 0 es porque ya existe un registro en la tabla
         * usuario con esa informacion.
         */

        if($validation == 0){
            /**
             * Creo una nueva solicitud de usuario
             */
            $userRequest = new UserRequest();

            /**
             * Con lo que viene por el request
             */

            $userRequest->name = $request->name;
            $userRequest->email = $request->email;
            $userRequest->typeOfIdentification = $request->typeOfIdentification;
            $userRequest->identification_num = $request->identification_num;
            $userRequest->id_record_num = $request->id_record_num;
            $userRequest->id_training_program = $request->id_training_program;
            $userRequest->id_training_center = $request->id_training_center;
            $userRequest->password = Hash::make($request->identification_num);

            try {
                /**
                 * Aquí le asignaremos a la variable $error la respuesta del método save.
                 * La respuesta del método save puede ser un true si guardo o un false si no guardo.
                 * Si la respuesta es true es porque el proceso de guardado funcionó correctamente sin ningun error
                 * por lo cual se niega la respuesta de tal manera que quedará como false y le indique al try catch que no hay error el cual capturar.
                 * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
                 * por lo cual se niega la respuesta de tal manera que quedará como true y le indique al try catch que hay un error el cual capturar.
                 */
                $error = !$userRequest->save();
            } catch (QueryException $e) {
                /**
                 * Aquí simplemente le asignamos a la variable $error un true para indicarle a
                 * los siguiente procesos que contenga la función de que hubo un error con el
                 * proceso de guardado.
                 */
                $error = true;
                if ($e->getCode() === "23000") {
                    $message = "Ya existe una solicitud con este correo/num de identificacion!";
                }
            }

            /**
             * Si no hay ningun error a la hora de crear el usuario, se redirigira a la tabla usuarios
             * con el mensaje de que se creo correctamente, si hay algun error se recargara la pagina
             * con el mensaje de error que se asigno a la variable $message en el catch de antes.
             */

            if (!$error) {
                return redirect()->route('register')->with('message','¡Solicitud enviada al administrador!');
            } else {
                return redirect()->route('register')->with('message', $message);
            }

        }else{
            return redirect()->route('register')->with('message', 'Ya existe un usuario con este correo/num de identificacion!');
        }
    }
}

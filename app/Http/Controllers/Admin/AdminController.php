<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GeneralExport;
use App\Models\Asist;
use App\Models\UserRequest;
use Dompdf\Dompdf;
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
use App\Exports\UsersExport;
use App\Exports\AsistsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;

class AdminController extends Controller

{
    /**
     * Retorna los arrays de usuarios, asistencias, fichas y eventos al archivo GeneralExports ubicado
     * en la carpeta app/Exports/GeneralExport.php y que lo haga en un archivo llamado Informe General del Sistema - GoGym!.xlsx
     * en formato Excel.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function generalExcel(){

        $users = User::query() //Creo la variable datatables con el modelo User y el metodo query
        ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
        ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
        ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
        ->leftJoin('asists','asists.id_user','=','users.id')
            ->select([ //Selecciono
                'users.id', //Id de Usuario
                'users.name as Nombre', //Nombre usuario
                'users.email as Email', //Email usuario
                'users.typeOfIdentification as Tipo Doc', //Tipo de Doc
                'users.identification_num as Num Doc', //Num de Doc
                'record_nums.record_num as Ficha', //Ficha del usuario con inner join
                'training_programs.name_program as Programa', //Programa del usuario con inner join
                'training_centers.name_center as Centro', //Centro del usuario con inner join
                DB::raw('count(`asists`.`id_user`) as cantAsistencias')]) //Cant. de asistencias por usuario
            ->orderBy('id', 'asc') //Ordeno ascendentemente por el id
            ->groupBy('users.id') //Agrupo por el id de usuario
            ->get()->toArray();

        $asists = Asist::query()
            ->select([
                'id', //Id asistencia
                'name as Nombre', //Nombre al que pertenece la asistencia
                'id_user as IdUsuario', //Id al que pertenece la asistencia
                'record_num as Ficha', //Ficha al que pertenece la asistencia
                'createdBy as Creada por', //Creado por
            ])->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as Fecha") //Fecha en que se creo
            ->selectRaw("DATE_FORMAT(created_at, '%h:%i %p') as Hora") //Hora en que se creo
            ->orderBy('id','asc') //Ordenar ascendentemente por id
            ->get()->toArray();

        $record_nums = Record_num::query()
            ->join('training_programs','training_programs.id','=','record_nums.id_training_program')
            ->select([
                'record_nums.record_num as Ficha',
                'training_programs.name_program as Programa'
            ])
            ->get()->toArray();

        $events = Event::query()
        ->select([
            'id',
            'title as Titulo',
            'description as Descripcion',
            'date as Fecha',
            'state as Estado',
            'id_user as Creado por',
            'created_at as Fecha de creacion'
        ])->get()->toArray();

        $arrays = [$users,$asists,$events,$record_nums];

        return Excel::download(new GeneralExport($arrays), 'Informe General del Sistema - GoGym!.xlsx');
    }


    /**
     * Retorna la informacion que tiene el archivo UsersExport ubicado en la carpeta
     * app/Exports/UserExport.php y que lo haga en un archivo llamado Informe de Usuarios - GoGym!.xlsx en
     * formato Excel.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function usersExcel(){
        return Excel::download(new UsersExport, 'Informe de Usuarios - GoGym!.xlsx');
    }

    /**
     * Retorna la informacion que tiene el archivo UsersExport ubicado en la carpeta
     * app/Exports/AsistExport.php y que lo haga en un archivo llamado Informe de Asistencias - GoGym!.xlsx en
     * formato Excel.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function asistsExcel(){
        return Excel::download(new AsistsExport, 'Informe de Asistencias - GoGym!.xlsx');
    }

    /** Retorna la informacion de un usuario en especifico y me mande esa informacion a una vista
     * para poner esa informacion, despues le pido que me descargue la vista en formato pdf, con toda la
     * informacion del usuario.
     * @param $id
     * @return mixed
     */
    public function dompdfuser($id){ //Le paso el id
    $datatables = User::query()->where('users.id','=',$id) //Creo la variable datatables con el modelo User y el metodo query y hago el where con el id de usuario
            ->join('record_nums','record_nums.id', '=', 'users.id_record_num') //Inner join con la tabla ficha
            ->join('training_programs','training_programs.id', '=', 'users.id_training_program') //Inner join con la tabla programa
            ->join('training_centers','training_centers.id', '=', 'users.id_training_center') //Inner join con la tabla centro
            ->leftJoin('asists','asists.id_user','=','users.id')
            ->select([ //Selecciono
                'users.id', //Id de Usuario
                'users.typeOfIdentification', //Tipo de Doc
                'users.identification_num', //Num de Doc
                'users.name', //Nombre usuario
                'users.email', //Email usuario
                'record_nums.record_num', //Ficha del usuario con inner join
                'training_programs.name_program', //Programa del usuario con inner join
                'training_centers.name_center',  //Centro del usuario con inner join
                DB::raw('count(`asists`.`id_user`) as cantAsists')]) //Cuento la cantidad de asistencias del usuario
            ->first();

        $pdf = PDF::loadView('pdf.userpdf', compact ('datatables')); //Cargo la vista userpdf y le paso la informacion datatables

        /**
         * Retorna el pdf llamado user-list
         */
        return $pdf->download('user-list.pdf');

    }

    /**
     * Renderizo la vista inicial del dashboard, y en estas le adjunto tambien la informacion
     * de cuantos usuarios, fichas, eventos y programas han sido creados.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard(){
        /**
         * Con el modelo de cada tabla y el metodo all y count, puedo saber cuantos registros
         * de cada tabla hay.
         */
        $NumUsers = User::all()->count();
        $NumFichas = Record_num::all()->count();
        $NumEvents = Event::all()->where('state','Activo')->count();
        $NumPrograms = Training_program::all()->count();
        $NumRequests = UserRequest::all();
        /**
         * Retorno la vista dashboard y ademas con el compact le digo que puede utilizar las
         * variables
         */
        return view('dashboard', compact('NumUsers', 'NumPrograms', 'NumFichas', 'NumEvents','NumRequests')); //mostrar numero de usurios,eventos y fichas en la vista dashboard
    }

    /**
     * Renderizo la vista de la tabla de usuarios, aunque la informacion de la tabla se manda
     * desde la funcion ajaxUsers() que se encuentra en el controlador
     * app/Http/Controllers/Admin/AjaxController.php.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function users(){
        return view('user/users');
    }

    /**
     * Renderizo la vista del formulario crear usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function create(){
        /**
         * Hago las querys de cada tabla para posteriormente usarlas en los selects
         * del formulario crear usuario
         */
        $queryCentro = Training_center::all();
        $queryPrograma = Training_program::all();
        $queryFicha = Record_num::all();
        /**
         * Retorno la vista create y le digo que puede usar todas las variables creadas anteriormente
         */
        return view('user/create', compact('queryFicha','queryPrograma','queryCentro'));
    }

    /**
     * Creo un nuevo registro en la tabla usuarios
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crear(Request $request){

        $id = new User(); //Le digo que me cree un nuevo registro en el modelo User

        /** Le digo que utilice el request para que llame la informacion de los
        inputs de la vista create y los guarde en cada columna de la tabla users */
        $id->name = $request->name; //Nombre usuario
        $id->email = $request->email; //Email usuario
        $id->typeOfIdentification = $request->typeOfIdentification; //Tipo de documento usuario
        $id->identification_num = $request->identification_num; //Num de documento usuario
        $id->id_record_num = $request->id_record_num; //Ficha usuario
        $id->id_training_program = $request->id_training_program; //Programa usuario
        $id->id_training_center = $request->id_training_center; //Centro usuario

        /**
         * Si en el campo input viene alguna contrase??a, esa sera la que se guarde como
         * contrase??a en el registro, si no viene nada la contrase??a sera el num de identificacion
         * que haya ingresado el usuario.
         */
        if(!empty($request->password)){
            $id->password = Hash::make($request->password); //Contrase??a usuario
        }else{
            $id->password = Hash::make($request->identification_num); //Contrase??a usuario
        }

        /**
         * Se le asigna el rol de Usuario automaticamente
         */
        $id->assignRole('Usuario');

        /**
         * Se hace un try catch para verificar y controlar si hay errores
         * En el try catch se utilizara el QueryException para capturar el error en caso de que
         * exista alguno.
         */
        try {
            /**
             * Aqu?? le asignaremos a la variable $error la respuesta del m??todo save.
             * La respuesta del m??todo save puede ser un true si guardo o un false si no guardo.
             * Si la respuesta es true es porque el proceso de guardado funcion?? correctamente sin ningun error
             * por lo cual se niega la respuesta de tal manera que quedar?? como false y le indique al try catch que no hay error el cual capturar.
             * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
             * por lo cual se niega la respuesta de tal manera que quedar?? como true y le indique al try catch que hay un error el cual capturar.
             */
            $error = !$id->save();
        } catch (QueryException $e) {
            /**
             * Aqu?? simplemente le asignamos a la variable $error un true para indicarle a
             * los siguiente procesos que contenga la funci??n de que hubo un error con el
             * proceso de guardado.
             */
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "??El correo electronico y/o el numero de identidad ya estan en uso!";
            }
        }
        /**
         * Si no hay ningun error a la hora de crear el usuario, se redirigira a la tabla usuarios
         * con el mensaje de que se creo correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('users' , $id)->with('message','??Usuario creado satisfactoriamente!');
        } else {
            return redirect()->route('create' , $id)->with('message', $message);
        }
    }

    /**
     * Renderizo la vista del formulario de editar usuario y le mando informacion del
     * usuario que va a ser editado para que el formulario sea rellenado con esta
     * informacion
     * @param User $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function edit(User $id){
        /** Hago las querys de cada tabla para posteriormente usarlas en los selects
        del formulario edit */
        $training_centers = Training_center::all();
        $training_programs = Training_program::all();
        $record_nums = Record_num::all();

        /**
         * Retorno a la vista del formulario y con el compact le digo que estas variables que
         * defini en esta funcion, las podra utilizar en la vista.
         */
        return view('user/edit', compact('id','training_programs','training_centers','record_nums'));
    }

    /**
     * Edito un registro de la tabla usuarios
     * @param Request $request
     * @param User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $id){

        /**
         * Reemplazo la informacion del usuario con la informacion que viene en el request
         * del formulario de actualizar
         */
        $id->name = $request->name;
        $id->email = $request->email;
        $id->typeOfIdentification = $request->typeOfIdentification;
        $id->identification_num = $request->identification_num;
        $id->id_record_num = $request->id_record_num;
        $id->id_training_program = $request->id_training_program;
        $id->id_training_center = $request->id_training_center;
        /**
         * Si viene algo en el campo contrase??a, se cambiara, si no viene nada no hara nada
         */
        if($request->password){
            $id->password = Hash::make($request->password);
        }

        /**
         * Se hace un try catch para verificar y controlar si hay errores
         * En el try catch se utilizara el QueryException para capturar el error en caso de que
         * exista alguno.
         */
        try {
            /**
             * Aqu?? le asignaremos a la variable $error la respuesta del m??todo save.
             * La respuesta del m??todo save puede ser un true si guardo o un false si no guardo.
             * Si la respuesta es true es porque el proceso de guardado funcion?? correctamente sin ningun error
             * por lo cual se niega la respuesta de tal manera que quedar?? como false y le indique al try catch que no hay error el cual capturar.
             * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
             * por lo cual se niega la respuesta de tal manera que quedar?? como true y le indique al try catch que hay un error el cual capturar.
             */
            $error = !$id->save();
        } catch (QueryException $e) {
            /**
             * Aqu?? simplemente le asignamos a la variable $error un true para indicarle a
             * los siguiente procesos que contenga la funci??n de que hubo un error con el
             * proceso de guardado.
             */
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "??El correo electronico y/o el numero de identidad ya estan en uso, volveremos a poner los datos que tenia antes!";
            }
        }

        /**
         * Si no hay ningun error a la hora de editar el usuario, se redirigira a la tabla usuarios
         * con el mensaje de que se edito correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('users' , $id)->with('message','??Actualizacion de usuario satisfactoria!');
        } else {
            return redirect()->route('edit' , $id)->with('message', $message);
        }
    }

    /**
     * Elimino un registro de la tabla usuarios
     * @param User $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $id){

        /**
         * Si viene algun id, lo eliminara y respondera true, si no, retornara un falso que sera
         * interpretado por el ajax para saber si tiene que redibujar la informacion de la tabla o no.
         */
        if($id){
            $id->delete();
            return response()->json($id->delete());
        }else{
            return response()->json(false);
        }
    }

    /**
     * Renderizo la vista perfil y con el metodo Auth, le puedo retornar el usuario que
     * esta logeado en ese momento, y con el compact le mando esta informacion para que
     * la use en los campos de la vista.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(){
        $user = Auth::user();

        return view("profile", compact('user'));
    }

    /** Actualizo la contrase??a del usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatepassword(Request $request)
    {
        /**
         * Recupero el usuario que esta iniciado sesion en ese momento
         */
        $user = Auth::user();
        /**
         * Valido que la informacion ingresada en el campo contrase??a actual sea igual a la
         * que esta guardada en la base de datos, si devuelve true, continua con el otro if
         * y si devuelve false recarga la pagina con el mensaje de que la contrase??a no
         * coincide con la de la base de datos.
         */
        $current = $request->current_password;
        if (Hash::check($current, $user->password)) {
            /**
             * Si la informacion que se ingreso en los campos de contrase??a nueva y
             * confirmar contrase??a son iguales, cambiara la contrase??a y redireccionara con
             * el mensaje de contrase??a actualizada correctamente, si no le dira al usuario que
             * las contrase??as no coinciden
             */
            if ($request->password === $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('dashboard.profile')->with('message', 'Contrase??a actualizada correctamente');
            } else {
                return redirect()->route('dashboard.profile')->with('alert', 'La confirmacion de contrase??a es diferente a la que ingresaste antes');
            }
        } else {
            return redirect()->route('dashboard.profile')->with('alert', 'La contrase??a no coincide con tu contrase??a actual');
        }
    }

    /**
     * Actualiza el nombre y el correo del usuario que inicio sesion
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateprofile(Request $request){

        /**
         * Recupero el usuario que esta iniciado sesion en este momento
         */
        $user = Auth::user();

        /**
         * Reemplazo la informacion del usuario con la que viene por el request desde
         * la vista de profile (perfil)
         */
        $user->name = $request->name;
        $user->email = $request->email;

        /**
         * Se hace un try catch para verificar y controlar si hay errores
         * En el try catch se utilizara el QueryException para capturar el error en caso de que
         * exista alguno.
         */
        try {
            /**
             * Aqu?? le asignaremos a la variable $error la respuesta del m??todo save.
             * La respuesta del m??todo save puede ser un true si guardo o un false si no guardo.
             * Si la respuesta es true es porque el proceso de guardado funcion?? correctamente sin ningun error
             * por lo cual se niega la respuesta de tal manera que quedar?? como false y le indique al try catch que no hay error el cual capturar.
             * En caso de que la respuesta sea false es porque hubo un error en el proceso de guardado y se genero un error
             * por lo cual se niega la respuesta de tal manera que quedar?? como true y le indique al try catch que hay un error el cual capturar.
             */
            $error = !$user->save();
        } catch (QueryException $e) {
            /**
             * Aqu?? simplemente le asignamos a la variable $error un true para indicarle a
             * los siguiente procesos que contenga la funci??n de que hubo un error con el
             * proceso de guardado.
             */
            $error = true;
            if ($e->getCode() === "23000") {
                $message = "??El correo electronico y/o el numero de identidad ya estan en uso!";
            }
        }

        /**
         * Si no hay ningun error a la hora de editar el usuario, se redirigira a la tabla usuarios
         * con el mensaje de que se edito correctamente, si hay algun error se recargara la pagina
         * con el mensaje de error que se asigno a la variable $message en el catch de antes.
         */
        if (!$error) {
            return redirect()->route('dashboard.profile')->with('message', 'Informaci??n actualizada');
        } else {
            return redirect()->route('dashboard.profile')->with('message', $message);
        }
    }

}


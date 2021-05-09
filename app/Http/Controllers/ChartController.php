<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asist;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Renderizo la vista de la grafica de usuarios registrados por mes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chart1(){

        /**
         * Traigo la fecha actual y la convierto a objeto
         */
        $year = Carbon::now('GMT');
        $year->toObject();

        /**
         * Creo la variable months y llamo al modelo User y le digo que me seleccione
         * unicamente el mes de la columna created_at(creado en) con el alias mes y que
         * ademas lo cuente por id, y despues le digo que lo agrupe por el mes
         */
        $months = User::select([DB::raw("month(created_at) as mes"),DB::raw("count(id) as cantidad")])
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray(); //Le digo que me convierta la informacion en un array

        /**
         * Creo un array vacio para los meses
         */
        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        /**
         * For each para recorrer la consulta que hice antes
         */
        foreach ($months as $index => $month)
        {
            /**
             * Le pido que en la variable
             * datas me almacene la cantidad de usuarios reg en cada mes
             */
            $datas[$month['mes']-1]=$month['cantidad'];
        }
        /**
         * Le paso la vista chart1 y le digo que puede utilizar la variable datas
         */
        return view('charts/chart1', compact('datas','year'));
    }

    /**
     * Renderizo la vista grafica de usuarios registrados por fichas
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chart2(){
        /**
         * Creo la variable record_num y llamo el modelo User y le digo que haga un inner join
         * con la tabla record_nums y le digo que cuente nombre de la tabla user con el alias de cantidad
         * y tambien le digo que seleccione record_num con el alias ficha y despues que lo agrupe
         * por la ficha
         */
        $record_num = User::query()
            ->join('record_nums','record_nums.id', '=', 'users.id_record_num')
            ->select([DB::raw("count(name) as cantidad"),DB::raw("record_num as ficha")])
            ->groupBy(DB::raw("record_num"))
            ->get()->toArray(); //Le digo que me convierta la informacion en array
        /**
         * Creo arrays vacios para rellenarlos, ya que no se cuantas fichas habra en el momento y cuantos tendra
         */
        $ficha= array();
        $cantFicha = array();
        /**
         * Recorro la consulta que realizamos anteriormente
         */
        foreach ($record_num as $index => $record)
        {
            /**
             * Con el array push relleno los arrays vacios que cree con la informacion de la consulta que hice antes
             */
            array_push($ficha,$record['ficha']);
            array_push($cantFicha,$record['cantidad']);
        }
        /**
         * Le paso la vista chart2 y le digo que puede utilizar las variables ficha y cantFicha
         */
        return view('charts/chart2', compact('ficha','cantFicha'));
    }

    /**
     * Renderizo la vista de grafica de asistencias por ficha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chart3(){
        /**
         * Creo la variable asists y le pido que haga una consulta a la tabla asistencias, traigo el conteo de
         * ficha y traigo tambien la ficha y agrupo por ficha
         */
        $asists = Asist::query()
            ->select([DB::raw("count(record_num) as cantidad"),DB::raw("record_num as ficha")])
            ->groupBy(DB::raw("record_num"))
            ->get()->toArray();

        /**
         * Arrays vacios ya que no sabemos cuantas fichas habra en el momento ni cuantas asistencias habran
         */
        $ficha= array();
        $cantFicha = array();
        /**
         * Recorro la consulta que realizamos antes
         */
        foreach ($asists as $index => $record)
        {
            /**
             * Relleno los arrays vacios con la informacion de la consulta
             */
            array_push($ficha,$record['ficha']);
            array_push($cantFicha,$record['cantidad']);
        }
        /**
         * Le paso la vista chart2 y le digo que puede utilizar las variables ficha y cantFicha
         */
        return view('charts/chart3', compact('ficha','cantFicha'));
    }
}

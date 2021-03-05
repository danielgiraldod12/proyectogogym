<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\Record_NumsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\AsistsController;
use Illuminate\Support\Facades\Route;


/* Este archivo de rutas con la propiedad auth, sirve para que solo se pueda
acceder a estas rutas cuando el usuario este autenticado, haciendo uso del
RouteServiceProvider */


// A cada ruta le paso un metodo, una ruta, un controlador, una clase y un nombre

//Dashboard
Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('can:dashboard')->name('dashboard');
//DomPd
Route::get('dompdf/{id}', [AdminController::class, 'dompdfuser'])->middleware('can:dompdfuser')->name('dompdfuser');

//CRUD Users
Route::get('users', [AdminController::class, 'users'])->middleware('can:users')->name('users');
Route::get('users/create', [AdminController::class, 'create'])->middleware('can:create')->name('create');
Route::post('crear', [AdminController::class, 'crear'])->middleware('can:crear')->name('crear');
Route::get('users/{id}/edit', [AdminController::class, 'edit'])->middleware('can:edit')->name('edit');
Route::put('users/{id}', [AdminController::class, 'update'])->middleware('can:update')->name('update');
Route::delete('users/{id}/delete', [AdminController::class, 'destroy'])->middleware('can:destroy')->name('destroy');

//CRUD Ficha
Route::get('record_nums', [Record_NumsController::class, 'record_num'])->middleware('can:record_num')->name('record_num');
Route::get('record_nums/creatern', [Record_NumsController::class, 'creatern'])->middleware('can:creatern')->name('creatern');
Route::post('crearrn', [Record_NumsController::class, 'crearrn'])->middleware('can:crearrn')->name('crearrn');
Route::get('record_nums/{id}/edit', [Record_NumsController::class, 'editrn'])->middleware('can:editrn')->name('editrn');
Route::put('record_nums/{id}', [Record_NumsController::class, 'updatern'])->middleware('can:updatern')->name('updatern');
Route::delete('record_nums/{id}/delete', [Record_NumsController::class, 'destroyrn'])->middleware('can:destroyrn')->name('destroyrn');

//CRUD Eventos
Route::get('events', [EventsController::class, 'events'])->middleware('can:events')->name('events'); //vista donde visualizare los eventos
Route::get('events/createevents', [EventsController::class, 'createevents'])->middleware('can:createevents')->name('createevents'); //vista para ir al formulario de crear eventos
Route::post('crearevents', [EventsController::class, 'crearevents'])->middleware('can:crearevents')->name('crearevents'); // le paso la funcion de crear eventos
Route::get('events/{id}/edit', [EventsController::class, 'editevents'])->middleware('can:editevents')->name('editevents'); //vista paar editar los eventos
Route::put('events/{id}', [EventsController::class, 'updateevents'])->middleware('can:updateevents')->name('updateevents');//ruta pra actualizar los eventos
Route::delete('events/{id}/delete', [EventsController::class, 'destroyevents'])->middleware('can:destroyevents')->name('destroyevents');

//Roles

Route::get('roles', [RolesController::class, 'roles'])->middleware('can:roles')->name('roles');
Route::get('roles/{id}/edit', [RolesController::class, 'editroles'])->middleware('can:editroles')->name('editroles');
Route::put('roles/{id}', [RolesController::class, 'updateroles'])->middleware('can:updateroles')->name('updateroles');


//Asistencia

Route::get('asistencia', [AsistsController::class, 'asistencia'])->middleware('can:asistencia')->name('asistencia');
Route::post('createasist/{id}', [AsistsController::class, 'createasistencia'])->middleware('can:createasistencia')->name('createasistencia');
Route::delete('asistencia/{id}/delete', [AsistsController::class, 'destroyasistencia'])->middleware('can:destroyasistencia')->name('destroyasistencia');
//Perfil
Route::get('profile', [AdminController::class, 'profile'])->middleware('can:dashboard.profile')->name('dashboard.profile');


//Graficas usuarios
Route::get('dashboard/chart1', [ChartController::class, 'chart1'])->middleware('can:chart.first')->name('chart.first');
Route::get('dashboard/chart2', [ChartController::class, 'chart2'])->middleware('can:chart.second')->name('chart.second');




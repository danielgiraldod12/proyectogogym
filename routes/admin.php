<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\ProgramsController;
use App\Http\Controllers\Admin\Record_NumsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\AsistsController;
use App\Http\Controllers\Admin\AjaxController;
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
Route::get('users/edit/{id}', [AdminController::class, 'edit'])->middleware('can:edit')->name('edit');
Route::put('users/{id}', [AdminController::class, 'update'])->middleware('can:update')->name('update');
Route::delete('users/delete/{id}', [AdminController::class, 'destroy'])->middleware('can:destroy')->name('destroy');

//CRUD Fichas
Route::get('record_nums', [Record_NumsController::class, 'record_num'])->middleware('can:record_num')->name('record_num');
Route::get('record_nums/creatern', [Record_NumsController::class, 'creatern'])->middleware('can:creatern')->name('creatern');
Route::post('crearrn', [Record_NumsController::class, 'crearrn'])->middleware('can:crearrn')->name('crearrn');
Route::get('record_nums/edit/{id}', [Record_NumsController::class, 'editrn'])->middleware('can:editrn')->name('editrn');
Route::put('record_nums/{id}', [Record_NumsController::class, 'updatern'])->middleware('can:updatern')->name('updatern');
Route::delete('record_nums/{id}/delete', [Record_NumsController::class, 'destroyrn'])->middleware('can:destroyrn')->name('destroyrn');

//CRUD Programas
Route::get('programs', [ProgramsController::class, 'programs'])->middleware('can:programs')->name('programs');
Route::get('programs/createprogram', [ProgramsController::class, 'createprog'])->middleware('can:createprog')->name('createprog');
Route::post('crearprogram', [ProgramsController::class, 'crearprog'])->middleware('can:crearprog')->name('crearprog');
Route::get('programs/edit/{id}', [ProgramsController::class, 'editprog'])->middleware('can:editprog')->name('editprog');
Route::put('programs/{id}', [ProgramsController::class, 'updateprog'])->middleware('can:updateprog')->name('updateprog');
Route::delete('programs/{id}/delete', [ProgramsController::class, 'destroyprog'])->middleware('can:destroyprog')->name('destroyprog');

//CRUD Eventos
Route::get('events', [EventsController::class, 'events'])->middleware('can:events')->name('events'); //vista donde visualizare los eventos
Route::get('events/createevents', [EventsController::class, 'createevents'])->middleware('can:createevents')->name('createevents'); //vista para ir al formulario de crear eventos
Route::post('crearevents', [EventsController::class, 'crearevents'])->middleware('can:crearevents')->name('crearevents'); // le paso la funcion de crear eventos
Route::get('events/edit/{id}', [EventsController::class, 'editevents'])->middleware('can:editevents')->name('editevents'); //vista paar editar los eventos
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
Route::put('profile/{id}/update', [AdminController::class, 'updateprofile'])->name('updateprofile');

//Graficas usuarios
Route::get('dashboard/chart1', [ChartController::class, 'chart1'])->middleware('can:chart.first')->name('chart.first');
Route::get('dashboard/chart2', [ChartController::class, 'chart2'])->middleware('can:chart.second')->name('chart.second');
Route::get('dashboard/chart3', [ChartController::class, 'chart3'])->middleware('can:chart.third')->name('chart.third');

//Ajax
Route::get('user/ajax', [AjaxController::class, 'ajaxUser'])->middleware('can:ajax.user')->name('ajax.user');
Route::get('asist/ajax', [AjaxController::class, 'ajaxAsist'])->middleware('can:ajax.asist')->name('ajax.asist');
Route::get('record_nums/ajax', [AjaxController::class, 'ajaxRecordnum'])->middleware('can:ajax.record_num')->name('ajax.record_num');
Route::get('events/ajax', [AjaxController::class, 'ajaxEvent'])->middleware('can:ajax.event')->name('ajax.event');
Route::get('programs/ajax', [AjaxController::class, 'ajaxProgram'])->middleware('can:ajax.program')->name('ajax.program');

//Excel
Route::get('users/excel', [AdminController::class, 'usersExcel'])->name('users.excel');
Route::get('asists/excel', [AdminController::class, 'asistsExcel'])->name('asists.excel');

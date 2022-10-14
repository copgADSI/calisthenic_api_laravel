<?php

use App\Http\Controllers\Excercises\ExcercisesController;
use App\Http\Controllers\statistics\StatisticsController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('checkStatus')->controller(ExcercisesController::class)->group(function () {
    Route::get('listado', 'index')->name('excercises.list');
    Route::get('formulario_crear_ejecicio', 'create')->name('excercises.create');
    Route::post('actualizar_ejecicio', 'update_excercise')->name('excercises.update_data');
});

Route::middleware(['auth'])->controller(UsersController::class)->group(function () {
    Route::get('listado_usuarios', 'index')->name('users.index');
    Route::get('generar_datos', 'generate_data')->name('users.generate_data');
    Route::post('actualizar_usuario', 'update_user')->name('users.update_data');
    Route::get('cambiar_estado', 'changeUserState')->name('users.stateChange');
});


Route::middleware(['auth'])->controller(StatisticsController::class)->group(function () {
    Route::get('estadisticas', 'index')->name('charts.index');
});

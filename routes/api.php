<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\Excercises\ExcercisesController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Middleware\CheckStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/* LOGIN DESDE APLICACIONES EXTERNAS */
Route::post('user-login', [UserController::class, 'login'])->name('user.login_');
Route::post('user-create', [UserController::class, 'create'])->name('user.create');
Route::group(['middleware => auth:sanctum'], function () {
    Route::get('user-profile',  [UserController::class, 'profile'])->name('user.profile');
    Route::get('user-logout', [UserController::class, 'logout'])->name('user.logout');
});

Auth::routes();


Route::get('getAllExcercises',  [ExcercisesController::class, 'getAllExcercises'])->name('getAllExcercises');

Route::middleware(['auth'])->controller(ExcercisesController::class)->group(function () {
    Route::post('crear_ejecicio', 'store')->name('excercises.store');
    Route::post('actualizar_ejecicio', 'update')->name('excercises.update');
    Route::get('listado_ejecicios', 'get_excercises')->name('excercises_list');
    Route::get('eliminar_ejecicio', 'destroy')->name('excercises.destroy');
});


Route::middleware(['auth'])->controller(UsersController::class)->group(function () {
    Route::get('eliminar_usuario', 'destroy')->name('users.destroy');
});

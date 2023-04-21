<?php

use App\Http\Controllers\PhaseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('auth.md2-login');
}); */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('inicio', function(){
        return view('inicio');
    });
});

Route::get('/', function () { // Arregle un error, cuando quieres ir a la url "sspis.test" sin sesion, te retornara a la vista de login
    if (auth()->check()) {    // pero si ya tienes sesion iniciada y quieres ir a "sspis.test" entonces te retorna a la vista de inicio
        return view('/inicio');
    }
        return view('auth.md2-login');
    })->name('dashboard');

Route::post('program/users/{user}/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');
Route::resource('users', UserController::class)->middleware('auth');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');//Para mostrar un proyectos con su info.
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');//Para crear los proyectos

Route::resource('phases', PhaseController::class)->middleware('auth'); // aqui dejo de una vez el controlador de phases 
Route::post('projects/phases', [PhaseController::class, 'store'])->name('projects.phases.store');//Para crear las fases de un proyecto (no se usa el index o show ya que esa info. se ve desde el show del proyecto)

Route::post('projects/phases/tasks', [TaskController::class, 'store'])->name('projects.phases.tasks.store');//Para crear las tareas de la fase de un proyecto (mismo caso de arriba)

Route::resource('users', UserController::class);






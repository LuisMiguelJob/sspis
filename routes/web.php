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

Route::get('/', function () {
    return view('auth.md2-login');
});

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

Route::controller(ProjectController::class)->group(function(){//Controller para crear y moverse entre los detalles del proyecto (el show muestra las fases y las tareas)
    Route::get('projects', 'index')->name('projects.index');//Pagina para ver los proyectos
    Route::get('projects/create_project', 'create_project')->name('projects.create_project');//Para crear los proyectos
    Route::get('projects/{id}', 'show')->name('projects.show');//Para ver un proyecto
    Route::post('projects', 'store')->name('projects.store');//Para guardar un proyecto
});

Route::controller(PhaseController::class)->group(function(){//Controller para crear fases del proyecto
    Route::post('projects/phases', 'store')->name('projects.phases.store');
});

Route::controller(TaskController::class)->group(function(){//Controller para crear tareas de la fase del proyecto
    Route::post('projects/phases/tasks', 'store')->name('projects.phases.tasks.store');
});

Route::resource('users', UserController::class)->middleware('auth');



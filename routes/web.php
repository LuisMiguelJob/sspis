<?php

use App\Http\Controllers\calendarioController;
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
    })->name('inicio')->middleware('can:inicio');
});

Route::get('/', function () { // Arregle un error, cuando quieres ir a la url "sspis.test" sin sesion, te retornara a la vista de login
    if (auth()->check()) {    // pero si ya tienes sesion iniciada y quieres ir a "sspis.test" entonces te retorna a la vista de inicio
        return view('/inicio');
    }
        return view('auth.md2-login');
    })->name('dashboard');

Route::post('program/users/{user}/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth')->middleware('auth');

Route::get('projects/{project}/workers', [ProjectController::class, 'workers'])->name('projects.workers')->middleware('auth');
Route::post('projects/{project}/addWorker', [ProjectController::class, 'addWorker'])->name('projects.addWorker')->middleware('auth');
Route::get('projects/{project}/{user}/removeWorker', [ProjectController::class, 'removeWorker'])->name('projects.removeWorker')->middleware('auth');
Route::resource('projects', ProjectController::class)->middleware('auth');

Route::get('/phases/{project}/create',[PhaseController::class, 'create'])->name('phases.create');
Route::get('/phases/{phase}/{project}/edit',[PhaseController::class, 'edit'])->name('phases.edit');
Route::resource('phases', PhaseController::class, ['except' => ['edit', 'create']])->middleware('auth');

Route::get('/tasks/{task}/{project}/finishTask', [TaskController::class, 'finishTask'])->name('tasks.finishTask');
Route::get('/tasks/{task}/{project}/addWorkerTask', [TaskController::class, 'addWorkerTask'])->name('tasks.addWorkerTask'); // Añadir trabajador a una tarea
Route::get('/tasks/{task}/{project}/show', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{project}/{phase}/create', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks/{task}/{project}/{phase}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::resource('tasks', TaskController::class, ['except' => ['edit', 'create', 'show']])->middleware('auth');

Route::get('/calendario-prueba', [calendarioController::class, 'index'])->name('calendario');



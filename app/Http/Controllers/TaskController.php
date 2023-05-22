<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project, Phase $phase)
    {
        return view('task.create', compact(['project', 'phase']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//Store de la tarea, una vez creada te redirige a la página para ver los detalles de ese proyecto con la nueva tarea
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'initial_date' => ['required', 'date'],
            'final_date' => ['required', 'date',],
        ]);
        
        $task = new Task();
        $task->name = $request->name;
        $task->progress = 0;
        $task->description = $request->description;
        $task->delivery = "";
        $task->initial_date = $request->initial_date;
        $task->final_date = $request->final_date;
        $task->phase_id = $request->phase_id;
        $task->project_id = $request->project_id;
        $task->save();
        return redirect()->route('projects.show', [$task->project_id, $task->phase_id, $task]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task, Project $project)
    {
        // comprobar si hay un registro donde el usuario sea lider del proyecto seleccionado
        $areYouLeader = Project::where('id', $project->id)->where('user_id', Auth::id())->get();

        /* Variable para traer los trabajadores relacionados en este proyecto, se agrega al lider como opcion elegible para ejecutar tareas */
        $usuariosProyecto = $project->users;
        $usuariosProyecto =  $usuariosProyecto->push(Auth::user());
        
        /*  */

        return view('task.show', compact(['task', 'project', 'usuariosProyecto', 'areYouLeader']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Project $project, Phase $phase)
    {
        return view('task.edit', compact(['task', 'project', 'phase']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'initial_date' => ['required', 'date'],
            'final_date' => ['required', 'date',],
        ]);
        
        $task->name = $request->name;
        $task->description = $request->description;
        $task->initial_date = $request->initial_date;
        $task->final_date = $request->final_date;
        $task->save();   
        return redirect()->route('projects.show', $task->project_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //$phase->users()->detach();
        $task->delete();
        return redirect()->route('projects.show', $task->project_id);
    }

    public function addWorkerTask(Request $request, Task $task, Project $project)
    { 
        $task->user_id = $request->worker_id;
        $task->delivery = "";
        $task->complete = false;
        $task->save();
        return redirect()->route('tasks.show', [$task, $project]);

    }

    public function finishTask(Request $request, Task $task, Project $project)
    { 
        if($task->complete){
            $task->complete = false;
        }
        else{
            $task->complete = true;
            $task->delivery = $request->description;
        }

        $task->save();

        return redirect()->route('tasks.show', [$task, $project]);
    }
}

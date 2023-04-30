<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyecto = Project::orderBy('id', 'desc')->paginate();
        return view('projects.index', compact('proyecto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show($id){//este show te lleva a la pagina para ver TODOS los detalles del proyecto; en caso de crear uno, como no tiene fase, se va como paremetro 0, y no muestrar ningúna fase, pq no hay
        $project = Project::find($id);
        $phases = Phase::where('project_id', $id)->get();
        $leader = User::where('id', $project->user_id)->get();//Recupera la info del usuario que crea el proyecto para mostrarlo en el show
        if(sizeof($phases) > 0)
            $tasks = Task::where('project_id', $id)->get();
        else
            $tasks = Task::where('phase_id', 0)->get();
        return view('projects.show', ['project'=>$project], compact('phases', 'tasks', 'leader'));
    }

    public function store(Request $request){//Store del proyecto sin fase ni tarea, una vez creado te redirige a la página para ver los detalles de ese proyecto
        $project = new Project();
        $project->name = $request->name;
        $project->progress = 0;
        $project->description = $request->description;
        $project->start_date = '2020-01-01 01:00:00';
        $project->final_date = '2020-01-01 01:00:00';
        $project->user_id = $request->user_id;
        $project->save();
        $phases = Phase::where('project_id', $request->id)->get();
        if(sizeof($phases) > 0)
            $tasks = Task::where('project_id', $request->id)->get();
        else
            $tasks = Task::where('phase_id', 0)->get();
        return redirect()->route('projects.show', [$project, $phases, $tasks]);//Los últimos 3 parametros, son para tomar el id del proyecto, las fases correspondientes al proceso e igual con las tareas; para ir a la vista de ese proyecto, la que está arriba de este método
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}

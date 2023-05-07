<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;
use Illuminate\Http\Request;

class PhaseController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//Store de la fase sin tarea, una vez creada te redirige a la página para ver los detalles de ese proyecto con la nueva fase
        $phase = new Phase();
        $phase->name = $request->name;
        $phase->progress = 0;
        $phase->description = $request->description;
        $phase->initial_date = $request->initial_date;
        $phase->final_date = $request->final_date;
        $phase->project_id = $request->project_id;
        $phase->save();
        $phases = Phase::where('project_id', $request->id)->get();
        $tasks = Task::where('project_id', $request->id)->get();

        //establece la primer y última fecha conforme se van agregando más fases para el proyecto
        $start_date = Phase::where('project_id', $request->project_id)->orderBy('initial_date', 'asc')->get();
        $final_date = Phase::where('project_id', $request->project_id)->orderBy('final_date', 'desc')->get();

        //hace update a las fechas del proyecto
        Project::where('id', $request->project_id)->update(['start_date' => $start_date[0]->initial_date]);
        Project::where('id', $request->project_id)->update(['final_date' => $final_date[0]->final_date]);


        return redirect()->route('projects.show', [$request->project_id, $phases, $tasks]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phase $phase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phase $phase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phase $phase)
    {
        //$phase->users()->detach();
        $phase->delete();

        //Este if evalua cuantas fases quedan, si queda solo una, toma las fechas de esa fase y se las asigna al proyecto, en lugar de tener fechas de fases anteriores que hayan sido borradas
        $phases = Phase::where('project_id', $phase->project_id)->get();
        if(sizeof($phases) == 1){
            $start_date = Phase::where('project_id', $phase->project_id)->orderBy('initial_date', 'asc')->get();
            $final_date = Phase::where('project_id', $phase->project_id)->orderBy('final_date', 'desc')->get();
            Project::where('id', $phase->project_id)->update(['start_date' => $start_date[0]->initial_date]);
            Project::where('id', $phase->project_id)->update(['final_date' => $final_date[0]->final_date]);
        }
    
        return redirect()->route('projects.show', $phase->project_id);
    }
}

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
        //
    }
}

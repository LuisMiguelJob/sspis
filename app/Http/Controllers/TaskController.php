<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//Store de la tarea, una vez creada te redirige a la página para ver los detalles de ese proyecto con la nueva tarea
        $task = new Task();
        $task->name = $request->name;
        $task->progress = 0;
        $task->description = $request->description;
        $task->comments = "";
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
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description;
        $task->initial_date = $request->initial_date;
        $task->final_date = $request->final_date;
        $task->save();   
        return redirect()->route('projects.show', $task->id);
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
}

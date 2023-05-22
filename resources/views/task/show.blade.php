@extends('layouts.plantilla-md2')

@section('title','Ver tarea')  

@section('content')

<a type="button" class="btn btn-success" href="{{ route("projects.show", $project->id) }}"> Regresar </a>

<div class="row mb-5">
    <div class="col-6">
        <div style="width:86.5%; margin:0px;" class="justify-content-start;">
            <div class="card card-body">
        
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h4 class="text-white mx-4 d-flex justify-content-center">
                        Tarea: {{ $task->name }} 
                    </h4> 
                </div>
        
                <div class="card-body p-1">
                    <div class="card-header pb-0">
                        <p><strong>Encargado de la tarea: 
                            @if($task->user_id == null)
                                "TRABAJADOR NO ASIGNADO"
                            @else   
                                {{ $task->user->name }}
                            @endif    
                        </strong></p>
                        <p>Descripcion: {{ $task->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Div para mostrar el titulo, descripición del proyecto y los botones de editar y eliminar-->
    @if (count($areYouLeader) > 0) 
        <div class="col-5">
            <div style="width:86.5%; margin:0px;" class="justify-content-start;">
                <div class="card card-body">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h4 class="text-white mx-4 d-flex justify-content-center">
                            Agregar/cambiar trabajador: 
                        </h4> 
                    </div>
                        <form action="{{ route('tasks.addWorkerTask', [$task, $project]) }}" method="PUT">
                            @csrf
                            <div class="card-header pb-0">
                            <div class="input-group input-group-static mb-4">
                                <select name="worker_id" class="form-control">
                                    @foreach ($usuariosProyecto as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option> 
                                    @endforeach
                                </select>
                                </div>
                            
                            <button type="submit" class="btn btn-info mb-4">
                                <span>Agregar</span>
                            </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    @endif
</div>


    


@endsection
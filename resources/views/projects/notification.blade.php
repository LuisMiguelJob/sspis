@extends('layouts.plantilla-md2')

@section('title','Projects')    

@section('content')

<a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Regresar </a>

<div class="card my-4">
    <div class="card-header">
        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h4 class="text-white mx-4">
                Notificaciones
            </h4> 
        </div>
    </div>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-x font-weight-bolder opacity-7">
                            Tarea
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-3">
                            Fecha Inicio/termino
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-3">
                            Indicacion
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-3">
                            Fecha entregada
                        </th>
                        <th class="text-secondary opacity-7">Ver</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center ps-3">
                                        <h6 class="mb-0 text-x">{{ $task->name }}</h6>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center ps-2">
                                        <h6 class="mb-0 text-x">{{$task->initial_date}} - {{ $task->final_date }}</h6>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center ps-2">
                                        
                                        @if($task->complete)
                                            <h6 class="mb-0 text-x" style="color: green"> 
                                                "ENTREGADA" 
                                                @if($task->finishTask_date > $task->final_date)
                                                    A TIEMPO
                                                @endif
                                            </h6>    
                                        @else
                                            <h6 class="mb-0 text-x" style="color:red"> 
                                                "NO ENTREGADO" 
                                            </h6>    
                                        @endif
                                        
                                    </div>
                                </td>

                                <th class=" d-flex flex-column justify-content-center ps-3">
                                    <h6 class="mb-0 mt-3 text-x">
                                        @if($task->finishTask_date != null)
                                            {{ $task->finishTask_date }}
                                        @else
                                            "NO ENTREGADO"
                                        @endif
                                        </h6>
                                </th>

                                <td class="align-middle">
                                    <a rel="tooltip" class="btn btn-info btn-link" href=" {{ route('tasks.show', [$task, $project]) }} ">
                                        ver
                                        <div class="ripple-container"></div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
  </div>

@endsection
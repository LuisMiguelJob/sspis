@extends('layouts.plantilla-md2')

@section('title', 'Projects')

@section('content')

<!--Estilo completamente opcional para el input de la fecha, pq el de la plantilla solo está para versión pro-->
<head>
    <style>
        input[type="date"] {
            position: relative;
        }

        /* create a new arrow, because we are going to mess up the native one
        see "List of symbols" below if you want another, you could also try to add a font-awesome icon.. */
        input[type="date"]:after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900; 
            content: "\f073";
            color: #555;
            padding: 0 5px;
        }

        /* change color of symbol on hover */
        input[type="date"]:hover:after {
            color: #bf1400;
        }

        /* make the native arrow invisible and stretch it over the whole field so you can click anywhere in the input field to trigger the native datepicker*/
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: auto;
            height: auto;
            color: transparent;
            background: transparent;
        }

        /* adjust increase/decrease button */
        input[type="date"]::-webkit-inner-spin-button {
            z-index: 1;
        }

        /* adjust clear button */
        input[type="date"]::-webkit-clear-button {
            z-index: 1;
        }
    </style>
</head>

<div id="Pfase" style="z-index:2; left:50%; transform:translate(-50%, 0%); text-align:center; position:fixed; width:60%; height:80%; display:none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-color: #81baeb; border-width: thick;">
    
            <form name="myform" action="{{route('phases.store')}}" method="POST"><!--Form para agregar una nueva fase-->
    
                @include('partials.form-errors')
                <div class="modal-header" style="background-color: #81baeb;">
                    <h3 class="modal-title" id="exampleModalLabel">Crear fase</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="createPhase()"></button>
                </div>
                <div class="modal-body">
                        @csrf
                        <input style="display:none" type="text" name="project_id" value="{{$project->id}}">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Nombre de la fase</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="input-group input-group-dynamic">
                            <textarea class="form-control" rows="5" placeholder="Descripcion del proyecto" spellcheck="false" name="description" required></textarea>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label>Fecha de inicio de la fase:</label>
                            <div class="input-group input-group-static">
                                <input id="initial_date" type="date" name="initial_date" onBlur="selectInitalDate(1)" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" required>
                            </div>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label>Fecha de finalización de la fase:</label>
                            <div class="input-group input-group-static">
                                <input id="final_date" type="date" name="final_date" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="createPhase()">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar fase</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="Para_ocultar"><!-- Este div solo existe para dar la sensasión de desenfoque cuando se agrega una fase, pero encierra todo el contendido del proyecto -->
    <a type="button" class="btn btn-primary" href="{{route('projects.index')}}"> volver a los proyectos </a>
    {{-- <h2>Project: {{$project->name}}</h2> --}}

        <div class="row mb-5">
            <div class="col-6">
                {{-- Informacion del proyecto --}}
                <div style="width:86.5%; margin:0px;" class="justify-content-start;">
                    <div class="card card-body">
                
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h4 class="text-white mx-4 d-flex justify-content-center">
                                Project: {{$project->name}}
                            </h4> 
                        </div>
                
                        <div class="card-body p-1">
                            <div class="card-header pb-0">
                                <p><strong>Encargado del proyecto: {{$leader[0]->name}}</strong></p>
                                <p>Descripción: {{$project->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!--Div para mostrar el titulo, descripición del proyecto y los botones de editar y eliminar-->
    @if (count($areYouLeader) > 0)
            <div class="col-4">
                {{-- Acciones en el proyecto --}}
                <div style="width:86.5%; margin:0px;" class="justify-content-start;">
                    <div class="card card-body">
                
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h4 class="text-white mx-4 d-flex justify-content-center">
                                Acciones: 
                            </h4> 
                        </div>
                            {{--  --}}

                            <div style="display:flex; margin-top:25px" class="justify-content-center">
                                <form action="{{route('projects.edit', $project->id)}}" method="GET">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-outline-secondary" style="padding:3px; margin-left:5px">
                                        <a class="btn btn-link text-dark text-gradient px-3 mb-0"><i class="material-icons" style="font-size: 2.5rem">edit</i></a>
                                    </button>
                                </form>
                
                                
                                <button type="submit" class="btn btn-outline-warning" style="padding:3px; margin-left:50px" data-bs-toggle="modal" data-bs-target="#EliminarProyectoModal">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="material-icons" style="font-size: 2.5rem">delete</i></a>
                                </button>
                
                                <!--Confirmacion para borrar el proyecto-->
                                <div class="modal fade" id="EliminarProyectoModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="">
                                        <div class="modal-content" style="border-color: #983434; border-width: thick;">
                                            <form action="{{route('projects.destroy', $project)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                    <div class="modal-header" style="background-color: #983434;">
                                                        <h3 style="color: white;">Eliminar proyecto "{{$project->name}}"</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-danger" type="submit">Si, eliminar proyecto</button> 
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>    
                
                            </div>

                            {{--  --}}
                    </div>
                </div>
            </div>

            
            
        </div>
    @endif

    {{-- Desde aqui empieza el fragmento de codigo donde se muestran las fases y las tareas --}}

    {{-- Aqui estara el nuevo diseño de fases y tareas --}}
    <h2 class="mb-4">Fases y tareas</h2>

    @if (count($areYouLeader) > 0) 
        <a style="margin-top: 5px;" href="{{ route('phases.create', $project) }}" type="button" class="btn btn-success">
            + Añadir fase
        </a>
    @endif  

    @foreach ($phases as $number=>$phase)
    
    <div class="row mb-5">
        <div class="col-6 " style="width:100%">
            <div class="col-12">
                {{-- Informacion del proyecto --}}
                <div style="width:100%; margin:0px;">
                    <div class="card card-body">
                
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h4 style="width:fit-content;float:left;" class="text-white mx-4 d-flex">
                                Fase {{ $number + 1 }} : "{{ $phase->name }}"
                            </h4> 
                            <h4 style="width:fit-content;float:right;" class="text-white mx-4 d-flex">
                                Fecha: {{ $phase->initial_date }} - {{ $phase->final_date }}
                            </h4> 
                        </div>

                        <div class="card-body p-1 mt-4 ps-4" style="height:fit-content;">
                            <p> DESCRIPCION: {{$phase->description}} </p> 
                        </div>

                        @if (count($areYouLeader) > 0) 
                            <div class="card-body p-1 ps-4" style="height:fit-content;">
                                <p class="ps-1 mt-2" style="width:fit-content;float:left;font-weight:bold">
                                    Acciones en la fase: 
                                </p>
                                    <p style="width:fit-content;float:left" class="ps-5">
                                        <a type="button" href="{{ route('tasks.create', [$project, $phase]) }}" class="btn btn-success">
                                            Añadir tarea
                                        </a>
                                    </p>
                                    <p style="width:fit-content;float:left" class="ps-5">
                                        <a style="width:100%;" href="{{ route('phases.edit', [$phase, $project]) }}" class="btn btn-info">
                                            Editar fase
                                        </a>
                                    </p>
                                    <p style="width:fit-content;float:left" class="ps-5">
                                        <button style="width:100%;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarFaseModal{{$phase->id}}">
                                            Eliminar fase
                                        </button>
                                        <!--Confirmacion para borrar la fase-->
                                        <div class="modal fade" id="EliminarFaseModal{{$phase->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="">
                                                <div class="modal-content" style="border-color: #983434; border-width: thick;">
                                                    <form action="{{route('phases.destroy', $phase)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                            <div class="modal-header" style="background-color: #983434;">
                                                                <h3 style="color:white">Eliminar la fase: "{{$phase->name}}"</h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button class="btn btn-danger" type="submit">Si, eliminar fase</button> 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </p>
                            </div>
                        @endif

                        {{-- Impresion de las tareas --}}

                        @foreach ($tasks as $task)
                            @if($task->phase_id == $phase->id)
                                <div class="card-body p-1">
                                    <div style="width:79%;float:left;" class="card-header pb-0 float:left d-flex">
                                        <div class="card card-body">
                                            <div class="bg-gradient-success shadow-success border-radius-lg pt-3 pb-2">
                                                <h4 style="width:fit-content;float:left;" class="text-white mx-4 d-flex">
                                                    Tarea: "{{ $task->name }}"
                                                </h4>
                                                
                                            </div>
                                            <div class="card-body p-1 mt-4 ps-4" style="height:fit-content;">
                                                <p> DESCRIPCION: {{$task->description}} </p> 
                                            </div>
                                            <div class="card-body p-1 ps-4" style="height:fit-content;">
                                                <p> fecha: {{$task->initial_date}} - {{ $task->final_date }} </p> 
                                            </div>
                                            <div class="card-body p-1 ps-4" style="height:fit-content;">
                                                <p> Encargado de la tarea: 
                                                    @if($task->user_id == null)
                                                        "TRABAJADOR NO ASIGNADO"
                                                    @else   
                                                        {{ $task->user->name }}
                                                    @endif  
                                                </p> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3"> {{-- div que contiene los botones --}}
                                        <div style="width:19%;float:left;" class="card-header pb-0 float:left d-flex d-flex justify-content-center">
                                            <p style="width:fit-content;float:left" class="">
                                                <a type="button" href="{{ route('tasks.show', [$task, $project]) }}" class="btn btn-success">
                                                    Ver tarea
                                                </a>
                                            </p>
                                        </div>
                                        @if (count($areYouLeader) > 0) 
                                            <div style="width:19%;float:left;" class="card-header pb-0 float:left d-flex d-flex justify-content-center">
                                                <p style="width:fit-content;float:left" class="">
                                                    <a style="width:100%;" href="{{ route('tasks.edit', [$task, $project, $phase]) }}" class="btn btn-info">
                                                        Editar tarea
                                                    </a>
                                                </p>
                                            </div>
                                            <div style="width:19%;float:left;" class="card-header pb-0 float:left d-flex d-flex justify-content-center">
                                                <p style="width:fit-content;float:left" class="">
                                                    <button style="width:100%;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarTareaModal{{$task->id}}">
                                                        Eliminar tarea
                                                    </button>

                                                    <!--Confirmacion para borrar la tarea-->
                                                    <div class="modal fade" id="EliminarTareaModal{{$task->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" style="">
                                                            <div class="modal-content" style="border-color: #983434; border-width: thick;">
                                                                <form action="{{route('tasks.destroy', $task)}}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                        <div class="modal-header" style="background-color: #983434;">
                                                                            <h3 style="color: white;">Eliminar la tarea: "{{$task->name}}" de la fase "{{$phase->name}}" </h3>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                        <button class="btn btn-danger" type="submit">Si, eliminar tarea</button> 
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    {{-- aqui termina la lectura de las fases y tareas --}}
    
    <!--Se muestra un 4each de cada fase de este proyecto, que se recupera desde el "show" que llega como parametro-->
    {{-- @foreach ($phases as $phase)

        <!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
        <div id="{{$phase->id}}" onclick="showInfo(1, {{$phase->id}})" style="cursor: pointer;box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16); border-radius: 0.5rem 0.5rem 0rem 0rem; background-color: darkgray; position:reative; height: 45px; color:black; padding: 8px; margin-top: 10px;">
            <!--Div para mostrar la barra de color según el progreso de la fase-->
            <div id="progressF1{{$phase->id}}" style="position:relative; left:0%; height:2px;"></div>
            <div style="display:flex;">
                <div style="width:50%"> Fase: {{$phase->name}} </div>
                <div style="display:flex; justify-content:flex-end; width:50%;">
                    <span style="margin-right: 43px" id="progressF2{{$phase->id}}" ></span>
                </div>         
            </div>
            
            @php
                {{
                    $df = new DateTime($phase->final_date);
                    $dCurr = new DateTime(date("Y-m-d"));                            
                    $diffDate = $dCurr->diff($df)->days;
                }}
            @endphp
            <script>
                //funcion par colorear la parte de abajo de la tarjeta según los días que quedan (verde si tienen más de 20 dias, amarillo si son mas de 10 pero menos de 20 y rojo si quedan menos de 4 días)
                if({{$diffDate}} >= 20){
                    document.getElementById("progressF1"+{{$phase->id}}).style.backgroundColor = "green";
                    document.getElementById("progressF2"+{{$phase->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                }else if({{$diffDate}} <= 20 && {{$diffDate}} >= 10){
                    document.getElementById("progressF1"+{{$phase->id}}).style.backgroundColor = "yellow";
                    document.getElementById("progressF2"+{{$phase->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                } else if({{$diffDate}} <= 10){
                    document.getElementById("progressF1"+{{$phase->id}}).style.backgroundColor = "red";
                    document.getElementById("progressF2"+{{$phase->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                }
            </script>

        </div>

        <div id="phase {{$phase->id}}" style="box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16); display:none; background-color:rgb(131, 131, 131); position:reative; height:auto; color:black; padding:10px;"><!--Div de cada tarea de la fase-->
            <div style="display:flex; flex-direction:column; width:85%;">
                Descripcion: {{$phase->description}}<br>{{$phase->initial_date}}  --  {{$phase->final_date}}
                <!--4each de cada tarea de la fase-->
                @foreach ($tasks as $task)
                    @if($task->phase_id == $phase->id)
                        <div id="{{$task->id}}" onclick="showInfo(2, {{$task->id}})" style="cursor: pointer; box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16); border-radius: 0.5rem 0.5rem 0rem 0rem; background-color:darkgray; position:relative; color:black; padding: 5px; margin-top: 5px;"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                            <!--Div para mostrar la barra de color según el progreso de la tarea-->
                            <div id="progressT1{{$task->id}}" style="position:relative; left:0%; height:2px;"></div>
                            <div style="display:flex; margin-top:5px;">
                                <div style="width:86%"> Tarea: {{$task->name}} </div>
                                <div style="display:flex; justify-content:flex-end; text-align:center; margin:0px 15px;">
                                    <span style="" id="progressT2{{$task->id}}" ></span>
                                </div>         
                            </div>
                        </div>
                        
                        <div id="task {{$task->id}}" style="box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.16); display:none; background-color:rgb(155, 155, 155);  position:reative; height:auto; color:black; padding:10px;"><!--Div de cada tarea de la fase-->
                            <div style="display:flex; flex-direction:column; width:84%;">
                                Descripcion: {{$task->description}}<br>{{$task->initial_date}}  --  {{$task->final_date}}<br>
                            </div>

                            <!--Divs para los botones dentro de la tarea, son en orden: añadir tarea, editar y borrar-->
                            @if (count($areYouLeader) > 0)
                                <div style="display:flex; flex-direction:column; margin:0px 15px; justify-content:flex-end; cursor:pointer;">
                                    <form action="{{route('tasks.edit', [$task, $project])}}" method="GET">
                                        @csrf
                                        <input type="hidden" name="task" value="{{ $task->id }}">
                                        <button style="width:100%;" type="submit" class="btn btn-info">
                                            Editar tarea
                                        </button>
                                    </form>                                            
                                    
                                    <button style="width:100%;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarTareaModal{{$task->id}}">
                                        - Eliminar tarea
                                    </button>

                                    <!--Confirmacion para borrar la tarea-->
                                    <div class="modal fade" id="EliminarTareaModal{{$task->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="">
                                            <div class="modal-content" style="border-color: #983434; border-width: thick;">
                                                <form action="{{route('tasks.destroy', $task)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                        <div class="modal-header" style="background-color: #983434;">
                                                            <h3 style="color:rgb(159, 183, 207);">Eliminar la tarea: "{{$task->name}}" de la fase "{{$phase->name}}" </h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button class="btn btn-danger" type="submit">Si, eliminar tarea</button> 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>                          
                                </div>
                            @endif
                        </div>

                        @php
                        {{
                            $df = new DateTime($task->final_date);
                            $dCurr = new DateTime(date("Y-m-d"));                            
                            $diffDate = $dCurr->diff($df)->days;
                        }}
                        @endphp
                        <script>
                            //funcion par colorear la parte de abajo de la tarjeta según los días que quedan (verde si tienen más de 20 dias, amarillo si son mas de 10 pero menos de 20 y rojo si quedan menos de 4 días)
                            if({{$diffDate}} >= 20){
                                document.getElementById("progressT"+{{$task->id}}).style.backgroundColor = "green";
                                document.getElementById("progressT"+{{$task->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            }else if({{$diffDate}} <= 20 && {{$diffDate}} >= 10){
                                document.getElementById("progressT1"+{{$task->id}}).style.backgroundColor = "yellow";
                                document.getElementById("progressT2"+{{$task->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            } else if({{$diffDate}} <= 10){
                                document.getElementById("progressT1"+{{$task->id}}).style.backgroundColor = "red";
                                document.getElementById("progressT2"+{{$task->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            }
                        </script>

                    @endif
                @endforeach

                <!--Form para agregar la tarea-->
                <div id="Ptask{{$phase->id}}" style="width:50%; display:none; position: relative; margin-top:10px" class="card card-body md-4">
                    <form action="{{route('tasks.store')}}" method="POST">
                        @csrf
                            <h2>Nueva tarea para la fase {{$phase->name}}</h2><br>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nombre de la tarea</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="input-group input-group-dynamic">
                                <textarea class="form-control" rows="5" placeholder="Descripcion de la tarea" spellcheck="false" name="description"></textarea>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label>Fecha de inicio de la tarea:</label>
                                <div class="input-group input-group-static">
                                    <input id="initial_date2" type="date" name="initial_date" onBlur="selectInitalDate(2)" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label>Fecha de finalización de la tarea:</label>
                                <div class="input-group input-group-static">
                                    <input id="final_date2" type="date" name="final_date" class="form-control datepicker" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <input style="display:none" type="text" name="phase_id" value="{{$phase->id}}"><br>
                            <input style="display:none" type="text" name="project_id" value="{{$phase->project_id}}">

                            <button class="btn btn-outline-success" type="submit">Crear tarea</button> 
                    </form>
                </div>
                
            </div>

            <!--Divs para los botones dentro de la fase, son en orden: añadir tarea, editar y borrar-->
            <div style="display:flex; flex-direction:column; margin:0px 20px 0px 35px; justify-content:flex-start; cursor: pointer;">
                @if (count($areYouLeader) > 0)
                    <div><button onclick="createTask({{$phase->id}})" type="button" class="btn btn-success">
                        + Añadir tarea
                    </button></div>
                    
                    <form action="{{route('phases.edit', [$phase, $project])}}" method="GET">
                        @csrf
                        <input type="hidden" name="phase" value="{{ $phase->id }}"> 
                        <button style="width:100%;" type="submit" class="btn btn-info">
                            Editar fase
                        </button>
                    </form>

                    <button style="width:100%;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarFaseModal{{$phase->id}}">
                        - Eliminar fase
                    </button>

                    <!--Confirmacion para borrar la fase-->
                    <div class="modal fade" id="EliminarFaseModal{{$phase->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="">
                            <div class="modal-content" style="border-color: #983434; border-width: thick;">
                                <form action="{{route('phases.destroy', $phase)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                        <div class="modal-header" style="background-color: #983434;">
                                            <h3 style="color:rgb(159, 183, 207);">Eliminar la fase: "{{$phase->name}}"</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-danger" type="submit">Si, eliminar fase</button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
    @endforeach --}}

    {{-- Aqui termina el codigo dedicado para fases y tareas --}}

</div>
    
    <script type="text/javascript">
        function createPhase() {
            //Función para desefoncar el resto de elementos excepto la ventana para crear un la fase de un proyecto
            if(document.getElementById("Pfase").style.display == "block"){
                document.getElementById("Pfase").style.display = "none";
                document.getElementById("sidenav-main").style.opacity = 1;
                document.getElementById("navbarBlur").style.opacity = 1;
                document.getElementById("Para_ocultar").style.opacity = 1;
            }else{
                document.getElementById("Pfase").style.display = "block";
                document.getElementById("sidenav-main").style.opacity = 0.5;
                document.getElementById("navbarBlur").style.opacity = 0.5;
                document.getElementById("Para_ocultar").style.opacity = 0.5;
            }
        }

        function showInfo(caso, number) {
            if(caso == 1){
                //Función para "aparecer" el cuadro de información, ya sea de la fase o de la tarea clickeada
                if(document.getElementById("phase "+number).style.display == "flex")
                    document.getElementById("phase "+number).style.display = "none";
                else
                    document.getElementById("phase "+number).style.display = "flex";
            }else{
                if(document.getElementById("task "+number).style.display == "flex")
                    document.getElementById("task "+number).style.display = "none";
                else
                    document.getElementById("task "+number).style.display = "flex";
            }
            
        }

        function createTask(task) {
            //Función para "aparecer" el cuadro para crear una tarea
            if(document.getElementById("Ptask"+task).style.display == "block")
                document.getElementById("Ptask"+task).style.display = "none";
            else
                document.getElementById("Ptask"+task).style.display = "block";
        }

        //funcion para que la fecha inicial de la fase no pueda ser despúes de la fecha final
        function selectInitalDate(caso) {
            if(caso == 1){
                var minToDate = document.getElementById("initial_date").value;
                document.getElementById("final_date").setAttribute("min", minToDate);
            }else{
                var minToDate = document.getElementById("initial_date2").value;
                document.getElementById("final_date2").setAttribute("min", minToDate);
            }
        }
    </script>
@endsection
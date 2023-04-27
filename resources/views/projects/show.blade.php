@extends('layouts.plantilla-md2')

@section('title', 'Projects')

@section('content')
    <h1>Project: {{$project->name}}</h1>
    <a href="{{route('projects.index')}}">volver a los proyectos</a><br><br>
    <p><strong>Encargado del proyecto: {{$leader[0]->name}}</strong></p>
    <p>Descripción: {{$project->description}}</p>

        @foreach ($phases as $phase)<!--Se muestra un 4each de cada fase de este proyecto, que se recupera desde el "show" que llega como parametro-->
            <div id="{{$phase->id}}" onclick="showInfo(1, {{$phase->id}})" style="background-color: darkgray; position:reative; height: 35px; color:black; padding: 5px; margin-top: 10px;"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                Fase: {{$phase->name}}  
            </div>
            <div id="phase {{$phase->id}}" style="display: none; background-color: rgb(86, 86, 86); position:reative; height: auto; color:black; padding: 5px;"><!--Div de cada tarea de la fase-->
                Descripcion: {{$phase->description}}<br>{{$phase->initial_date}}  --  {{$phase->final_date}}<br><br>
                @foreach ($tasks as $task)
                    @if($task->phase_id == $phase->id)
                        <div id="{{$task->id}}" onclick="showInfo(2, {{$task->id}})" style="background-color: rgb(131, 130, 130); position:reative; height: 35px; color:black; padding: 5px; margin-top: 5px;"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                            Tarea: {{($task->name)}} <br> 
                        </div>
                        <div id="task {{$task->id}}" style="display: none; background-color:rgb(131, 130, 130);  position:reative; height: auto; color:black; padding: 5px;"><!--Div de cada tarea de la fase-->
                            Descripcion: {{$task->description}}<br>{{$task->initial_date}}  --  {{$task->final_date}}<br><br>
                        </div>
                    @endif
                @endforeach
                <form action="{{route('tasks.store')}}" method="POST"><!--Form para agregar la tarea-->
                    @csrf
                    <button type="button" onclick="createTask({{$phase->id}})">Agregar tarea</button>
                    <div id="Ptask{{$phase->id}}" style="background-color: rgb(44, 159, 31); marging: 10px; position: relative; width:50%; display: none;">
                        <h2>Nueva tarea</h2><br>
                        <label>Nombre de la tarea:</label><br>
                        <input type="text" name="name" value=""><br>
                        <label>Descripcion de la tarea:</label><br>
                        <textarea name="description" rows="5">{{old('description')}}</textarea><br>
                        <label>Fecha de inicio de la tarea:</label><br>
                        <input type="date" min="{{$phases->last()->initial_date}}" max="{{$phases->last()->final_date}}" name="initial_date"><br><!-- toma el ultimo elemento del arreglo de las fases (que ya llegan solo las fases del proyecto que estamos viendo) y de ese último arreglo toma su fecha !-->
                        <label>Fecha de finalización de la tarea:</label><br>
                        <input type="date" min="{{$phases->last()->initial_date}}" max="{{$phases->last()->final_date}}" name="final_date"><br>
                        <input style="display:none" type="text" name="phase_id" value="{{$phase->id}}"><br>
                        <input style="display:none" type="text" name="project_id" value="{{$phase->project_id}}">

                        <button type="submit">Crear tarea</button>
                    </div><br> 
                </form>
            </div>
        @endforeach

    <form name="myform" action="{{route('phases.store')}}" method="POST"><!--Form para agregar una nueva fase-->
        @csrf
        <button type="button" onclick="createPhase()" style="margin-top: 10px">Agregar fase</button>
        <div id="Pfase" style="background-color: cornflowerblue; marging: 10px; position: relative; width:50%; display: none;">
            <h2>Nueva fase</h2><br>
            <label>Nombre de la fase:</label><br>
            <input type="text" name="name" value=""><br>
            <label>Descripcion de la fase:</label><br>
            <textarea name="description" rows="5">{{old('description')}}</textarea><br>
            <label>Fecha de inicio de la fase:</label><br>
            <input type="date" name="initial_date"><br><!-- toma el ultimo elemento del arreglo de las fases (que ya llegan solo las fases del proyecto que estamos viendo) y de ese último arreglo toma su fecha !-->
            <label>Fecha de finalización de la fase:</label><br>
            <input type="date" name="final_date"><br><br>
            <input style="display:none" type="text" name="project_id" value="{{$project->id}}">
            <button type="submit">Crear fase</button>
        </div><br> 
    </form>

    
    <script type="text/javascript">
        function showInfo(caso, number) {
            if(caso == 1){
                if(document.getElementById("phase "+number).style.display == "block")
                    document.getElementById("phase "+number).style.display = "none";
                else
                    document.getElementById("phase "+number).style.display = "block";
            }else{
                if(document.getElementById("task "+number).style.display == "block")
                    document.getElementById("task "+number).style.display = "none";
                else
                    document.getElementById("task "+number).style.display = "block";
            }
            
        }

        function createTask(task) {
            if(document.getElementById("Ptask"+task).style.display == "block")
                document.getElementById("Ptask"+task).style.display = "none";
            else
                document.getElementById("Ptask"+task).style.display = "block";
        }
        
        function createPhase() {
            document.getElementById("Pfase").style.display = "block";
        }

    </script>
@endsection
@extends('layouts.plantilla-md2')

@section('title', 'Projects')

@section('content')
    <h1>Project: {{$project->name}}</h1>
    <a href="{{route('projects.index')}}">volver a los proyectos</a><br><br>
    <p><strong>Encargado del proyecto: {{$project->user_id}}</strong></p>
    <p>Descripción: {{$project->description}}</p>

        @foreach ($phases as $phase)<!--Se muestra un 4each de cada fase de este proyecto, que se recupera desde el "show" que llega como parametro-->
            <div id="{{$phase->id}}" onclick="showTasks({{$phase->id}})" style="background-color: darkgray; position:reative; height: 35px; color:black; margin: 10px; padding: 5px"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                Fase: {{$phase->name}}    
            </div>
            <div id="task {{$phase->id}}" style="display: none; background-color: rgb(86, 86, 86); position:reative; height: auto; color:black; padding: 5px"><!--Div de cada tarea de la fase-->
                @foreach ($tasks as $task)
                    @if($task->phase_id == $phase->id)
                        Tarea: {{($task->name)}} <br>
                    @endif
                @endforeach
                <form action="{{route('tasks.store')}}" method="POST"><!--Form para agregar la tarea-->
                    @csrf
                    <button type="button" onclick="createTask({{$phase->id}})">Agregar tarea</button>
                    <div id="Ptask{{$phase->id}}" style="background-color: rgb(44, 159, 31); marging: 10px; position: relative; width:50%; display: none;">
                        <h2>Tarea <span id="PnTask"></span></h2><br>
                        <label>Nombre de la tarea:</label><br>
                        <input type="text" name="name" value=""><br>
                        <label>Descripcion de la tarea:</label><br>
                        <textarea name="description" rows="5">{{old('description')}}</textarea><br>
                        <label>ID de la fase:</label><br>
                        <input type="text" name="phase_id" value="{{$phase->id}}"><br>
                        @error('phase_id')
                        <br><small>*{{$message}}</small>
                        @enderror
                        <label>ID del proyecto:</label><br>
                        <input type="text" name="project_id" value="{{$phase->project_id}}">
                        @error('project_id')
                        <br><small>*{{$message}}</small>
                        @enderror
                        <button type="submit">Crear tarea</button>
                    </div><br> 
                </form>
            </div>
        @endforeach

    <form name="myform" action="{{route('phases.store')}}" method="POST"><!--Form para agregar una nueva fase-->
        @csrf
        <button type="button" onclick="createPhase()">Agregar fase</button>
        <div id="Pfase" style="background-color: cornflowerblue; marging: 10px; position: relative; width:50%; display: none;">
            <h2>Fase <span id="PnFase"></span></h2><br>
            <label>Nombre de la fase:</label><br>
            <input type="text" name="name" value=""><br>
            <label>Descripcion de la fase:</label><br>
            <textarea name="description" rows="5">{{old('description')}}</textarea><br>
            <label>ID del proyecto:</label><br>
            <input type="text" name="project_id" value="{{$project->id}}">
            @error('project_id')
            <br><small>*{{$message}}</small>
            @enderror
            <button type="submit">Crear fase</button>
        </div><br> 
    </form>

    
    <script type="text/javascript">
        var i = 0;
        var x = 0;

        function showTasks(task) {
            if(document.getElementById("task "+task).style.display == "block")
                document.getElementById("task "+task).style.display = "none";
            else
                document.getElementById("task "+task).style.display = "block";
        }

        function createTask(task) {
            if(document.getElementById("Ptask"+task).style.display == "block")
                document.getElementById("Ptask"+task).style.display = "none";
            else
                document.getElementById("Ptask"+task).style.display = "block";
        }
        
        function createPhase() {
            document.getElementById("PnFase").innerHTML = 1;
            document.getElementById("Pfase").style.display = "block";
        }

    </script>
@endsection
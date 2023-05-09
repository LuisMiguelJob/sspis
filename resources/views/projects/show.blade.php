@extends('layouts.plantilla-md2')

@section('title', 'Projects')

@section('content')

    <form name="myform" action="{{route('phases.store')}}" method="POST"><!--Form para agregar una nueva fase-->
        @csrf
        <div id="Pfase" style="z-index:2; left:50%; transform:translate(-50%, 0%); background-color:cornflowerblue; text-align:center; position:fixed; width:60%; height:80%; display:none;">
            <div id="titulo" style="display:flex">
                <div style="position:relative; width:10%; margin:0px">
                </div>
                <div style="position:relative; width:80%; margin:0px">
                    <h2>Nueva fase</h2>
                </div>
                <div style="position:relative; width:10%; margin:0px">
                    <a onclick="createPhase()"><h3>X</h3></a>
                </div>
            </div>
            <label>Nombre de la fase:</label><br>
            <input type="text" name="name" value=""><br>
            <label>Descripcion de la fase:</label><br>
            <textarea name="description" rows="5">{{old('description')}}</textarea><br>
            <label>Fecha de inicio de la fase:</label><br>
            <input id="initial_date" type="date" name="initial_date" onBlur="selectInitalDate(1)"><br>
            <label>Fecha de finalización de la fase:</label><br>
            <input id="final_date" type="date" name="final_date"><br><br>
            <input style="display:none" type="text" name="project_id" value="{{$project->id}}">
            <button type="submit">Crear fase</button>
        </div><br> 
    </form>

    <div id="Para_ocultar"><!-- Este div solo existe para dar la sensasión de desenfoque cuando se agrega una fase, pero encierra todo el contendido del proyecto -->
        <h1>Project: {{$project->name}}</h1>
        <a href="{{route('projects.index')}}">volver a los proyectos</a><br><br><!--Para regresar a las tarjetas de los proyectos -->
           
            <!--Div para mostrar el titulo, descripición del proyecto y los botones de editar y eliminar-->
            <div style="display:flex">
                <div style="position:relative; width:80%; margin:0px">
                    <p><strong>Encargado del proyecto: {{$leader[0]->name}}</strong></p>
                    <p>Descripción: {{$project->description}}</p>
                </div>
                <div style="position:relative; width:10%; text-align:center">
                    <a><img src='/Proyecto-ing2/resources/imgs/writing.png' width="50px" height="50px"></a> 
                </div>
                <div style="position:relative; width:10%; text-align:center">
                    <form action="{{route('projects.destroy', $project)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" style="background-color:transparent; border:none;">
                            <img src='/Proyecto-ing2/resources/imgs/trash.png'  width="50px" height="50px">
                        </button>
                    </form> 
                </div>
            </div>

            <!--Se muestra un 4each de cada fase de este proyecto, que se recupera desde el "show" que llega como parametro-->
            @foreach ($phases as $phase)
                <div id="{{$phase->id}}" onclick="showInfo(1, {{$phase->id}})" style="background-color: darkgray; position:reative; height: 39px; color:black; padding: 5px; margin-top: 10px;"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                    <!--Div para mostrar la barra de color según el progreso de la fase-->
                    <div id="progressF1{{$phase->id}}" style="position:relative; left:0%; height:2px;"></div>
                    <div style="display:flex;">
                        <div style="width:50%"> Fase: {{$phase->name}} </div>
                        <div style="display:flex; justify-content:flex-end; width:50%;">
                            <span style="margin-right: 40px" id="progressF2{{$phase->id}}" ></span>
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

                <div id="phase {{$phase->id}}" style="display:none; background-color:rgb(86, 86, 86); position:reative; height:auto; color:black; padding:5px;"><!--Div de cada tarea de la fase-->
                    <div style="display:flex; flex-direction:column; width:88%;">
                        Descripcion: {{$phase->description}}<br>{{$phase->initial_date}}  --  {{$phase->final_date}}
                        <!--4each de cada tarea de la fase-->
                        @foreach ($tasks as $task)
                            @if($task->phase_id == $phase->id)
                                <div id="{{$task->id}}" onclick="showInfo(2, {{$task->id}})" style="background-color: rgb(131, 130, 130); position:relative; height: 45px; color:black; padding: 5px; margin-top: 5px;"><!--"Abre" la ficha de la fase para ver y agregar tareas, solo está en display:none-->
                                    <!--Div para mostrar la barra de color según el progreso de la tarea-->
                                    <div id="progressT1{{$task->id}}" style="position:relative; left:0%; height:2px;"></div>
                                    <div style="display:flex; margin-top:5px">
                                        <div style="width:50%"> Tarea: {{$task->name}} </div>
                                        <div style="display:flex; justify-content:flex-end; width:50%;">
                                            <span style="margin-right: 30px" id="progressT2{{$task->id}}" ></span>
                                            <form action="{{route('tasks.destroy', $task)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button style="background-color:rgb(129, 24, 24); border-style:none; border-radius:100px; font-size:0.9rem;">
                                                    - Eliminar tarea
                                                </button>
                                            </form>
                                        </div>         
                                    </div>
                                </div>
                                <div id="task {{$task->id}}" style="display: none; background-color:rgb(131, 130, 130);  position:reative; height: auto; color:black; padding: 5px;"><!--Div de cada tarea de la fase-->
                                    Descripcion: {{$task->description}}<br>{{$task->initial_date}}  --  {{$task->final_date}}<br><br></div>
                                
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
                        <div id="Ptask{{$phase->id}}" style="z-index:1; background-color: rgb(44, 159, 31); margin: 10px; position: relative; width:50%; display: none;">
                            <form action="{{route('tasks.store')}}" method="POST">
                                @csrf
                                    <h2>Nueva tarea</h2><br>
                                    <label>Nombre de la tarea:</label><br>
                                    <input type="text" name="name" value=""><br>
                                    <label>Descripcion de la tarea:</label><br>
                                    <textarea name="description" rows="5">{{old('description')}}</textarea><br>
                                    <label>Fecha de inicio de la tarea:</label><br>
                                    <input id="initial_date2" type="date" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" onBlur="selectInitalDate(2)" name="initial_date"><br><!-- toma el ultimo elemento del arreglo de las fases (que ya llegan solo las fases del proyecto que estamos viendo) y de ese último arreglo toma su fecha !-->
                                    <label>Fecha de finalización de la tarea:</label><br>
                                    <input id="final_date2" type="date" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" name="final_date"><br>
                                    <input style="display:none" type="text" name="phase_id" value="{{$phase->id}}"><br>
                                    <input style="display:none" type="text" name="project_id" value="{{$phase->project_id}}">

                                    <button type="submit">Crear tarea</button> 
                            </form>
                        </div><br>
                    </div>

                    <!--Divs para los botones dentro de la fase, son en orden: añadir tarea, editar y borrar-->
                    <div style="display:flex; flex-direction:column; margin:0px 15px; justify-content:flex-start; cursor: pointer;">
                        <button onclick="createTask({{$phase->id}})" style="background-color:rgb(35, 129, 24); border-style:none; margin-top:10px; border-radius:100px; font-size:1rem;">+ Añadir tarea</button>
                        <button style="background-color:rgb(33, 95, 172); border-style:none; margin-top:10px; border-radius:100px; font-size:1rem;">Editar fase</button>
                        <form action="{{route('phases.destroy', $phase)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button style="background-color:rgb(129, 24, 24); border-style:none; margin-top:10px; border-radius:100px; font-size:1rem;">
                                - Eliminar fase
                            </button>
                        </form>
                    </div>
                    

                </div>
            @endforeach
            <button onclick="createPhase()" style="background-color:rgb(35, 129, 24); border-style:none; margin-top:10px; border-radius:100px; font-size:1.2rem;">
                + Añadir fase
            </button>

            
            
    </div>
    
    <script type="text/javascript">
        function showInfo(caso, number) {
            if(caso == 1){
                //Función para "aparecer" el cuadro de información, ya sea de la fase o de la tarea clickeada
                if(document.getElementById("phase "+number).style.display == "flex")
                    document.getElementById("phase "+number).style.display = "none";
                else
                    document.getElementById("phase "+number).style.display = "flex";
            }else{
                if(document.getElementById("task "+number).style.display == "block")
                    document.getElementById("task "+number).style.display = "none";
                else
                    document.getElementById("task "+number).style.display = "block";
            }
            
        }

        function createTask(task) {
            //Función para "aparecer" el cuadro para crear una tarea
            if(document.getElementById("Ptask"+task).style.display == "block")
                document.getElementById("Ptask"+task).style.display = "none";
            else
                document.getElementById("Ptask"+task).style.display = "block";
        }
        
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

        //funcion para que la fecha inicial de la fase no pueda ser despúes de la fecha final
        function selectInitalDate() {
            var minToDate = document.getElementById("initial_date").value;
            document.getElementById("final_date").setAttribute("min", minToDate);
        }
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
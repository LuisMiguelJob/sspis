@extends('layouts.plantilla-md2')

@section('title','Projects')    


@section('content')
<div id="Create_Project" style="z-index:2; left:50%; transform:translate(-50%, 0%); display: none; text-align: center; position: fixed; width:45%; height:50%; background-color: gray;">
    <!-- Este div originalmente era del createProject, pero desde que solo necesitamos 3 inputs, lo agregué como una ventana dentro de la página del show -->
    <div id="titulo" style="display:flex">
        <div style="position:relative; width:10%; margin:0px">
        </div>
        <div style="position:relative; width:80%; margin:0px">
            <h2>Crear proyecto</h2>
        </div>
        <div style="position:relative; width:10%; margin:0px">
            <a onclick="createProject()"><h3>X</h3></a>
        </div>
    </div>
    <form name="myform" action="{{route('projects.store')}}" method="POST">
        @csrf
        <label>Nombre del proyecto:<br> 
            <input type="text" name="name" value="{{old('name')}}">
        </label><br>
        @error('name')
        <br><small>*{{$message}}</small>
        @enderror
        <div style="display:none">
        <label>ID del lider del proyecto:
            <input type="text" name="user_id" value="{{$id = Auth::id()}}">
        </label>
        </div>
        @error('user_id')
        <br><small>*{{$message}}</small>
        @enderror
        <br><br>
        <label>Descripción del proyecto: <br>
            <textarea name="description" rows="5">{{old('description')}}</textarea><br>
        </label><br>
        @error('name')
        <br><small>*{{$message}}</small>
        @enderror
        <button type="submit">Crear proyecto</button>
    </form>
</div>

<h2>Projects</h2>
    @can('projects.create')
        <a onclick="createProject()">Crear proyecto</a><!-- este link abre la "ventana para crear un proyecto" -->    
    @endcan

    <div id="container" style="display: flex; flex-wrap: wrap;">
        @foreach ($proyecto as $proyectos)<!--Por cada proyecto que exista del lider se crea como una tarjetita-->
        <a href="{{route('projects.show', $proyectos->id)}}">
            <div style="position:relative; width: 250px; height: 250px; background-color: gray; margin: 10px; padding: 5px 5px 0px 5px">
                <h3>{{$proyectos->name}}</h3><br>
                {{$proyectos->description}}<br>
                @can('projects.workers')
                    <a href="{{route('projects.workers', $proyectos)}}">Agregar trabajadores</a><br>   
                @endcan
                @if($proyectos->start_date !== '2020-01-01')
                    {{$proyectos->start_date}} --- {{$proyectos->final_date}}<br>
                    <!--Div para mostrar la barra de color según el progreso del proyecto-->
                    <div id="progress{{$proyectos->id}}" style="z-index:1; position:absolute; left:0px; bottom:-1px; width: 250px;"> 
                         <!--Proceso para calcular la cantidad de dias restantes del proyecto-->
                        @php
                        {{
                            $df = new DateTime($proyectos->final_date);
                            $dCurr = new DateTime(date("Y-m-d"));                            
                            $diffDate = $dCurr->diff($df)->days;
                        }}
                        @endphp
                        <script>
                            //funcion par colorear la parte de abajo de la tarjeta según los días que quedan (verde si tienen más de 20 dias, amarillo si son mas de 10 pero menos de 20 y rojo si quedan menos de 4 días)
                            if({{$diffDate}} >= 20){
                                document.getElementById("progress"+{{$proyectos->id}}).style.backgroundColor = "green";
                                document.getElementById("progress"+{{$proyectos->id}}).style.color = "white";
                                document.getElementById("progress"+{{$proyectos->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            }else if({{$diffDate}} <= 20 && {{$diffDate}} >= 10){
                                document.getElementById("progress"+{{$proyectos->id}}).style.backgroundColor = "yellow";
                                document.getElementById("progress"+{{$proyectos->id}}).style.color = "black";
                                document.getElementById("progress"+{{$proyectos->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            } else if({{$diffDate}} <= 10){
                                document.getElementById("progress"+{{$proyectos->id}}).style.backgroundColor = "red";
                                document.getElementById("progress"+{{$proyectos->id}}).style.color = "white";
                                document.getElementById("progress"+{{$proyectos->id}}).innerHTML = "Quedan: "+{{$diffDate}}+" dias"
                            }
                    
                        </script>
                    </div>
                @endif
            </div>
        </a>
        @endforeach
    </div>

    <script>
        function createProject() {
            //Función para desefoncar el resto de elementos excepto la ventana para crear un proyecto
            if(document.getElementById("Create_Project").style.display == "block"){
                document.getElementById("Create_Project").style.display = "none";
                document.getElementById("sidenav-main").style.opacity = 1;
                document.getElementById("navbarBlur").style.opacity = 1;
            }else{
                document.getElementById("Create_Project").style.display = "block";
                document.getElementById("sidenav-main").style.opacity = 0.5;
                document.getElementById("navbarBlur").style.opacity = 0.5;
            }
        }

    </script>
@endsection
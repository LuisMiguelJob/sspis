@extends('layouts.plantilla-md2')

@section('title','Projects')    


@section('content')
<div id="Create_Project" style="display: none; text-align: center; position: absolute; width: 90%; height: 80%; background-color: gray;">
    <!-- Este div originalmente era del createProject, pero desde que solo necesitamos 3 inputs, lo agregué como una ventana dentro de la página del show -->
    <a onclick="createProject()">volver a los proyectos</a><br><br>
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
    <a onclick="createProject()">Crear proyecto</a><!-- este link abre la "ventana para crear un proyecto" -->
    <div id="container" style="display: flex; flex-wrap: wrap;">
        @foreach ($proyecto as $proyectos)<!--Por cada proyecto que exista del lider se crea como una tarjetita-->
        <a href="{{route('projects.show', $proyectos->id)}}">
            <div style="width: 250px; height: 250px; background-color: gray; margin: 10px; padding: 5px">
                <h3>{{$proyectos->name}}</h3><br>
                {{$proyectos->description}}<br>
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
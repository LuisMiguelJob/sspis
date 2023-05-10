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
        <label style="color:white">Nombre del proyecto:<br> 
            <input type="text" name="name" value="{{old('name')}}">
        </label><br>
        @error('name')
        <br><small>*{{$message}}</small>
        @enderror
        <div style="display:none">
        <label style="color:white">ID del lider del proyecto:
            <input type="text" name="user_id" value="{{$id = Auth::id()}}">
        </label>
        </div>
        @error('user_id')
        <br><small>*{{$message}}</small>
        @enderror
        <br><br>
        <label style="color:white">Descripción del proyecto: <br>
            <textarea name="description" rows="5">{{old('description')}}</textarea><br>
        </label><br>
        @error('name')
        <br><small>*{{$message}}</small>
        @enderror
        <button type="submit">Crear proyecto</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="crearProyectoModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form name="myform" action="{{route('projects.store')}}" method="POST">

            @include('partials.form-errors')
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Proyecto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nombre del proyecto</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="input-group input-group-dynamic">
                        <textarea class="form-control" rows="5" placeholder="Descripcion del proyecto" spellcheck="false" name="description"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
            </div>
        </form>
    </div>
    </div>
</div>

@foreach ($errors->all() as $error)

@php
    if($error){
        echo '<script>$("#crearProyectoModal").modal("show");</script>';
    }else{
        echo '<script>$("#crearProyectoModal").modal("hide");</script>';
    } 
@endphp

@endforeach

<div id="container2">
    <h2>Proyectos</h2>
        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="crearProyectoModal" class="btn btn-primary mb-5">Crear Proyecto</button> --}}

        <!-- Boton para ejecutar modal de crear proyecto -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearProyectoModal">
            Crear Proyecto
        </button>

        @if (sizeof($proyectosLider) > 0)

        <h2>Proyectos Liderados</h2>
        <div id="container" style="display: flex; flex-wrap: wrap;">
            @foreach ($proyectosLider as $proyectos)<!--Por cada proyecto que exista del lider se crea como una tarjetita-->
            <a href="{{route('projects.show', $proyectos->id)}}">
                <div class="row mt-4" style="margin-right:1px">
                    <div class="col-lg-10 col-md-6 mb-4">
                        <div class="card z-index-2">
                                <div class="card-body">
                                    <h6 class="mb-0 ">{{$proyectos->name}}</h6>
                                    <p class="text-sm ">{{$proyectos->description}}</p>
                                    <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        {{-- @can('projects.workers') --}}
                                        <a style="width:100%;" href="{{route('projects.workers', $proyectos)}}">Agregar trabajadores</a><br>   
                                        {{-- @endcan --}}
                                        <div style="width:25px"></div>
                                        @if($proyectos->start_date !== '2000-01-01')
                                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                                            <p class="mb-0 text-sm">{{$proyectos->start_date}} / {{$proyectos->final_date}}</p>
                                            <!--Div para mostrar la barra de color según el progreso del proyecto-->
                                        @endif
                                    </div>
                                    @if($proyectos->start_date !== '2000-01-01')
                                        <div id="progress{{$proyectos->id}}" style=""> 
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
                            </div>
                        </div>     
                </div>
            </a>
            @endforeach
        </div>    
        @endif

        @if (sizeof($proyectosTrabajador) > 0) 

        <h2>Colaboracion En Proyectos</h2>
        <div id="container" style="display: flex; flex-wrap: wrap;">
            @foreach ($proyectosTrabajador as $proyectos)<!--Por cada proyecto que exista del lider se crea como una tarjetita-->
            <a href="{{route('projects.show', $proyectos->id)}}">
                <div class="row mt-4" style="margin-right:1px">
                    <div class="col-lg-10 col-md-6 mb-4">
                        <div class="card z-index-2">
                                <div class="card-body">
                                    <h6 class="mb-0 ">{{$proyectos->name}}</h6>
                                    <p class="text-sm ">{{$proyectos->description}}</p>
                                    <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        {{-- @can('projects.workers') --}}
                                        <a style="width:100%;" href="{{route('projects.workers', $proyectos)}}">Agregar trabajadores</a><br>   
                                        {{-- @endcan --}}
                                        <div style="width:25px"></div>
                                        @if($proyectos->start_date !== '2000-01-01')
                                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                                            <p class="mb-0 text-sm">{{$proyectos->start_date}} / {{$proyectos->final_date}}</p>
                                            <!--Div para mostrar la barra de color según el progreso del proyecto-->
                                        @endif
                                    </div>
                                    @if($proyectos->start_date !== '2000-01-01')
                                        <div id="progress{{$proyectos->id}}" style=""> 
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
                            </div>
                        </div>     
                </div>
            </a>
            @endforeach
        </div>
            
        @endif
</div>

    <script>
        function createProject() {
            //Función para desefoncar el resto de elementos excepto la ventana para crear un proyecto
            if(document.getElementById("Create_Project").style.display == "block"){
                document.getElementById("Create_Project").style.display = "none";
                document.getElementById("sidenav-main").style.opacity = 1;
                document.getElementById("container2").style.opacity = 1;
                document.getElementById("navbarBlur").style.opacity = 1;
            }else{
                document.getElementById("Create_Project").style.display = "block";
                document.getElementById("sidenav-main").style.opacity = 0.5;
                document.getElementById("container2").style.opacity = 0.5;
                document.getElementById("navbarBlur").style.opacity = 0.5;
            }
        }

    </script>
@endsection
@extends('layouts.plantilla-md2')

@section('title','Añadir trabajador')    

@section('content')

<h2>Añadir trabajadores</h2>


<div class="col-6 col-md-2 mb-4">
<div class="card">
    <div class="card-header pb-0">
    <label class="ms-0">Seleccionar trabajador: </label>
    <form action="{{ route('projects.addWorker', $project) }}" method="POST">
        @csrf
        @if(count($usersWithoutProject) > 0)
            <div class="input-group input-group-static mb-4">
            <select name="worker_id" class="form-control border-2">
                    @foreach ($usersWithoutProject as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option> 
                    @endforeach            
            </select>
            </div>

        <button type="submit" class="btn btn-primary mb-4">
            <span>Agregar</span>
        </button>
        @else
            <h4>Sin opciones</h4>
        @endif
    </form>
</div>
</div>
</div>

{{-- Esto lo dejo por si hay problemas con el codigo de arriba --}}
{{-- <div class="input-group input-group-static mb-4">
     <label for="exampleFormControlSelect1" class="ms-0">Example select</label>
     <select class="form-control" id="exampleFormControlSelect1">
       <option>1</option>
       <option>2</option>
       <option>3</option>
       <option>4</option>
       <option>5</option>
     </select>
   </div> --}}

{{-- <form action="{{ route('projects.addWorker', $project) }}" method="POST">
    @csrf
    @if(count($usersWithoutProject) > 0)
        <select name="worker_id" >
                @foreach ($usersWithoutProject as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option> 
                @endforeach            
        </select>
    <button type="submit">
        <span>Agregar</span>
    </button>
    @else
        <h4>Todos lo trabajadores estan en este proyecto</h4>
    @endif
</form> --}}

<h2>Trabajadores en "{{ $project->name }}"</h2>

{{-- @foreach ($usersInProject as $uip)
    <h4>{{ $uip->name }} </h4> <button><a href={{ route('projects.removeWorker', [$project, $uip]) }}>Eliminar</a></button>
@endforeach --}}

@foreach ($usersInProject as $uip)
    <div class="col-6 col-md-4 mb-4 px-4" style="float:left">    
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-center">
                <h5>{{ $uip->name }} </h5>
            </div>
            <button><a href={{ route('projects.removeWorker', [$project, $uip]) }}>Eliminar</a></button>
        </div>
    </div>
@endforeach

@endsection
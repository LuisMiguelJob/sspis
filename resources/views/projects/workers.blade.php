@extends('layouts.plantilla-md2')

@section('title','Añadir trabajador')    

@section('content')

<h1>Trabajadores</h1>

<form action="{{ route('projects.addWorker', $project) }}" method="POST">
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
</form>

<br>
<h1>Trabajadores en "{{ $project->name }}"</h1>

@foreach ($usersInProject as $uip)
    <h4>{{ $uip->name }} </h4> <button><a href={{ route('projects.removeWorker', [$project, $uip]) }}>Eliminar</a></button>
@endforeach

@endsection
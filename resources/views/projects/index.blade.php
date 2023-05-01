@extends('layouts.plantilla-md2')

@section('title','Projects')    

    
@section('content')
<h2>Projects</h2>
    @can('projects.create')
        <a href="{{route('projects.create')}}">Crear proyecto</a>    
    @endcan
    <ul>
         @foreach ($proyecto as $proyectos)
            <li> <a href="{{route('projects.show', $proyectos->id)}}">{{$proyectos->name}}</a> </li>
         @endforeach
    </ul>
@endsection
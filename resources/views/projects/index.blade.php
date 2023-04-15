@extends('layouts.plantilla-md2')

@section('title','Projects')    

    
@section('content')
<h2>Projects</h2>
    <a href="{{route('projects.create_project')}}">Crear proyecto</a>
    <ul>
         @foreach ($proyecto as $proyectos)
            <li> <a href="{{route('projects.show', $proyectos->id)}}">{{$proyectos->name}}</a> </li>
         @endforeach
    </ul>
@endsection
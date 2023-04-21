@extends('layouts.plantilla-md2')

@section('title','Create project')    

    
@section('content')
<h1>Crear proyecto</h1>
<a href="{{route('projects.index')}}">volver a los proyectos</a><br><br>


<form name="myform" action="{{route('projects.store')}}" method="POST">
    <button type="submit">Crear proyecto</button>

    @csrf

    <label>Nombre del proyecto: 
        <input type="text" name="name" value="{{old('name')}}">
    </label><br>
    @error('name')
    <br><small>*{{$message}}</small>
    @enderror

    <label>ID del lider del proyecto:
        <input type="text" name="user_id" value="{{$id = Auth::id()}}">
    </label>
    @error('user_id')
    <br><small>*{{$message}}</small>
    @enderror
    <br><br>
    <label>Descripción del proyecto: 
        <textarea name="description" rows="5">{{old('description')}}</textarea><br>
    </label><br>
    @error('name')
    <br><small>*{{$message}}</small>
    @enderror

@endsection
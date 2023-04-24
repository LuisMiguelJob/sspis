@extends('layouts.plantilla-md2')

@section('title','Create project')    

    
@section('content')
<h1>Crear proyecto</h1>
<a href="{{route('projects.index')}}">volver a los proyectos</a><br><br>


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
@endsection
@extends('layouts.plantilla-md2')

@section('title','Edit Project')  

@section('content')


<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nuevo nombre del proyecto</label>
        <input type="text" name="name" value="{{ $project->name}}">
        
    </div>
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea name="description" rows="5">{{ $project->description}}</textarea><br>
    </div>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

@endsection
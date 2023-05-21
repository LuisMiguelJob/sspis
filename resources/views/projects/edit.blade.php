@extends('layouts.plantilla-md2')

@section('title','Edit Project')  

@section('content')

<a type="button" class="btn btn-primary" href="{{ route('projects.show', $project->id) }}"> Regresar </a>

<div id="Ptask1" style="width: 30%; display: block; position: relative; margin-top: 10px;" class="card card-body md-4">
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')    
        <h2>Editar datos de proyecto: "{{ $project->name }}"</h2><br>
            <div class="mb-3 col-md-6">
                <label class="form-label">Nombre</label>
                <input style="width:200%" type="text" class="form-control border border-2 p-2" name="name" value="{{ $project->name }}" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            @error('name')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-dynamic">
                <textarea class="form-control" rows="5" placeholder="Nueva descripcion de la tarea" spellcheck="false" name="description">{{$project->description}}</textarea>
            </div>
            @error('description')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <button class="btn btn-primary mt-4" type="submit">Guardar cambios</button> 
    </form>
</div>

@endsection
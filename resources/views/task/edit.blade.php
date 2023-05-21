@extends('layouts.plantilla-md2')

@section('title','Edit Task')  

@section('content')

<a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Regresar </a>

<div id="Ptask1" style="width: 35%; display: block; position: relative; margin-top: 10px;" class="card card-body md-4">
    <form action="{{ route('tasks.update', $task)}}" method="POST">
        @csrf    
        @method('PUT')
            <h2>Editar datos de tarea: "{{ $task->name }}" </h2><br>
            <div class="mb-3 col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" style="width:200%" class="form-control border border-2 p-2" name="name" value="{{ $task->name }}" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            @error('name')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-dynamic">
                <textarea class="form-control" rows="5" placeholder="Descripcion de la tarea" spellcheck="false" name="description">{{ $task->description }}</textarea>
            </div>
            @error('description')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de inicio de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="initial_date2" type="date" name="initial_date" onblur="selectInitalDate(2)" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ $task->initial_date }}">
                </div>
            </div>
            @error('initial_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de finalización de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="final_date2" type="date" name="final_date" class="form-control datepicker" min="{{$phase->initial_date}}" max="{{$phase->final_date}}" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ $task->final_date }}">
                </div>
            </div>
            @error('final_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <button class="btn btn-primary" type="submit">Guardar cambios</button> 
    </form>
</div>

@endsection
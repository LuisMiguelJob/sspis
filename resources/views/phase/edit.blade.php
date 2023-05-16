@extends('layouts.plantilla-md2')

@section('title','Edit Phase')  

@section('content')

<a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Regresar </a>

<div id="Ptask1" style="width: 30%; display: block; position: relative; margin-top: 10px;" class="card card-body md-4">
    <form action="{{ route('phases.update', $phase)}}" method="POST">
        @csrf
        @method('PUT')
            <h2>Editar datos de fase: "{{ $phase->name }}" </h2><br>
            
            <div class="mb-3 col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control border border-2 p-2" name="name" value="{{ $phase->name }}" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            @error('name')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-dynamic">
                <textarea class="form-control" rows="5" placeholder="Descripcion de la tarea" spellcheck="false" name="description">{{ $phase->description }}</textarea>
            </div>
            @error('description')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de inicio de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="initial_date2" type="date" name="initial_date" onblur="selectInitalDate(2)" min="2023-05-15" max="2023-05-22" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{$phase->initial_date}}">
                </div>
            </div>
            @error('initial_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de finalización de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="final_date2" type="date" name="final_date" class="form-control datepicker" min="2023-05-15" max="2023-05-22" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{$phase->final_date}}">
                </div>
            </div>
            @error('final_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <button class="btn btn-primary mt-4" type="submit">Crear tarea</button> 
    </form>
</div>

@endsection
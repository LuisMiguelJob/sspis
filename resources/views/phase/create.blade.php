@extends('layouts.plantilla-md2')

@section('title','Edit Phase')  

@section('content')

<a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Volver </a>

<div id="Ptask1" style="width: 35%; display: block; position: relative; margin-top: 10px;" class="card card-body md-4">
    <form action="{{ route('phases.store')}}" method="POST">
        @csrf
        @method('POST')
            <h2>Creacion de fase</h2><br>
            
            <div class="mb-3 col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" style="width:200%" class="form-control border border-2 p-2" name="name" value="{{ old('name') }}" onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
            @error('name')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-dynamic">
                <textarea class="form-control" rows="5" placeholder="Descripcion de la fase" spellcheck="false" name="description" >{{ old('description') }}</textarea>
            </div>
            @error('description')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de inicio de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="initial_date2" type="date" name="initial_date" onblur="selectInitalDate(2)" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ old('initial_date') }}">
                </div>
            </div>
            @error('initial_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <div class="input-group input-group-outline my-3">
                <label>Fecha de finalización de la tarea:</label>
                <div class="input-group input-group-static">
                    <input id="final_date2" type="date" name="final_date" class="form-control datepicker" placeholder="Please select date" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ old('final_date') }}">
                </div>
            </div>
            @error('final_date')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
            @enderror

            <input style="display:none" type="text" name="project_id" value="{{$project->id}}">

            <button class="btn btn-primary mt-4" type="submit">Guardar cambios</button> 
    </form>
</div>

@endsection
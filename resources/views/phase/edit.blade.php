@extends('layouts.plantilla-md2')

@section('title','Edit Phase')  

@section('content')


<form action="{{ route('phases.update', $phase)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="name">Nombre de la fase: </label>
        <input type="text" name="name" value="{{ $phase->name}}">
        
    </div>
    <div class="form-group">
        <label for="description">Descripción de la fase</label>
        <textarea name="description" rows="5">{{ $phase->description}}</textarea><br>
    </div>
    <div class="form-group">
        <label>Fecha de inicio de la fase:</label><br>
        <input id="initial_date2" type="date"  onBlur="selectInitalDate(2)" name="initial_date" value="{{$phase->initial_date}}"><br>
    </div>
    <div class="form-group">
        <label>Fecha de finalización de la fase:</label><br>
        <input id="final_date2" type="date"  name="final_date" min ="$phase->initial_date" max="$phase->final_date" value="{{$phase->final_date}}"><br>
        <input style="display:none" type="text" name="phase_id" ><br>
        <input style="display:none" type="text" name="project_id" >
    
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

@endsection
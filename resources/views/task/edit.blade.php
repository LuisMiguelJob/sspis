@extends('layouts.plantilla-md2')

@section('title','Edit Task')  

@section('content')


<form action="{{ route('tasks.update', $task)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="name">Nombre de la tarea: </label>
        <input type="text" name="name" value="{{ $task->name }}">
        
    </div>
    <div class="form-group">
        <label for="description">Descripción de la tarea</label>
        <textarea name="description" rows="5">{{ $task->description}}</textarea><br>
    </div>
    <div class="form-group">
        <label>Fecha de inicio de la tarea:</label><br>
        <input id="initial_date2" type="date"  onBlur="selectInitalDate(2)" name="initial_date" value="{{ $task->initial_date }}"><br>
    </div>
    <div class="form-group">
        <label>Fecha de finalización de la tarea:</label><br>
        <input id="final_date2" type="date"  name="final_date" min="{{$task->initial_date}}"  value="{{ $task->final_date }}"><br>
        <input style="display:none" type="text" name="phase_id" value="{{$task->id}}" ><br>
        <input style="display:none" type="text" name="project_id" value= "{{$task->project_id}}">
    
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

@endsection
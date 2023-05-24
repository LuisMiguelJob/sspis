@extends('layouts.plantilla-md2')

@section('title','Calendario')

@section('content')

<a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Regresar </a>

<div>

  @foreach($tasks as $task)
    <div class="card text-center" style="width: 18rem;float:left">
      <div class="card-body">
        <h5 class="card-title">"{{ $task->name }}"</h5>
        <b class="card-text mt-4" >{{ $task->initial_date }}</b>
        <p class="card-text" >{{ $task->final_date }}</p>
        <a href=" {{ route('tasks.show', [$task, $project]) }} " class="btn btn-primary">Ver
          @if($task->user_id == Auth::id())
            "tu tarea"
          @endif
        </a>
      </div>
    </div>
@endforeach

</div>

@endsection

{{-- <div id='calendar'></div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        // initialView: 'timeGridWeek',
        events: @json($events)
      });
      calendar.render();
    });
  </script> 
@endpush --}}
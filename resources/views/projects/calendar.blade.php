@extends('layouts.plantilla-md2')

@section('title','Calendario')

@section('content')

{{-- <a type="button" class="btn btn-primary" href="{{ route("projects.show", $project->id) }}"> Regresar </a> --}}

<div id='calendar'></div>


@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        // initialView: 'listWeek',
        locale: 'es',

        // initialView: 'timeGridWeek',
        events: @json($events)
      });
      calendar.render();
    });
  </script> 
@endpush 


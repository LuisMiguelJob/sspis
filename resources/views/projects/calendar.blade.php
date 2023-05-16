@extends('layouts.plantilla-md2')

@section('title','Calendario')


@section('content')
<div id='calendar'></div>
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
@endpush
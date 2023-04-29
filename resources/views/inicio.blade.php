@extends('layouts.plantilla-md2')

@section('content')
    <h2>
      Inicio - User: {{ Auth::user()->name }}
    </h2>

@endsection
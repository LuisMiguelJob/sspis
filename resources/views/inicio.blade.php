@extends('layouts.plantilla-md2')

@section('content')
    <h2>
      Inicio "No modificar esta ruta porfa" User: {{ Auth::user()->name }}
    </h2>

    <a href=" {{ route('users.index') }} ">
      Users
    </a><br>
    <a href=" {{ route('projects.index') }} ">
      Projects
    </a>

@endsection
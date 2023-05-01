@extends('layouts.plantilla-md2')

@section('content')
    <h2>
      Inicio - User: {{ Auth::user()->name }}
    </h2>

    <h2>
      Rol: {{ Auth::user()->roles->pluck('name')->first() }}
    </h2>

    {{-- <p>
      {{ Auth::user()->select('id', 'name')->permission('inicio') }}
    </p> --}}

@endsection
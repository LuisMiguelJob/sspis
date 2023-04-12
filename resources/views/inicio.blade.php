@extends('layouts.plantilla-md2')

@section('content')
    <h2>
      Inicio "No modificar esta ruta porfa"
    </h2>

    <a
      href=" {{ route('users.index') }} "
    >
      Users
    </a>
@endsection
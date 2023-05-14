@extends('layouts.plantilla-md2')

@section('title','Añadir trabajador')    

@section('content')

<a type="button" class="btn btn-info" href="{{ route('projects.index') }}">
    Regresar a proyectos
</a>

<div class="col-6 col-md-4 mb-4">
    <div class="card card-body">

        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h4 class="text-white mx-4">
            Añadir trabajadores
            </h4> 
        </div>

        <div class="card-body p-1">
            <div class="card-header pb-0">
                <label class="ms-0">Seleccionar trabajador: </label>
                <form action="{{ route('projects.addWorker', $project) }}" method="POST">
                    @csrf
                    <div class="col-md-18">
                        <div class="input-group input-group-outline my-3">
                          <label class="form-label">Email</label>
                          <input name="email" type="email" class="form-control">
                        </div>
                      </div>
                    <button type="submit" class="btn btn-info mb-4">
                        <span>Agregar</span>
                    </button>

                    {{--@if(count($usersWithoutProject) > 0)
                        <div class="input-group input-group-static mb-4">
                        <select name="worker_id" class="form-control border-2">
                                @foreach ($usersWithoutProject as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option> 
                                @endforeach            
                        </select>
                        </div>
            
                    <button type="submit" class="btn btn-info mb-4">
                        <span>Agregar</span>
                    </button>
                    @else
                        <h4>Sin opciones</h4>
                    @endif--}}

                </form>
            </div>
        </div>
    </div>
</div>

{{-- codigo original antes de poner estilos, dejar aqui por si hay un problema --}}
{{-- <form action="{{ route('projects.addWorker', $project) }}" method="POST">
    @csrf
    @if(count($usersWithoutProject) > 0)
        <select name="worker_id" >
                @foreach ($usersWithoutProject as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option> 
                @endforeach            
        </select>
    <button type="submit">
        <span>Agregar</span>
    </button>
    @else
        <h4>Todos lo trabajadores estan en este proyecto</h4>
    @endif
</form> --}}

{{-- @foreach ($usersInProject as $uip)
    <h4>{{ $uip->name }} </h4> <button><a href={{ route('projects.removeWorker', [$project, $uip]) }}>Eliminar</a></button>
@endforeach --}}

<div class="card my-4">
    <div class="card-header">
        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h4 class="text-white mx-4">
                Trabajadores en "{{ $project->name }}"
            </h4> 
        </div>
    </div>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-x font-weight-bolder opacity-7">
                            Nombre
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-3">
                            Email
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-3">
                            Rol
                        </th>
                        <th class="text-secondary opacity-7">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($usersInProject as $uip)
                    <tr>
                        <td>
                              <div class="d-flex flex-column justify-content-center ps-3">
                                  <h6 class="mb-0 text-x">{{ $uip->name }}</h6>
                              </div>
                        </td>

                        <td>
                            <div class="d-flex flex-column justify-content-center ps-2">
                                <h6 class="mb-0 text-x">{{ $uip->email }}</h6>
                            </div>
                        </td>

                        <th class=" d-flex flex-column justify-content-center ps-3">
                            <h6 class="mb-0 text-x">{{ $uip->roles->pluck('name')->first() }}</h6>
                        </th>

                        <td class="align-middle">
                            <a rel="tooltip" class="btn btn-info btn-link" href={{ route('projects.removeWorker', [$project, $uip]) }} data-original-title="" title="">
                                Borrar
                                <div class="ripple-container"></div>
                            </a>
                          </td>

                      </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>

@endsection
@extends('layouts.plantilla-md2')

@section('title', 'Users')

@section('content')
  <div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h4 class="text-white mx-4">
              Lista de usuarios
            </h4> 
        </div>
    </div>
    {{-- <div class=" me-3 my-3 text px-3"> // implementar register a parte, pero primero probar asi solo para ver q
        <a class="btn bg-gradient-dark mb-0" href=" {{ route('users.create') }} "><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
          User
        </a>
    </div> --}}
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-x font-weight-bolder opacity-7">
                            ID
                        </th>
                        <th class="text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-2">
                            Nombre
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-2">
                            Email
                        </th>
                        <th class=" text-uppercase text-secondary text-x font-weight-bolder opacity-7 ps-2">
                            Rol
                        </th>
                        <th class="text-secondary opacity-7">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                      <tr>
                          <td>
                              <div class="d-flex px-2 py-1">
                                  <div class="d-flex flex-column justify-content-center">
                                      <p class="mb-0 text-x">{{ $user->id }}</p>
                                  </div>
                              </div>
                          </td>
                          <td>
                              <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-x">{{ $user->name }}</h6>
                              </div>
                          </td>
                          <td class="align-middle text-sm">
                              <p class="text-x text-secondary mb-0">
                                {{ $user->email }}
                              </p>
                          </td>
                          <td class="align-middle ">
                              <span class="text-secondary text-x font-weight-bold">En proceso</span>
                          </td>
                          <td class="align-middle">
                              <a rel="tooltip" class="btn btn-success btn-link" href="" data-original-title="" title="">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                              </a>
                              
                              <button type="button" class="btn btn-danger btn-link" data-original-title="" title="">
                              <i class="material-icons">close</i>
                              <div class="ripple-container"></div>
                          </button>
                          </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
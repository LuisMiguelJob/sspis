@extends('layouts.plantilla-md2')

@section('title', 'Editar Usuario')

@section('content')

<div class="card card-body">

    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h4 class="text-white mx-4">
          Edicion del usuario: {{ $user->name }}
        </h4> 
    </div>

    <div class="card-body p-3">

        {{-- @include('partials.form-errors') --}}

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <input hidden> <div class="row">

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input 
                    type='text' 
                    class="form-control border border-2 p-2" 
                    name="name" 
                    id="name"
                    value=" {{ old('name') ?? $user->name ?? ''}} "

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >
                @error('name')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
                @enderror
                
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Email') }}</label>
                <input 
                    type="email" 
                    class="form-control border border-2 p-2" 
                    name="email" 
                    id="email"
                    value=" {{ old('email') ?? $user->email ?? '' }} "

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >

                @error('email')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
                @enderror
            </div>
            
            </div>
            <button type="submit" class="btn bg-gradient-dark">{{ __('Submit') }}</button>
        </form>
    </div>
</div>

{{-- Cambiar contraseña --}}

<div class="card card-body mt-3">

    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h4 class="text-white mx-4">
          Cambiar contraseña
        </h4> 
    </div>

    <div class="card-body p-3">

        @include('partials.form-errors')

        <form method="POST" action="{{ route('users.updatePassword', $user) }}">
            @csrf
            
            <input hidden> <div class="row">

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('current_password') }}</label>
                <input 
                    type="password" 
                    class="form-control border border-2 p-2" 
                    name="current_password" 
                    id="current_password"

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >

                @error('current_password')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
                @enderror
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Password') }}</label>
                <input 
                    type="password" 
                    class="form-control border border-2 p-2" 
                    name="password" 
                    id="password"

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >

                @error('password')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Confirm Password') }}</label>
                <input 
                    type="password" 
                    class="form-control border border-2 p-2" 
                    name="password_confirmation" 
                    id="password_confirmation"

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >

                @error('password_confirmation')
                    <p class="text-danger inputerror"> {{ $message }} </p>    
                @enderror
            </div>
            
            </div>
            <button type="submit" class="btn bg-gradient-dark">{{ __('Submit') }}</button>
        </form>
    </div> 
</div>
@endsection
@extends('layouts.plantilla-md2')

@section('title', 'Form')

@section('content')
<div class="card card-body">
    <div class="card-body p-3">

        @include('partials.form-errors')

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input hidden> <div class="row">

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input 
                    type='text' 
                    class="form-control border border-2 p-2" 
                    name="name" 
                    id="name"
                    value=" {{ old('name') }} "

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Apellido') }}</label>
                <input 
                    type='text' 
                    class="form-control border border-2 p-2" 
                    name="last_name" 
                    id="last_name"
                    value=" {{ old('last_name') }} "

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >
            </div>
            
            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('Email') }}</label>
                <input 
                    type="email" 
                    class="form-control border border-2 p-2" 
                    name="email" 
                    id="email"
                    value=" {{ old('email') }} "

                    onfocus="focused(this)" onfocusout="defocused(this)"
                >
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
            </div>
            
            </div>
            <button type="submit" class="btn bg-gradient-dark">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
@endsection
{{-- Mostrado de errores en el formulario (Displaying The Validation Errors DOCS Laravel) --}}

@if ($errors->any())
<div class="card-body">
    <h4 class="mb-0">
        Errores en los siguientes campos:
    </h4>
    <p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </p>
</div>
@endif
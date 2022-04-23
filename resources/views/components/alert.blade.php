@if ($state == 'true')
    <div class="alert alert-danger" role="alert">
        Vaya parece que algo fue mal
    </div>
@else
    <div class="alert alert-success" role="alert">
        La acción se realizo correctamente
    </div>
@endif
@if ($state == 'true')
    <div class="alert alert-danger" role="alert">
        @if ($message)
            {{$message}}
        @else
            Vaya parece que algo fue mal
        @endif
        
    </div>
@else
    <div class="alert alert-success" role="alert">
        @if ($message)
            {{$message}}
        @else
            La acción se realizo correctamente
        @endif
    </div>
@endif
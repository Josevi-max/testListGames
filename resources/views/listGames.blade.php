@extends('layouts.base')

@section('content')
    @if (isset($emptyList))
        @if ($emptyList)
            <div class="alert alert-danger container" role="alert">
               Esta lista se ha quedado vacía pulsa <a href="{{route('home.index')}}">aquí</a> para añadir algunos juegos
            </div>
        @endif
    @endif
    <div class="container">
        @if ($list != null)
            @for ($i = 0; $i < count($list); $i++)
                <form action="{{ route('home.show', $list[$i]->name) }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ $list[$i]->name }}
                    </button>
                </form>
            @endfor
        @endif

        @if (isset($gamesList))
            @for ($i = 0; $i < count($gamesList); $i++)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $gamesList[$i]['image'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $gamesList[$i]['name'] }}</h5>
                        <form action="{{ route('data.dataGames', $gamesList[$i]['id']) }}" method="get">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Ver detalles juego">
                        </form>
                        <form action="{{ route('home.destroy', $gamesList[$i]['id']) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="list" value="{{ $actualListGames }}">
                            <input type="submit" class="btn btn-danger" value="Quitar de la lista">
                        </form>
                    </div>
                </div>
            @endfor
        @endif
    </div>
@endsection

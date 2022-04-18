<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@extends('layouts.base')

@section('content')
    <x-carrousel />
    <div class="container">
        @if ((isset($failQuery) && $failQuery == 'true') || (isset($update) && $update == 'false'))
            <div class="alert alert-danger" role="alert">
                Vaya parece que algo fue mal
            </div>
        @elseif(isset($failQuery) || isset($update))
            <div class="alert alert-success" role="alert">
                Todo correcto joven
            </div>
        @endif
        <h1 class="text-uppercase underline text-center mt-5">Explora</h1>
        <div class="mt-5 section-home">
                <form action="{{ route('search.specialSearch') }}" method="get">
                        <label class="fw-bold">Filtros:<br>
                        <select class="form-select" name="show" onchange="submit()">
                            <option value = "Lanzamientos" {{$specialSearch == 'Lanzamientos' ? 'selected': ''}}>Ultimos lanzamientos</option>
                            <option value = "Populares" {{$specialSearch == "Populares" ? 'selected': ''}}>Populares</option>
                            <option value = "Puntuados" {{$specialSearch == "Puntuados" ? 'selected': ''}}>Mejor puntuados</option>
                            <option value = "Esperados" {{$specialSearch == "Esperados" ? 'selected' : ''}}>Más esperados</option>
                        </select>
                        </label>
                        <label class="fw-bold">Cant: <br>
                        <select class="form-select " name="page_size" onchange="submit()">
                            <option value="9" {{$sizePage == 9 ? 'selected': ''}}>9</option>
                            <option value="15" {{$sizePage == 15 ? 'selected': ''}}>15</option>
                            <option value="24" {{$sizePage == 24 ? 'selected': ''}}>24</option>
                            <option value="33" {{$sizePage == 33 ? 'selected': ''}}>33</option>
                        </select>
                    </label>
                </form>
            <form action="{{ route('search.searchGames') }}" method="get">
                <i class="fas fa-search icon-search"></i>
                <input type="text" name="search" id="search" placeholder="Buscar">
            </form>
        </div>

        
        @if (isset($search))
            <x-showGames :search="$search"  :sizePage="$sizePage" :listsUser="$listsUser" />
        @endif
    </div>


    <!-- Modal Add list-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('home.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nombre de lista</label>
                            <input name="name_list" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <x-paginate :search="$search" :specialSearch="$specialSearch" :sizePage="$sizePage"/>  
@endsection


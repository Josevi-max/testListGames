<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@extends('layouts.base')

@section('content')
    <x-carrousel />
    
    <div class="container">
        @if (isset($createList))
            <x-alert :state="$createList" />
        @elseif(isset($failUpdate))
            <x-alert :state="$failUpdate" />
        @endif
        <h1 class="text-uppercase underline text-center mt-5">Explora</h1>
        <div class="mt-5 section-home">
                <form action="{{ route('search.specialSearch') }}" method="get">
                        <label class="fw-bold">Filtros:<br>
                        <select class="form-select" name="show" onchange="submit()">
                            <option value = "Populares" {{$specialSearch == "Populares" ? 'selected': ''}}>Populares</option>
                            <option value = "Esperados" {{$specialSearch == "Esperados" ? 'selected' : ''}}>Más esperados</option>
                            <option value = "Lanzamientos" {{$specialSearch == 'Lanzamientos' ? 'selected': ''}}>Ultimos lanzamientos</option>
                            <option value = "Puntuados" {{$specialSearch == "Puntuados" ? 'selected': ''}}>Mejor puntuados</option>
                            
                        </select>
                        </label>
                        <label class="fw-bold">Cant: <br>
                            <select class="form-select" name="page_size" onchange="submit()">
                                <option value="9" {{$sizePage == 9 ? 'selected': ''}}>9</option>
                                <option value="15" {{$sizePage == 15 ? 'selected': ''}}>15</option>
                                <option value="24" {{$sizePage == 24 ? 'selected': ''}}>24</option>
                                <option value="33" {{$sizePage == 33 ? 'selected': ''}}>33</option>
                            </select>
                        </label>
                        <label class="fw-bold">Fecha:<br>
                            <!-- Button trigger modal -->
                            <button type="button"  class="form-select height-39" data-bs-toggle="modal" data-bs-target="#dates">
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                            
                            
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


    
    <x-paginate :search="$search" :specialSearch="$specialSearch" :sizePage="$sizePage" :actualPage="$actualPage"/>  
@endsection



<!-- Modal -->
<div class="modal fade" id="dates" tabindex="-1" aria-labelledby="datesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header border-bottom-none">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form action="{{ route('search.specialSearch') }}" method="get">
            <div class="modal-body">
                <h5 class="text-center">Fecha inicio</h5>
                <input class="w-100" type="date" id="start" name="trip-start"
                                    value="2018-07-22"
                                    min="1997-01-01">
                <hr>
                <h5 class="text-center">Fecha fin</h5>
                <input class="w-100" type="date" id="end" name="trip-end"
                                    value="2019-07-22"
                                    min="1997-01-01">
            </div>
            <input type="hidden" name="show" value="{{$specialSearch}}">
            <input type="hidden" name="page_size" value ="{{$sizePage}}">
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary mx-auto">
            </div>
        </form>
    </div>
  </div>
</div>
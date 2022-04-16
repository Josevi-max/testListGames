@extends('layouts.base')

@section('content')
    <div class="container">
      @if(isset($failQuery) && $failQuery=="true" || isset($update) && $update=="false")
            <div class="alert alert-danger" role="alert">
              Vaya parece que algo fue mal
            </div>
      @elseif(isset($failQuery) || isset($update))
            <div class="alert alert-success" role="alert">
              Todo correcto joven
            </div>
      @endif
        <form action="{{ route('list.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nombre de lista</label>
                <input name="name_list" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <form action="{{ route('search.searchGames') }}" method="get">
            <input type="text" name="search" placeholder="search">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if (isset($search))
            @for ($i = 0; $i < count($search); $i++)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $search['results'][$i]['background_image'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $search['results'][$i]['name'] }}</h5>
                        <form action="{{route('data.dataGames', $search['results'][$i]['id'])}}">
                          @csrf
                          <input type="submit" class="btn btn-primary" value="Ver detalles juego">
                        </form>
                        <!-- Button trigger modal -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$search['results'][$i]['id']}}">
                        añadir a mi lista 
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop{{$search['results'][$i]['id']}}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <h5>Seleciona la lista a la que quieres agregarlo</h5>
                              
                              @if (isset($listsUser))
                                @for ($j = 0; $j < count($listsUser); $j++)
                                <form action="{{ route('list.update',$search['results'][$i]['id']) }}" method="post">
                                  @csrf
                                  @method("PATCH")
                                  <input type="hidden" name="list" value="{{$listsUser[$j]->name}}">
                                  <button type="submit" class="btn btn-secondary">{{$listsUser[$j]->name}}</button>
                                </form>
                                
                                
                                @endfor
                              @else

                              No tienes ahora mismo listas
                                  
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            @endfor
        @endif
    </div>
@endsection

<link rel="stylesheet" href="{{asset('css/showGames.css')}}">
<?php 
    if (count($search["results"]) < $sizePage ) {
        $maxSize = count($search["results"]);
    } else {
        $maxSize = $sizePage;
    }
?>
<div class="mt-5 row justify-content-center">

    @for ($i = 0; $i <  $maxSize; $i++)

        <div class="col-12 col-md-6 col-lg-4  mt-5 ">
            <p class="text-card-games text-center text-uppercase m-0">{{ $search['results'][$i]['name'] }}</p>
            <a href="{{ route('data.dataGames', $search['results'][$i]['id']) }}">
                <img src="{{ $search['results'][$i]['background_image'] }}" class="card-img-top img-game"
                    alt="{{ $search['results'][$i]['name'] }}">
                    
            </a>
            
            <div>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning w-100 h-25 fw-bold" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop{{ $search['results'][$i]['id'] }}">
                    Añadir a mi lista
                </button>
            </div>
        </div>


        <!-- Modal add game to list-->
        <div class="modal fade" id="staticBackdrop{{ $search['results'][$i]['id'] }}" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Selecione una de sus listas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="mb-3 btn col-12 text-center" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <img src="{{ asset('images/plus.png') }}" alt="plus" class="img icon">
                            <span class="text-uppercase">Crear lista</span>
                        </button>
                        @if (isset($listsUser))
                            <div class="row justify-content-center text-center">
                                @for ($j = 0; $j < count($listsUser); $j++)
                                    <div class="col-6 col-lg-4 mb-3 mt-2 ">
                                        <form action="{{ route('home.update', $search['results'][$i]['id']) }}" method="post">
                                            @csrf
                                            @method("PATCH")
                                            <input type="hidden" name="list" value="{{ $listsUser[$j]->name }}">
                                            <button type="submit"
                                                class="btn btn-dark special-btn p-3"><i class="fas fa-clipboard-list"></i>  {{ $listsUser[$j]->name }}</button>
                                        </form>
                                    </div>
                                
                                @endfor
                            </div>
                                
                        @else
                            No tienes ahora mismo listas
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>
 


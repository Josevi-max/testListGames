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

        <x-make-list :id="$search['results'][$i]['id']" :listsUser="$listsUser" />
        
    @endfor
</div>
 


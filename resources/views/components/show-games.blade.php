
<?php
if (count($search['results']) < $sizePage) {
    $maxSize = count($search['results']);
} else {
    $maxSize = $sizePage;
}



?>
<div class="mt-5 row justify-content-center">
    @for ($i = 0; $i < $maxSize; $i++)
        <div class=" col-lg-4 col-12 card-info mb-3">
            <img src="{{ $search['results'][$i]['background_image'] }}" class="card-img-top"
                alt="{{ $search['results'][$i]['name'] }}">
            <ul class="info-extra list-unstyled text-center">
                <li>
                    <h5 class="text-white text-uppercase underline">{{ $search['results'][$i]['name'] }}</h5>
                </li>
                <li class="mt-5">
                    <form action="{{ route('data.dataGames', $search['results'][$i]['id']) }}" method="get">
                        @csrf
                        <input type="submit" class="btn border-bottom text-white text-uppercase fw-bold"
                            value="Ver detalles juego">
                    </form>
                </li>
                <li>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn text-white text-uppercase fw-bold" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $search['results'][$i]['id'] }}">
                        Añadir a mi lista
                    </button>
                    
                </li>
                
            </ul>
            
        </div>
        <x-make-list :id="$search['results'][$i]['id']" :listsUser="$listsUser" :sizePage="$sizePage" :specialSearch="$specialSearch" :actualPage="$actualPage"/>
    @endfor
</div>

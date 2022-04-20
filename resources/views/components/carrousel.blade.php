    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @for ($i = 0; $i < $sizePage; $i++)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                    <form action="{{ route('data.dataGames', $searchDataView['results'][$i]['id']) }}">
                        @csrf
                        <img onclick="submit()" src="{{ $searchDataView['results'][$i]['background_image'] }} "
                            class="d-block w-100" alt="{{ $searchDataView['results'][$i]['name'] }}">
                        <div class="carousel-caption d-block">
                            <h5 class="text-uppercase">{{ $searchDataView['results'][$i]['name'] }}</h5>
                        </div>
                    </form>
                </div>
            @endfor

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

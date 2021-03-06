<?php
if (!isset($data['detail'])) {
    switch ($data['metacritic']) {
        case $data['metacritic'] > 80:
            $colorBtn = 'btn-success';
            break;
        case $data['metacritic'] > 50:
            $colorBtn = 'btn-warning';
            break;
        default:
            $colorBtn = 'btn-danger';
            break;
    }
}
if (isset($screenshots['results'])) {
    $numberPhotos = count($screenshots['results']);
}

?>
@extends('layouts.base')

@section('content')


    @if (!isset($data['detail']))
        <div class="container mt-5">
            <div class="row">
                @if (isset($failUpdate))
                    <x-alert :state="$failUpdate" />
                @endif
                <h1 class="text-uppercase text-center mb-4">{{ $data['name'] }}</h1>
                <div id="carouselExampleControls" class="carousel slide col-lg-6" data-bs-ride="carousel"
                    data-bs-toggle="modal" data-bs-target="#zoomCarrusel">
                    <div class="carousel-inner">
                        @for ($i = 0; $i < $numberPhotos; $i++)
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <img src="{{ $screenshots['results'][$i]['image'] }}" class="d-block w-100 zoom"
                                    alt="screenshot #{{ $i }}">
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="zoomCarrusel" tabindex="-1" aria-labelledby="zoomCarruselLabel"
                    aria-hidden="true">
                    <div class="modal-dialog mx-width-100">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="carouselGames" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @for ($i = 0; $i < $numberPhotos; $i++)
                                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                <img src="{{ $screenshots['results'][$i]['image'] }}"
                                                    class="d-block w-100 zoom" alt="screenshot #{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselGames" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselGames" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="{{ $numberPhotos ? 'col-lg-6 align-self-center' : 'col-12' }} ">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span class="fw-bold">Lanzamiento:</span> {{ $data['released'] }}</td>
                                <td>
                                    <span class="fw-bold">Genero/s:</span>
                                    @foreach ($data['genres'] as $item)
                                        {{ $item['name'] }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Plataforma/s:</span>
                                    @for ($i = 0; $i < count($data['platforms']); $i++)
                                        {{ isset($data['platforms'][$i]['platform']['name']) ? $data['platforms'][$i]['platform']['name'] : '/' }}
                                    @endfor
                                </td>
                                <td>
                                    <span class="fw-bold">Desarrollador:</span>
                                    {{ isset($data['developers'][0]['name']) ? $data['developers'][0]['name'] : '/' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Duraci??n:</span>
                                    {{ $data['playtime'] == 0 ? '/' : $data['playtime'] }} horas
                                </td>
                                <td>
                                    <span class="fw-bold">Editora:</span>
                                    {{ isset($data['publishers'][0]['name']) ? $data['publishers'][0]['name'] : '/' }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="fw-bold">Web: </span>
                                    @if ($data['website'])
                                        <a href="{{ $data['website'] }}" target="_blank">Pincha aqu??</a>
                                    @else
                                        /
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold">Tienda/s: </span> <br>
                                    @if ($shop)
                                        @foreach ($shop['results'] as $item)
                                            @switch($item["store_id"])
                                                @case(1)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/steam.png') }}" alt="Steam"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(2)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/microsoft.png') }}" alt="Microsfot"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(3)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/playstation.png') }}" alt="Playstation"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(4)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/apple.png') }}" alt="apple"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(5)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/gog.png') }}" alt="gog"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(6)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/nintendo.png') }}" alt="nintendo"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(8)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/google-play.png') }}" alt="google"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @case(11)
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/epic-games.svg') }}" alt="epic"
                                                            class="icon">
                                                    </a>
                                                @break

                                                @default
                                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                                        <img src="{{ asset('images/web.png') }}" alt="other"
                                                            class="icon">
                                                    </a>
                                            @endswitch
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn special-btn btn-dark col-12  mt-3 mb-3 mx-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $data['id'] }}">
                        A??adir a mi lista
                    </button>

                    <x-make-list :id="$data['id']" :listsUser="$listsUser" />

                    @if ($data['metacritic_platforms'])
                        <div class=" text-center">
                            <a href="{{ $data['metacritic_platforms'][0]['url'] }}" class="text-decoration-none "
                                target="_blank">
                                <button class="{{ $colorBtn }} text-white btn">
                                    {{ $data['metacritic_platforms'][0]['metascore'] }}
                                </button>
                                <img class="img-meta" src="{{ asset('images/metacritic.png') }}"
                                    alt="metacritic image">
                            </a>
                        </div>
                    @endif



                </div>
                <h2 class="text-center mt-3">Descripci??n</h2>
                <?php
                echo $data['description'];
                ?>

                @for ($i = 0; $i < count($data['platforms']); $i++)
                    @if ($data['platforms'][$i]['platform']['name'] == 'PC')
                        @if (isset($data['platforms'][$i]['requirements']['minimum']))
                            <h2 class="text-center mt-3">Requisitos Minimos</h2>
                            {{ $data['platforms'][$i]['requirements']['minimum'] }}
                        @endif
                        @if (isset($data['platforms'][$i]['requirements']['recommended']))
                            <h2 class="text-center mt-3">Requisitos Recomendados</h2>
                            {{ $data['platforms'][$i]['requirements']['recommended'] }}
                        @endif
                    @endif
                @endfor
            </div>
        @else
            <div class="container">
                <div class="row mx-auto w-50">
                    <img src="{{ asset('images/404.jpg') }}" alt="404">
                </div>
            </div>
    @endif




@endsection

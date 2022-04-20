<link rel="stylesheet" href="{{ asset('css/dataGames.css') }}">
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

    {{var_dump($shop)}}
    @if (!isset($data['detail']))
        <div class="container mt-5">
            <div class="row">
                <h1 class="text-uppercase text-center mb-4">{{ $data['name'] }}</h1>
                <div id="carouselExampleControls" class="carousel slide col-lg-6" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for ($i = 0; $i < $numberPhotos; $i++)
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <img src="{{ $screenshots['results'][$i]['image'] }}" class="d-block w-100" alt="...">
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
                                    <span class="fw-bold">Duración:</span>
                                    {{ $data['playtime'] == 0 ? '/' : $data['playtime'] }} horas
                                </td>
                                <td>
                                    <span class="fw-bold">Editora:</span>
                                    {{ isset($data['publishers'][0]['name']) ? $data['publishers'][0]['name'] : '/' }}
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <span class="fw-bold">Web: </span>
                                    @if ($data['website'])
                                        <a href="{{ $data['website'] }}" target="_blank">Pincha aquí</a>
                                    @else
                                        /
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn special-btn btn-dark col-12  mt-3 mb-3 mx-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $data['id'] }}">
                        Añadir a mi lista
                    </button>

                    <x-make-list :id="$data['id']" :listsUser="$listsUser" />

                    @if ($data['metacritic_platforms'])
                        <div class=" text-center">
                            <a href="{{ $data['metacritic_platforms'][0]['url'] }}" class="text-decoration-none "
                                target="_blank">
                                <button class="{{ $colorBtn }} text-white btn">
                                    {{ $data['metacritic_platforms'][0]['metascore'] }}
                                </button>
                                <img class="img-meta"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Metacritic_logo.svg/1089px-Metacritic_logo.svg.png?20180714112338"
                                    alt="">
                            </a>
                        </div>
                    @endif



                </div>
                <h2 class="text-center mt-3">Descripción</h2>
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
                    <img src="https://img.freepik.com/free-vector/404-error-with-landscape-concept-illustration_114360-7968.jpg?w=996&t=st=1650299094~exp=1650299694~hmac=fc58472d1b30ece0113f8e9cf58e6ba7aa20999a4c5a69f832e0f0e8a0ef8b8d"
                        alt="">
                </div>
            </div>
    @endif


@endsection

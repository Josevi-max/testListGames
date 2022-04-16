<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@extends('layouts.base')
@section('content')
    <x-carrousel />
    <div class="section">
        <div class="container">
            <div class="col-lg-6 col-12 float-left p-center">
                <h1 class="title">Lleva un registro de todos tus juegos</h1>
                <p>Administra tus títulos favoritos fácilmente para que siempre tengas algo para jugar.</p>
            </div>
            <img class="col-lg-6 col-12 " src="https://cdn.pixabay.com/photo/2021/09/07/07/11/game-console-6603120_1280.jpg" alt="">
            
            
        </div>
    </div>

    <div class="section border-bottom-section">
        <div class="container">
            <img class="col-lg-6 col-12 " src="https://cdn.pixabay.com/photo/2019/04/15/11/42/fortnite-4129124_1280.jpg" alt="">
            <div class="col-lg-6 col-12 float-right p-center">
                <h1 class="title">Recomendaciones actualizadas diariamente</h1>
                <p>Accede a nuestra selección de mejores juegos, visita los juegos más populares y enterate siempre de las ultimas novedades</p>
            </div>
            
            
            
        </div>
    </div>
    
    

@endsection
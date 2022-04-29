
@extends('layouts.base')
@section('content')
    <x-carrousel />
    <div class="container"  id="welcome">
        <div class="section">
            <div class="container">
                <div class="col-lg-6 col-12 float-left p-center">
                    <h1 class="title">Lleva un registro de todos tus juegos</h1>
                    <p>Administra tus títulos favoritos fácilmente para que siempre tengas algo para jugar.</p>
                </div>
                <img class="col-lg-6 col-12 " src="{{asset('images/gamepads.webp')}}" alt="gamepads">
                
                
            </div>
        </div>

        <div class="section border-bottom-section">
            <div class="container">
                <img class="col-lg-6 col-12 " src="{{asset('images/playGames.webp')}}" alt="play games">
                <div class="col-lg-6 col-12 float-right p-center">
                    <h1 class="title">Recomendaciones actualizadas diariamente</h1>
                    <p>Accede a nuestra selección de mejores juegos, visita los juegos más populares y enterate siempre de las ultimas novedades</p>
                </div>
                
                
                
            </div>
        </div>
    
    </div>

@endsection
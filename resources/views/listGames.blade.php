
@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="{{asset('css/list.css')}}">
    @if (isset($emptyList))
        @if ($emptyList)
            <div class="alert alert-danger container" role="alert">
                Esta lista se ha quedado vacía pulsa <a href="{{ route('home.index') }}">aquí</a> para añadir algunos
                juegos
            </div>
        @endif
    @endif
    <div class="container">
        @if ($list != null)
            <p class="text-center underline mt-4 mb-5">
                <a class=" text-center mt-5 text-decoration-none mx-auto col-12 text-uppercase text-dark fs-20" href="/home">
                    <img src="{{ asset('images/cursor.png') }}" alt="" class=" icon">
                    Pulsa para buscar juegos
                    <img src="{{ asset('images/searching.png') }}" alt="" class=" icon">
                </a>
            </p>
                
                
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary leftArrow me-4">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                </button>
                <div class="list-buttons">
                    @for ($i = 0; $i < count($list); $i++)
                        <form action="{{ route('list.load', $list[$i]->name) }}" method="get">
                            @csrf
                            <button type="submit"
                                class="btn list-buttons {{ $actualListGames == $list[$i]->name ? 'btn-warning' : 'btn-dark' }}  tag-button  me-4">
                                {{ $list[$i]->name }}
                            </button>
                        </form>
                    @endfor
                </div>
                <button class="btn btn-primary rightArrow">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </button>
            </div>
            
        @endif

        @if ($actualListGames)
            @if ($gamesList)
                <div class="d-flex justify-content-end mt-5">
                    <form action="{{ route('search.searchList') }}" method="get">
                        <i class="fas fa-search icon-search"></i>
                        <input type="text" name="search" id="search" placeholder="Buscar">
                        <input type="hidden" name="actualList" value="{{$actualListGames}}">
                        <input type="hidden" name="games" value="{{json_encode($dataGamesList,true)}}">
                    </form>
                </div>
            @endif
            
            <div class="d-flex justify-content-between mt-4">
                @if ($gamesList)
                    <p>
                        <span class="fw-bold">TOTAL</span>  {{$gamesList->total()}}
                    </p>
                @endif
                
                <form action="{{route('list.delete')}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button onclick="return confirm('¿Estas seguro de querer borrar la lista \'{{$actualListGames}}\' ?')" class="btn text-danger  text-uppercase fw-bold" type="submit"><i class="far fa-times-circle"></i> Eliminar lista</button>
                    <input type="hidden" name="list" value={{$actualListGames}}>
                </form>
            </div>
            
        @endif
        @if ($gamesList)
        <div class="mt-4 row ">
            @foreach ($gamesList as $item)
                <div class=" col-lg-4 col-12 card-info mb-3">
                    <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}">
                    <ul class="info-extra list-unstyled text-center">
                        <li><h5 class="text-white text-uppercase underline">{{ $item['name'] }}</h5></li>
                        <li class="mt-5">
                            <form action="{{ route('data.dataGames', $item['id']) }}" method="get">
                               @csrf
                               <input type="submit" class="btn border-bottom text-white text-uppercase fw-bold" value="Ver detalles juego">
                           </form>
                       </li>
                        <li>
                           <form action="{{ route('home.destroy', $item['id']) }}" method="post">
                               @csrf
                               @method('delete')
                               <input type="hidden" name="list" value="{{ $actualListGames }}">
                               <input onclick="return confirm('¿Estas seguro de querer borrar el juego \'{{$item['name']}}\' de la lista \'{{$actualListGames}}\' ?')" type="submit" class="btn text-white text-uppercase fw-bold" value="Quitar de la lista">
                           </form>
                        </li>
                    </ul>
                </div>
            @endforeach
            <div class="d-flex">
                <div class="mx-auto">
                    {{ $gamesList->links() }}
                </div>
            </div>
            
            
            {{--@for ($i = 0; $i < count($gamesList); $i++)
                
                    <div class=" col-lg-4 col-12 card-info mb-3">
                        <img src="{{ $gamesList[$i]['image'] }}" class="card-img-top" alt="{{ $gamesList[$i]['name'] }}">
                        <ul class="info-extra list-unstyled text-center">
                            <li><h5 class="text-white text-uppercase underline">{{ $gamesList[$i]['name'] }}</h5></li>
                            <li class="mt-5">
                                <form action="{{ route('data.dataGames', $gamesList[$i]['id']) }}" method="get">
                                   @csrf
                                   <input type="submit" class="btn border-bottom text-white text-uppercase fw-bold" value="Ver detalles juego">
                               </form>
                           </li>
                            <li>
                               <form action="{{ route('home.destroy', $gamesList[$i]['id']) }}" method="post">
                                   @csrf
                                   @method('delete')
                                   <input type="hidden" name="list" value="{{ $actualListGames }}">
                                   <input onclick="return confirm('¿Estas seguro de querer borrar este juego de la lista ?')" type="submit" class="btn text-white text-uppercase fw-bold" value="Quitar de la lista">
                               </form>
                            </li>
                           
                        </ul>
                    </div>
                    
                
            @endfor--}}
            
        </div>
        @else 

            <img src="{{asset('images/backList.jpg')}}" alt="backList" class="img-list w-100 mt-5">
        @endif
    </div>


@endsection

<!--jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var time = 400;
        var scroll = 300;
        $(".rightArrow").click(function() {
            var leftPos = $('.list-buttons').scrollLeft();
            $(".list-buttons").animate({
                scrollLeft: leftPos + scroll
            }, time);
        });
        $(".leftArrow").click(function() {
            var leftPos = $('.list-buttons').scrollLeft();
            $(".list-buttons").animate({
                scrollLeft: leftPos - scroll
            }, time);
        });

    });
</script>

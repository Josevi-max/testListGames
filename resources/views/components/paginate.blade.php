




    <ul class="pagination justify-content-center mt-5">
      
        @if ($search["previous"]!='')
        <li class="page-item">
            <form action="{{ route('search.searchGames') }}" method="get">
                <input type="hidden" name="next" value="{{$search["previous"]}}">
                <input type="submit" class="page-link" value="Atras">
                <input type="hidden" name="filters" value="{{$specialSearch}}">
                <input type="hidden" name="page_size" value="{{$sizePage}}">
            </form>
        </li>
        @else 
            <li class="page-item disabled">
                <a class="page-link">Atras</a>
            </li>
        @endif
      
        @if ($search["next"]!='')
        <li class="page-item ms-3">
            <form action="{{ route('search.searchGames') }}" method="get">
                <input type="hidden" name="next" value="{{$search["next"]}}">
                <input class="page-link" type="submit" value="Adelante">
                <input type="hidden" name="filters" value="{{$specialSearch}}">
                <input type="hidden" name="page_size" value="{{$sizePage}}">
            </form>
        </li>
        @else 
        <li class="page-item disabled">
            <a class="page-link">Adelante</a>
          </li>
        @endif
      
    </ul>
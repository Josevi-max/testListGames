<?php 
 $maxNumberPage = ceil($search['count'] / $sizePage);

 if ($maxNumberPage > 400) {
    $maxNumberPage = 400;
 }
?>

<ul class="pagination justify-content-center mt-5">

    @if ($search['previous'] != '')
        <li class="page-item">
            <form action="{{ route('search.searchGames') }}" method="get">
                <input type="hidden" name="previous" value="{{ $search['previous'] }}">
                <input type="submit" class="page-link" value="Atras">
                <input type="hidden" name="filters" value="{{ $specialSearch }}">
                <input type="hidden" name="page_size" value="{{ $sizePage }}">
                <input type="hidden" name="actualPage" value="{{ $actualPage }}">
            </form>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link">Atras</a>
        </li>
    @endif

    @if ($search['next'] != '' && $actualPage <$maxNumberPage)
        <li class="page-item ms-3">
            <form action="{{ route('search.searchGames') }}" method="get">
                <input type="hidden" name="next" value="{{ $search['next'] }}">
                <input class="page-link" type="submit" value="Adelante">
                <input type="hidden" name="filters" value="{{ $specialSearch }}">
                <input type="hidden" name="page_size" value="{{ $sizePage }}">
                <input type="hidden" name="actualPage" value="{{ $actualPage }}">
            </form>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link">Adelante</a>
        </li>
    @endif

</ul>

<div class="d-flex justify-content-center align-items-center">
    Página &nbsp;
    <form action="{{ route('paginate.api') }}">
        <input type="number" name="page" value="{{ $actualPage }}" class="width-70 form-control">
        <input type="hidden" name="next" value="{{ $search['next'] }}">
        <input type="hidden" name="previous" value="{{ $search['previous'] }}">
        <input type="hidden" name="filters" value="{{ $specialSearch }}">
        <input type="hidden" name="page_size" value="{{ $sizePage }}">
        <input type="hidden" name="total_pages" value="{{ $maxNumberPage }}">
        <input type="hidden" name="actualPage" value="{{ $actualPage }}">
    </form>
    &nbsp; de {{ $maxNumberPage }}
</div>


<!-- Modal add game to list-->
<div class="modal fade" id="staticBackdrop{{ $id }}" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mx-auto" id="staticBackdropLabel">Selecione una lista</h5>
            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <button type="button" class="mb-3 btn col-12 text-center" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <img src="{{ asset('images/plus.png') }}" alt="plus" class="img icon">
                <span class="text-uppercase">Crear lista</span>
            </button>
            @if (isset($listsUser) && $listsUser != null)
                <div class="row justify-content-center text-center">
                    @for ($j = 0; $j < count($listsUser); $j++)
                        <div class="col-6 col-lg-4 mb-3 mt-2 ">
                            <form action="{{ route('home.update', $id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="list" value="{{ $listsUser[$j]->name }}">
                                <button type="submit"
                                    class="btn btn-dark special-btn p-3"><i class="fas fa-clipboard-list"></i>  {{ $listsUser[$j]->name }}</button>
                            </form>
                        </div>
                    
                    @endfor
                </div>
                    
            @else
                No tienes listas ahora mismo
            @endif
        </div>
    </div>
</div>
</div>
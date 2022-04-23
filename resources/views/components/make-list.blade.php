<!-- Modal add game to list-->
<div class="modal fade" id="staticBackdrop{{ $id }}" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
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
                        <div class="col-12 mb-3 mt-2 ">
                            <form action="{{ route('home.update', $id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="list" value="{{ $listsUser[$j]->name }}">
                                <button type="submit"
                                    class="text-uppercase bg-dark text-white list-group-item special-btn p-3 col-12">{{ $listsUser[$j]->name }}</button>
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



<!-- Modal Add list-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog no-border-radius">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center mx-auto" id="exampleModalLabel">Nueva lista</h5>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('home.store') }}" method="POST">
                @csrf
                <div class="modal-body mb-4 mt-4">
                    <div class="form-group">
                        <label for="formFile" id="name_list" class="form-label"><i class="fas fa-gamepad h3"></i></label>
                        
                        <input name="name_list" id="name_list" class="special-form-control" placeholder="Nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto btn btn-default">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
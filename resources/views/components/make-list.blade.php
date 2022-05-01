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
            
            @if (isset($listsUser) && count($listsUser)>0)
                <div class="row justify-content-center text-center">
                    @for ($j = 0; $j < count($listsUser); $j++)
                        <div class="col-12 mb-3 mt-2 ">
                            <form action="{{ route('home.update', $id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="list" value="{{ $listsUser[$j]->name }}">
                                <input type="hidden" name="sizePage" value="{{isset($sizePage)?$sizePage:15}}">
                                <input type="hidden" name="actualPage" value="{{isset($actualPage)?$actualPage:1}}">
                                @if ($specialSearch)
                                    <input type="hidden" name="specialSearch" value="{{$specialSearch}}">
                                @endif
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




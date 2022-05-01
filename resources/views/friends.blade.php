@extends('layouts.base')
@section('content')
    <div class="container mt-5">
        @if (session('delete'))
            <div class="mt-5">
                <x-alert :state="false" :message="'Amigo eliminado'" />
            </div>
        @endif
        @if (session('update'))
            <div class="mt-5">
                <x-alert :state="false" :message="'Petición aceptada'" />
            </div>
        @endif
        <div class="row">
            <div class="card col-lg-3 col-12 me-3 mb-5 p-0">
                <h5 class="card-header">Peticiones de amistad</h5>
                <div class="card-body max-height-500 overflow-auto">
                    @foreach ($dataFriendsPetitions as $item)
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">
                                @if ($item[0]->profile)
                                    <img src="{{ asset('img/post/' . $item[0]->profile) }}" alt="image profile"
                                        class="profile">
                                @endif
                                {{ $item[0]->name }}
                            </h5>
                            <form action="{{ route('friends.accept') }}" method="post">
                                @csrf
                                @method("patch")
                                <input type="hidden" name="id" value="{{ $item[0]->id }}">
                                <button type="submit" class="btn">
                                    <i class="fas fa-check-square text-success"></i>
                                </button>
                            </form>
                            <form action="{{ route('friends.delete') }}" method="post">
                                @csrf
                                @method("delete")
                                <input type="hidden" name="id" value="{{ $item[0]->id }}">
                                <button type="submit" class="btn">
                                    <i class="fas fa-times-circle text-danger"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card col-lg-7 col-12 p-0 ">
                <h5 class="card-header">Amigos {{ count($dataFriends) }} </h5>
                <div class="card-body max-height-500 overflow-auto">
                    @foreach ($dataFriends as $item)
                        <div class="d-flex justify-content-between list-group-item">
                            <h5 class="card-title">
                                <a href="{{ route('list.index', $item[0]->id) }}" class="text-decoration-none text-dark">
                                    @if ($item[0]->profile)
                                        <img src="{{ asset('img/post/' . $item[0]->profile) }}" alt="image profile"
                                            class="profile">
                                    @endif
                                    {{ $item[0]->name }}
                                </a>
                            </h5>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('friends.delete') }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <input type="hidden" name="id" value="{{ $item[0]->id }}">
                                    <button type="submit" class="btn" onclick="return confirm('¿Estas seguro de quitar a este usuario de su lista de amigos?')">
                                        <i class="fas fa-times-circle text-danger"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                    {{-- <div class="d-flex justify-content-end">
                        {{$dataFriends->links()}}
                    </div> --}}
                </div>
            </div>


        </div>
    </div>


    <div>

    </div>
@endsection

@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        @if (session('updateName'))
            <x-alert :state="false" :message="'Nombre actualizado correctamente'" />
        @endif
        @if (session('updateEmail'))
            <x-alert :state="false" :message="'Email actualizado correctamente'" />
        @endif
        @if (session('updatePassword'))
            <x-alert :state="false" :message="'Contraseña actualizada correctamente'" />
        @endif
        @if (session('updateImage'))
            <x-alert :state="false" :message="'Imagen actualizada correctamente'" />
        @endif
        @if (session('somethingFailed'))
            <x-alert :state="true" />
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <h1>Ajustes de usuario</h1>
                    <p>Actualiza los datos de tu cuenta desde el nombre de tu usuario hasta tu foto de perfil</p>
                </div>
                <div class="col-lg-6 col-12 bg-white p-5">
                    <form action="{{ route('user.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method("PATCH")
                        <div class="mb-3">
                            <label for="nameUser" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nameUser" id="nameUser" aria-describedby="name"
                                value={{ $dataUser[0]->name }}>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                                value="{{ $dataUser[0]->email }}">
                            <div id="emailHelp" class="form-text">Nunca compartiremos tu email con nadie más</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="repeatPassword" class="form-label">Repite tu contraseña</label>
                            <input type="password" name="repeatPassword" class="form-control" id="repeatPassword">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subir imagen perfil</label> <br>
                            <input type="file" name="imageProfile" class="form-control">
                        </div>
                        <div>

                        </div>
                        <input type="hidden" name="actualEmail" value="{{ $dataUser[0]->email }}">
                        <input type="hidden" name="actualPassword" value={{ $dataUser[0]->password }}>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 col-12">
                    <h1>Mis listas</h1>
                    <p>Echa un rápido vistazo a tus listas</p>
                </div>
                <div class="col-lg-6 col-12 bg-white p-5 overflow-auto ">
                    <ol class="list-group list-group-numbered max-height-100"  >
                        @foreach ($dataLists as $item)
                            <a href="/list/{{$item->name}}/user/{{Auth::id()}}" class="text-decoration-none">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{$item->name}}</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $item->id_games[0] != "" ? count($item->id_games) : 0}}</span>
                                </li>
                            </a>
                        @endforeach
                      </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

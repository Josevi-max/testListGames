@extends('layouts.base')

@section('content')
<div class="container mt-5">
    @if (session("updateName"))
        <x-alert :state="false" :message="'Nombre actualizado correctamente'" />
    @endif
    @if (session("updateEmail"))
        <x-alert :state="false" :message="'Email actualizado correctamente'" />
    @endif
    @if (session("updatePassword"))
        <x-alert :state="false" :message="'Contraseña actualizada correctamente'" />
    @endif
    <form action="{{route('user.update')}}" method="POST">
        @csrf 
        @method("PATCH")
        <div class="mb-3">
            <label for="nameUser" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nameUser" id="nameUser" aria-describedby="name" value = {{$dataUser[0]->name}}>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{$dataUser[0]->email}}">
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
        <input type="hidden" name="actualName" value ="{{$dataUser[0]->name}}">
        <input type="hidden" name="actualEmail" value="{{$dataUser[0]->email}}">
        <input type="hidden" name="actualPassword" value={{$dataUser[0]->password}}>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
    
@endsection

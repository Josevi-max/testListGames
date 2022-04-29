@extends('layouts.base')

@section('content')
    <section class="vh-100" id="session">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" >
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('images/gamer-login.jpg') }}"
                                    alt="login form" class="img-login"/>
                                    
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <h5 class="fw-normal mb-3 pb-3 title">Inicia sesión en tu
                                            cuenta
                                        </h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required />
                                            <label class="form-label" for="form2Example17">Correo</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password" required />
                                            <label class="form-label" for="form2Example27">Contraseña</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Iniciar
                                                sesión</button>
                                        </div>

                                        <span class="mb-5 pb-lg-2 secondary-color" >¿No tienes una cuenta? <a
                                                href="{{ route('register') }}"  class="secondary-color">Registrate aquí</a>
                                        </span>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ($imageProfile[0]->profile)
                                <img src="{{ asset('img/post/' .$imageProfile[0]->profile) }}" alt="image profile"
                                    class="profile">
                            @endif

                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Crear lista
                            </a>
                            <a class="dropdown-item" href="{{ route('list.index', Auth::id()) }}">
                                Mis listas
                            </a>
                            <a class="dropdown-item" href="{{ route('community.index') }}">
                                Comunidad
                            </a>
                            <a class="dropdown-item" href="{{ route('user.show') }}">
                                Perfil
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@if (session('createList'))
    <div class="pt-70 container">
        <x-alert :state="session('createList')" />
    </div>
@endif
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
                        <label for="formFile" id="name_list" class="form-label"><i
                                class="fas fa-gamepad h3"></i></label>

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

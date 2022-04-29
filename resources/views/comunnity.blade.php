@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="text-end">
                <form action="{{ route('community.search') }}" method="get">
                    <i class="fas fa-search icon-search"></i>
                    <input type="text" name="search" id="search" placeholder="Buscar">
                </form>
            </div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Número usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Listas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataUsers as $item)
                        <tr>
                            <td>
                                #{{$item->id}}
                            </td>
                            <td>
                                @if (!empty($item->profile))
                                    <img src="{{ asset('img/post/' .$item->profile) }}" alt="image profile" class="profile">
                                @endif
                                {{$item->name}}
                            </td>
                            <td>
                                <a href="{{route('list.index',$item->id)}}" class="text-decoration-none text-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            {{ $dataUsers->links() }}
            <p class="fw-bold">Resultados: {{$dataUsers->total()}}</p>
        </div>

    </div>
@endsection

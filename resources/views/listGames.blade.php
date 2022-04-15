@extends('layouts.base')

@section('content')

    <div class="container">
        @if ($list!=null)
            
            @for ($i = 0; $i < count($list); $i++)

                <form action="{{route('list.show',$list[$i]->name)}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary" >
                        {{$list[$i]->name}}
                    </button>
                </form>
                

            @endfor
        @endif
    </div>
@endsection

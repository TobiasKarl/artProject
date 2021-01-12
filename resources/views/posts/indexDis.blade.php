@extends('layouts.app')

@section('content')
<div class="container">

<div class="align-items-center align-content-center"><h1 style="margin-left: 42%;">Discover</h1></div>

    <div class="row pt-1"style="overflow-y:scroll; height:45rem;">

        @foreach($posts as $post)
        <div class="col-4 pb-4">

            <a href="/p/{{$post->id }}">
                <figure>
                    <img src="/storage/{{ $post->image }}" class="ex1 w-100 ">
                    <figcaption>
                        <span class="font-weight-bold align-items-center">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="font-weight-bold text-dark">{{ $post->user->username }} :</span>
                            </a>
                        </span> {{ $post->caption }}
                    </figcaption>
                </figure>
            </a>
        </div>
        @endforeach


    </div>
    
</div>
@endsection
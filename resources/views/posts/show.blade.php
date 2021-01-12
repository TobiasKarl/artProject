@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"style="    background-color: rgb(209 215 220 / 50%) !important;
    border: 1px solid black;">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="row d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100"
                            style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold align align-items-left">
                            <div style="float: left     margin-left: 1.5rem !important;"><a href="/profile/{{ $post->user->id }}" style="    margin-left: 1.5rem !important;">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a></div>
                            
                           
                        </div>
                    </div>
                </div>

                <hr>

                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
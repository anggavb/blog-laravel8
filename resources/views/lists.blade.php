@extends('layouts.main')

@section('body')

<h1 class="mb-5">{{ ucfirst(Request::segment(1)) }}</h1>

<div class="container">
    <div class="row">
        @foreach ($data as $c)
        <div class="col-md-4">
            <a href='{{ Request::segment(1) == "categories" ? "/categories/$c->slug" : "authors/$c->username" }}'>
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x400/?{{ Request::segment(1) == "categories" ? "$c->slug" : "person" }}" class="card-img" alt="{{ $c->name }}">
                    <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill p-4" style="background-color: rgba(0, 0, 0, 0.7)">{{ $c->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
@extends('layouts.main')

@section('body')

<h1 class="mb-5 text-center">{{ $title }}</h1>

@if ($data->count())
    <div class="card mb-3">
        <img src="https://source.unsplash.com/900x300/?{{ $data[0]->category->slug }}" class="card-img-top" alt="{{ $data[0]->category->name }}">
        <div class="card-body text-center">
            <h5 class="card-title"><a class="text-decoration-none" href="/blog/{{ $data[0]->slug }}">{{ $data[0]->title }}</a></h5>

            <p>
                <small class="text-muted">
                    By: <a class="text-decoration-none" href="/authors/{{ $data[0]->user->username }}">{{ $data[0]->user->name }}</a> in <a
                    class="text-decoration-none" href="/categories/{{ $data[0]->category->slug }}">{{ $data[0]->category->name }}</a> {{ $data[0]->created_at->diffForHumans() }}
                </small>
            </p>

            <p class="card-text">{{ $data[0]->excerpt }}</p>

            <a class="text-decoration-none btn btn-primary btn-sm" href="/blog/{{ $data[0]->slug }}">Read more</a>
        </div>
    </div>

@else

    <p class="text-center fs-4">No post found.</p>

@endif

<div class="container">
    <div class="row">
        @foreach ($data->skip(1) as $p)
            <div class="col-md-4">
                <div class="card">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0,0,0, 0.7)">
                        <a class="text-white text-decoration-none" href="/categories/{{ $p->category->slug }}">{{ $p->category->name }}</a>
                    </div>
                    <img src="https://source.unsplash.com/500x400/?{{ $p->category->slug }}" class="card-img-top" alt="{{ $p->category->name }}">
                    <div class="card-body">
                    <h5 class="card-title"><a class="text-decoration-none" href="/blog/{{ $p->slug }}">{{ $p->title }}</a></h5>
                    <p>
                        <small class="text-muted">
                            By: <a class="text-decoration-none" href="/authors/{{ $data[0]->user->username }}">{{ $data[0]->user->name }}</a> {{ $p->created_at->diffForHumans() }}
                        </small>
                    </p>
                    <p class="card-text">{{ $p->excerpt }}</p>
                    <a href="/blog/{{ $p->slug }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $data->links() }}
</div>
@endsection
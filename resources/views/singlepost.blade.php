@extends('layouts.main')

@section('body')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $data->title }}</h1>

            <p>By: <a href="/authors/{{ $data->user->username }}"
                    class="text-decoration-none">{{ $data->user->name }}</a> in <a class="text-decoration-none"
                    href="/categories/{{ $data->category->slug }}">{{ $data->category->name }}</a></p>

            <img class="img-fluid" src="https://source.unsplash.com/1200x400/?{{ $data->category->slug }}"
                class="card-img-top" alt="{{ $data->category->name }}">

            <article class="my-3 fs-5">
                {!! $data->body !!}
            </article>

            <a href="/blog">Back to Blog</a>

            <article class="mt-5">
                <h4>Comments</h4>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/blog/{{ $data->slug }}/comments" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ auth()->user() ? auth()->user()->name : '' }}" required {{ auth()->user() ? 'readonly' : '' }}>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="3" placeholder="Comments here..."></textarea>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </article>

            <hr>

            @foreach ($cmn as $comment)
                @if ($comment->status == 'active')
                <article class="mt-4">
                    <h5>{{ $comment->name }} </h5>
                    <small>
                        <p>{{ $comment->created_at->diffForHumans() }}</p>
                    </small>
                    <p>{{ $comment->body }}</p>
                </article>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
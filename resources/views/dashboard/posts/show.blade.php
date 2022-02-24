@extends('dashboard.layouts.main')

@section('body')

<div class="container">
    <div class="row my-3">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $post->title }}</h1>

            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>

            <img class="img-fluid mt-3" src="https://source.unsplash.com/1200x400/?{{ $post->category->slug }}"
                alt="{{ $post->category->name }}">

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>

            <article class="mt-5">
                <h4>Comments</h4>
            </article>

            <hr>

            @foreach ($post->comments as $comment)
            <article class="mt-4">
                <h5>{{ $comment->name }} </h5>
                <small>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                </small>
                <p>{{ $comment->body }}</p>
            </article>
            @endforeach
        </div>
    </div>
</div>

@endsection
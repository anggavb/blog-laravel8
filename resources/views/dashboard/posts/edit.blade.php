@extends('dashboard.layouts.main')

@section('css')
    {{-- Trix Edito --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
@endsection

@section('body')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="mb-5">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <div class="input-group">
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                <button class="btn btn-outline-secondary @error('slug') is-invalid @enderror" type="button" id="keep_slug">Keep Old Slug</button>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                <option value="" {{ old('category_id', $post->category_id) ? '' : 'selected' }}>--- Pilih salah satu ---</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id', $post->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
              @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Body</label>
            @error('body')
                <p class="text-danger">{{ $message }}</p>    
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body"></trix-editor>
        </div>
        
        <button type="submit" class="btn btn-danger">Update Post</button>
    </form>
</div>

<script>
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');
    const keep_slug = document.getElementById('keep_slug');

    title.addEventListener('keyup', () => {
        slug.value = title.value.toLowerCase().replace(/ /g, '-');
    });

    if(keep_slug.addEventListener('click', () => {
        slug.value = "{{ $post->slug }}";
    }));
</script>
@endsection
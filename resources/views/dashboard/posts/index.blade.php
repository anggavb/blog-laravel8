@extends('dashboard.layouts.main')

@section('body')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Post</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-8">
    <a href="/dashboard/posts/create" class="btn btn-primary btn-sm mb-3">Create New Posts</a>
    
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($posts as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->title }}</td>
            <td>{{ $p->category->name }}</td>
            <td>
                <a href="/dashboard/posts/{{ $p->slug }}" class="btn btn-info btn-sm"><span data-feather="eye"></a>
                <a href="/dashboard/posts/{{ $p->slug }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></a>
                <form action="/dashboard/posts/{{ $p->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @endsection
@extends('dashboard.layouts.main')

@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('body')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Comments</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="my-3">
    <a href="/dashboard/comments?status=active" class="btn btn-{{ Request::get('status') == 'active' ? 'primary' : 'secondary' }}">
        Active
    </a>
    <a href="/dashboard/comments?status=hidden" class="btn btn-{{ Request::get('status') == 'hidden' ? 'primary' : 'secondary' }}">
        Hidden
    </a>
</div>

<div class="table-responsive">

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Post Title</th>
                <th scope="col">User</th>
                <th scope="col">Comment</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (Request::get('status') == 'active')
                @foreach ($comments as $c)
                <tr>
                    @if ($c->post->user->id == auth()->user()->id)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->post->title }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->body }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm btnAction" data-bs-toggle="modal" data-id="{{ $c->id }}" data-bs-target="#action">
                            <span data-feather="tool"></span>
                        </button>
                    </td>
                    @endif
                </tr>
                @endforeach

            @else
                @foreach ($hidden as $c)
                <tr>
                    @if ($c->post->user->id == auth()->user()->id)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->post->title }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->body }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm btnAction" data-bs-toggle="modal" data-id="{{ $c->id }}" data-bs-target="#action">
                            <span data-feather="tool"></span>
                        </button>
                    </td>
                    @endif
                </tr>
                @endforeach
            @endif


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="action" tabindex="-1" aria-labelledby="actionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionLabel">Comments Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="mTitlePost">Ini title</h4>
                <p>By: <small id="mName">Ini nama komentator</small></p>
                <p id="mComment">Ini komentarnya banyak</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="hideComment">
                    @method('put')
                    @csrf
                    <input type="hidden" name="status" value="{{ Request::get('status') == 'active' ? 'hidden' : 'active' }}">
                    <button type="submit" class="btn btn-{{ Request::get('status') == 'active' ? 'warning' : 'success' }}" onclick="return confirm('Ready to hide! Are you sure?')">{{ Request::get('status') == 'active' ? 'Hide' : 'Active' }} Comment</button>
                </form>
                <form action="" method="post" id="deleteComment">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ready to delete! Are you sure?')">Delete Comment</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btnAction').click(function () {
        const id = $(this).data('id');

        $.get('/dashboard/comments/' + id + '/edit', function (data) {
            $('#mTitlePost').text(data.post.title);
            $('#mName').text(data.name);
            $('#mComment').text(data.body);
            $('#hideComment').attr('action', '/dashboard/comments/' + id);
            $('#deleteComment').attr('action', '/dashboard/comments/' + id);
        });
    });
</script>

@endsection
@extends('layouts.app')

@section('content')

    @if (app('request')->input('post_id') != null)
        check query string post id {{ app('request')->input('post_id') }}
    @else
        error query string post id
    @endif

    <div class="card mt-5">

        <h2 class="card-header">Comments</h2>
        <div class="card-body">

            @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
            @endsession

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success btn-sm" href="{{ route('comments.create', ['post_id' => app('request')->input('post_id')]) }}"> <i class="fa fa-plus"></i> Create New Comment</a>
            </div>

            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Content</th>
                    <th>Title</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $comment->content }} -- post id: {{ $comment->post->id }}, {{ $comment->post->title }}</td>
                        <td>{{ $comment->title }}</td>
                        <td>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">

                                <a class="btn btn-info btn-sm" href="{{ route('comments.show',$comment->id) }}"><i class="fa-solid fa-list"></i> Show</a>

                                <a class="btn btn-primary btn-sm" href="{{ route('comments.edit',$comment->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>

            </table>

            {!! $comments->links() !!}

        </div>
    </div>

@endsection

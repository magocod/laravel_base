@extends('layouts.app')

@section('content')

    <body>

        <title>CRUDPosts</title>

        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand h1" href={{ route('posts.index') }}>CRUDPosts</a>
                <div class="justify-end ">
                    <div class="col ">
                        <a class="btn btn-sm btn-success" href={{ route('posts.create') }}>Add Post</a>
                    </div>
                </div>
        </nav>
        <div class="container mt-5">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->body }}</p>

                                <br>

                                <p class="card-text">Comments</p>

                                @foreach ($post->comments as $comment)
                                    <br>
                                    <button type="button">{{ $comment->content }} - {{ $comment->title }}</button>
                                @endforeach


                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm">
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                           class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('comments.index', ['post_id' => $post->id]) }}"
                                           class="btn btn-primary btn-sm">Comments</a>
                                    </div>
                                    <div class="col-sm">
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>


@endsection

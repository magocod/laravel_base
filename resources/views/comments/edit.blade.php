@extends('layouts.app')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Edit Comment</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('comments.index', ['post_id' => $comment->post_id]) }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inputContent" class="form-label"><strong>Content:</strong></label>
                    <input
                        type="text"
                        name="content"
                        value="{{ $comment->content }}"
                        class="form-control @error('content') is-invalid @enderror"
                        id="inputContent"
                        placeholder="Content">
                    @error('content')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <select name="title">
                        @foreach ($notes as $note)
                            <option value="{{ $note->title }}" {{ $comment->title == $note->title ? "selected" : "" }}>
                                {{ $note->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('title')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </form>

        </div>
    </div>

@endsection

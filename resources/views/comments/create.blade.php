@extends('layouts.app')

@section('content')

    @if (app('request')->input('post_id') != null)
        check query string post id {{ app('request')->input('post_id') }}
    @else
        error query string post id
    @endif

    <div class="card mt-5">
        <h2 class="card-header">Add New Comment</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('comments.index', ['post_id' => app('request')->input('post_id')]) }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputContent" class="form-label"><strong>Content:</strong></label>
                    <input
                        type="text"
                        name="content"
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
                            <option value="{{ $note->title }}">
                                {{ $note->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('title')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" value="{{ app('request')->input('post_id') }}" name="post_id">

                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>

@endsection

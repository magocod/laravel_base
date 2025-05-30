@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <br>
                <button type="button" onclick="window.location='{{ URL::route('posts.index') }}'">POSTS</button>
                <br>
                <button type="button" onclick="window.location='{{ URL::route('notes.index') }}'">NOTES</button>
                <br>
                <button type="button" onclick="window.location='{{ URL::route('products.index') }}'">PRODUCTS</button>

            </div>
        </div>
    </div>
</div>
@endsection

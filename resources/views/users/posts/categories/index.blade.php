@extends('layouts.app')

@section('title', 'Category Index')

@section('content')
{{-- Display posts in selected category --}}
<div class="row gx-5">
    <div class="col-8">
        <p class="h3 text-center mb-3">Selected category : <span class="badge bg-secondary bg-opacity-50 "> {{ $category->name }}</span></p>

        {{-- {{$home_posts}} --}}
        {{-- @foreach ($home_posts->posts as $post) --}}
        @foreach ($category->posts as $post)
        {{-- {{ $post->description}} --}}
            <div class="card mb-4">
                @include('users.posts.contents.title')
                @include('users.posts.contents.body')
            </div>
        @endforeach
    </div>

    <div class="col-4 bg-light mt-5">
        @include('users.suggestions')
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Category Index')

@section('content')
{{-- Display all posts related to the selected category --}}
<div class="row gx-5">
    <div class="col-8">
        <p class="h3 text-center mb-3">Selected category : <span class="badge bg-secondary bg-opacity-50 "> {{ $category->name }}</span></p>

        @foreach ($home_posts as $post)
            <div class="card mb-4">
                @include('users.posts.contents.title')
                @include('users.posts.contents.body')
            </div>
        @endforeach
    </div>

    <div class="col-4 bg-light mt-5">
        {{-- Profile Overview --}}
        <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', Auth::user()->id) }}">
                    @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0">
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
        @include('users.suggestions.index')
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Suggestion Show')

@section('content')

<div class="mx-auto w-50">
    <p class="fw-bold text-secondary h4 text-center">Suggestions For You</p>

    <div class="w-75 mx-auto mt-4 suggest-user-scroll">
        @forelse ($suggested_users as $user)
            {{$user->isFollowed()}}
            <div class="row align-items-center mb-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', $user->id) }}">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                        @endif
                    </a>
                </div>

                <div class="col ps-0 text-truncate">
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name}}</a>
                </div>

                <div class="col-auto">
                    <form action="{{ route('follow.store', $user->id) }}" method="post">
                        @csrf
                        <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-dark alert alert-dark h5 text-center">There are no user yet...</p>
        @endforelse
    </div>
</div>
@endsection

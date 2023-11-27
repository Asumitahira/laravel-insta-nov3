@extends('layouts.app')

@section('title', 'Follower')

@section('content')
    @include('users.profile.header')

    {{-- Display all the follower --}}
    <div class="mt-5 w-25 mx-auto">
        @if (count($followers) === 0)
            <h5 class="text-muted text-center">No One Followed You Yet</h5>
        @else
            <h5 class="text-center mb-3">Follower</h5>
            @foreach ($followers as $user)
            <div class="row mt-2">
                <div class="col-auto">
                    <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->avatar }}" class="rounded-circle avatar-sm">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                        @endif
                    </a>
                </div>

                <div class="col-auto p-0">
                    <p>{{ $user->name }}</p>
                </div>

                @if ($user->id !== Auth::user()->id && !$user->isFollowed())
                    <div class="col">
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="col float-end text-primary btn btn-link text-decoration-none">Follow</button>
                        </form>
                    </div>
                @else
                    <div class="col">
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="col float-end text-secondary btn btn-link text-decoration-none">Following</button>
                        </form>
                    </div>
                @endif
            </div>
            @endforeach
        @endif
    </div>
@endsection

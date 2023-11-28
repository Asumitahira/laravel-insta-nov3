@extends('layouts.app')

@section('title', 'Chat Suggest User')

@section('content')

{{-- Chat Box --}}
<div class="col-4 mx-auto">
    @if ($all_users)
    <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
        <div class="row">
            <div class="col-1">
                <a href="{{ route('chat.index', Auth::user()->id) }}" class="text-decoration-none text-secondary p-0 ms-2 btn"><i class="fa-solid fa-chevron-left"></i></a>
            </div>
            <div class="col">
                <p class="h5 mb-3 fw-bold text-secondary text-center">おすすめ</p>
                {{-- <p class="h5 mb-3 fw-bold text-secondary text-center">Suggestions For You</p> --}}
            </div>
        </div>

        @foreach ($all_users as $user)
            <div class="row align-items-center mb-3">
                <div class="col-auto mx-auto">
                    <a href="{{ route('chat.show', $user->id) }}">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm d-block mx-auto">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0 text-truncate">
                    <a href="{{ route('chat.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name}}</a>
                </div>
            </div>
        @endforeach
    </div>

    @else
    <p class="alert alert-dark">おすすめのユーザーが表示されます。</p>
    {{-- <p class="alert alert-dark">There are no user.</p> --}}
    @endif
</div>
@endsection


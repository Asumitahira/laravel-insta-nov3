@extends('layouts.app')

@section('title', 'Chat Show')

 @section('content')

{{-- Receiving user info --}}
<div class="row bg-white py-1">
    <div class="col-auto  mt-3">
        <a href="{{ route('chat.index', Auth::user()->id) }}" class="text-decoration-none text-dark"><i class="fa-solid fa-chevron-left fa-2x"></i></a>
    </div>
    <div class="col-auto">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md img-thumbnail" style="width: 3.5rem; height: 3.5rem; object-fit: cover;">
        @else
            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
        @endif
    </div>
    <div class="col-auto mt-3">
        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold align-items-center">{{ $user->name }}</a>
    </div>
</div>

{{-- Chat message--}}
<div class="chat-scroll">
    @if($chats)
        @forelse($chats as $key => $chat)
            {{-- Display the date --}}
            @if($key === 0 || $chat->created_at->format('Y-m-d') !== $chats[$key - 1]->created_at->format('Y-m-d'))
                <p class="text-center text-muted mt-3">{{ $chat->created_at->format('Y-m-d') }}</p>
            @endif

            {{-- Display the message --}}
            <div class="row mb-3">
                <div class="col">
                    {{--  Avatar --}}
                    @if ($user->id === $chat->sender_id)
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle " style="width: 2.5rem; height: 2.5rem; object-fit: cover;">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                        @endif
                    @else
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle float-end" style="width: 2.5rem; height: 2.5rem; object-fit: cover;">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-ssm  float-end"></i>
                        @endif
                    @endif

                    {{-- Message --}}
                    <p class="mb-3 p-2 d-inline ps-3 pe-3 chat-bg ms-2 @if($chat->sender_id === Auth::user()->id ) float-end me-2 @endif">{{$chat->content}}</p>

                    {{-- Time --}}
                    <p class="mb-3 p-2 d-inline small mt-1 @if($chat->sender_id === Auth::user()->id ) float-end  @endif">{{$chat->created_at->format('h:i A')}}</p>
                </div>
            </div>
        @empty
            <p class="h4 text-center text-secondary mt-5">No chat yet.</p>
        @endforelse
    @endif
</div>


{{-- Chatting Form --}}
<form action="{{ route('chat.store', $user->id) }}" method="post" class="mt-3 chat-form w-75 mb-3">
    @csrf
    <div class="row">
        <div class="col-10">
            <input type="text" name="content" id="#" class="form-control" placeholder="Enter a message">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn"><i class="fa-regular fa-paper-plane fa-2x"></i></button>
        </div>
    </div>
</form>
@endsection

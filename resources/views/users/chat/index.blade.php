@extends('layouts.app')

@section('title', 'Chat Index')

@section('content')
<div class="w-50 mx-auto">
    <div class="row">
        <div class="col-8">
            <p class="h2 text-end">Messages</p>
        </div>
        <div class="col text-end">
            <a href="{{ route('chat.suggestUser', Auth::user()->id) }}" class="text-decoration-none text-dark btn text-end" title="Add message"><i class="fa-solid fa-plus fa-2x"></i></a>
        </div>
    </div>

    @forelse($all_chats as $chats)
        @foreach($chats as $chat)
            <div class="row align-items-center my-3">
                {{-- Avatar --}}
                <div class="col-auto mx-auto">
                    @if ($chat->receiver->id === Auth::user()->id)
                        <a href="{{ route('chat.show', $chat->sender->id )}}">
                            @if ($chat->sender->avatar)
                                <img src="{{ $chat->sender->avatar }}" alt="{{ $chat->sender->name }}" class="rounded-circle avatar-md d-block mx-auto">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary fa-3x"></i>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('chat.show', $chat->receiver->id )}}">
                            @if ($chat->receiver->avatar)
                                <img src="{{ $chat->receiver->avatar }}" alt="{{ $chat->receiver->name }}" class="rounded-circle avatar-md d-block mx-auto">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary fa-3x"></i>
                            @endif
                        </a>
                    @endif
                </div>

                {{-- Receiver name, content and time --}}
                <div class="col ps-0 text-truncate">
                    <ul class="list-unstyled">
                        <li class="mt-2">
                            @if ($chat->receiver->id === Auth::user()->id)
                                <a href="{{ route('chat.show', $chat->sender->id) }}" class="text-decoration-none text-dark fw-bold">{{ $chat->sender->name}}</a>
                            @else
                                <a href="{{ route('chat.show', $chat->receiver->id) }}" class="text-decoration-none text-dark fw-bold">{{ $chat->receiver->name}}</a>
                            @endif
                        </li>

                        <li>
                            <div class="row mt-2">
                                <div class="col">
                                    @if($chat->receiver->id === Auth::user()->id)
                                        <a href="{{ route('chat.show', $chat->sender->id) }}" class="text-decoration-none text-dark">{{ $chat->content}}</a>
                                    @else
                                        <a href="{{ route('chat.show', $chat->receiver->id) }}" class="text-decoration-none text-dark">{{ $chat->content}}</a>
                                    @endif
                                </div>
                                <div class="col-auto me-4">
                                    <p class="text-muted small"><span class="text-muted small">{{ $chat->created_at->diffForHumans()}}</span> </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    @empty
        <p class="h4 text-center text-secondary mt-5">No message yet.</p>
    @endforelse
</div>
@endsection

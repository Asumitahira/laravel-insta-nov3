@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.updatePassword') }}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h2 class="h3 mb-4 fw-light text-muted text-center">パスワードの変更</h2>
                {{-- <h2 class="h3 mb-4 fw-light text-muted text-center">Update Password</h2> --}}

                {{-- Avatar --}}
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg" style="width: 9rem; height: 9rem; object-fit: cover;">
                @else
                    <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                @endif

                {{-- Login user --}}
                <p class="h4 text-center mt-3">{{ $user->name }}</p>

                {{-- Current password --}}
                <div class="mb-3">
                    <label for="current-password" class="form-label fw-bold">現在のパスワード</label>
                    {{-- <label for="current-password" class="form-label fw-bold">Current Password</label> --}}
                    <input type="password" name="current_password" id="current-password" class="form-control" value="{{ old('current_password') }}">
                    @error('current_password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New password --}}
                <div class="mb-3">
                    <label for="new-password" class="form-label fw-bold">新しいパスワード</label>
                    {{-- <label for="new-password" class="form-label fw-bold">New Password</label> --}}
                    <input type="password" name="new_password" id="new-password" class="form-control" value="{{ old('new_password') }}" area-describedby="new-password-info">
                    <div class="form-text" id="new-password-info">
                         最小文字数 : 8文字
                    </div>
                    {{-- <div class="form-text" id="new-password-info">
                        Password must be at least 8 characters
                    </div> --}}
                    @error('new_password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmation password --}}
                <div class="mb-3">
                    <label for="confirmation-password" class="form-label fw-bold">パスワードの確認</label>
                    {{-- <label for="confirmation-password" class="form-label fw-bold">Confirmation Password</label> --}}
                    <input type="password" name="confirmation_password" id="confirmation-password" class="form-control" value="{{ old('confirmation_password') }}" placeholder="確認のため、新しいパスワードをもう一度入力してください。">
                    {{-- <input type="password" name="confirmation_password" id="confirmation-password" class="form-control" value="{{ old('confirmation_password') }}"> --}}
                    @error('confirmation_password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-outline-secondary me-1">戻る</a>
                {{-- <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-outline-secondary me-1">Back</a> --}}
                <button type="submit" class="btn btn-secondary px-5 mx-auto">保存</button>
                {{-- <button type="submit" class="btn btn-secondary px-5 mx-auto d-block ">Save</button> --}}
            </form>

            {{-- Display the result of updating --}}
            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mt-3 pb-0">
                    {{ session('success') }}
                    <p><a href="{{ route('profile.show', $user->id ) }}">プロフィールページ </a> に戻る</p>
                    {{-- <p>Back to <a href="{{ route('profile.show', $user->id ) }}"> Profile Page</a></p> --}}
                </div>
            @endif
        </div>
    </div>
@endsection

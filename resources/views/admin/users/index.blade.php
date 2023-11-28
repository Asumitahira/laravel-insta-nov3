@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary text-center">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>名前</th>
                {{-- <th>NAME</th> --}}
                <th>メールアドレス</th>
                {{-- <th>EMAIL</th> --}}
                <th>作成日時</th>
                {{-- <th>CREATED AT</th> --}}
                <th>ステータス</th>
                {{-- <th>STATUS</th> --}}
                <th></th>
                {{-- <th>ACTION BUTTONS</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-md text-secondary"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; 無効化
                            {{-- <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive --}}
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; 有効化
                            {{-- <i class="fa-solid fa-circle text-success"></i>&nbsp; Active --}}
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->id !== $user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu">
                                    @if ($user->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-check"></i> {{ $user->name }} を有効化する
                                            {{-- <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }} --}}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> {{ $user->name }} を無効化する
                                            {{-- <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }} --}}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            @include('admin.users.modal.status')
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>

@endsection

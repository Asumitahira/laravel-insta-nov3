<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg" style="width: 9rem; height: 9rem; object-fit: cover;">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>

    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-5 mb-0">{{ $user->name }}</h2>
            </div>

            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">プロフィールを編集</a>
                    {{-- <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a> --}}
                @else
                    @if ($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-secondary btn-sm fw-bold">フォロー中</button>
                            {{-- <button class="btn btn-outline-secondary btn-sm fw-bold">Following</button> --}}
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm fw-bold">フォロー</button>
                            {{-- <button class="btn btn-primary btn-sm fw-bold">Follow</button> --}}
                        </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none fw-bold text-dark">
                    <strong>{{ $user->posts->count() }}</strong> 投稿
                    {{-- <strong>{{ $user->posts->count() }}</strong> Posts --}}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.follower', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> フォロワー
                    {{-- <strong>{{ $user->followers->count() }}</strong> Followers --}}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->following->count() }}</strong> フォロー中
                    {{-- <strong>{{ $user->following->count() }}</strong> Following --}}
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>

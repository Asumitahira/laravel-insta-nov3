@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary text-center">
        <thead class="small table-success text-secondary">
            <tr>
                <th>#</th>
                <th>写真</th>
                <th>カテゴリー</th>
                {{-- <th>CATEGORY</th> --}}
                <th>投稿者</th>
                {{-- <th>OWNER</th> --}}
                <th>作成日時</th>
                {{-- <th>CREATED AT</th> --}}
                <th>ステータス</th>
                {{-- <th>STATUS</th> --}}
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($all_posts as $post)
                <tr>
                    <td class="text-end">{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="d-block mx-auto image-md">
                        </a>
                    </td>
                    <td>
                        @forelse ($post->categoryPost as $category_post)
                            <span class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</span>
                        @empty
                            <div class="badge bg-dark text-wrap">未カテゴリ</div>
                            {{-- <div class="badge bg-dark text-wrap">Uncategorized</div> --}}
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-secondary">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp; 非表示
                            {{-- <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp; Hidden --}}
                        @else
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; 表示
                            {{-- <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible --}}
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            @if ($post->trashed())
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-secondary" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> # {{ $post->id }} を表示する
                                        {{-- <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }} --}}
                                    </button>
                                </div>
                            @else
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> # {{ $post->id }} を非表示にする
                                        {{-- <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }} --}}
                                    </button>
                                </div>
                            @endif
                        </div>
                        @include('admin.posts.modal.status')
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="lead text-muted text-center" colspan="7">投稿が見つかりません</td>
                    {{-- <td class="lead text-muted text-center" colspan="7">No Post Found</td> --}}
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>
@endsection




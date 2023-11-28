{{-- Hide Post --}}
<div class="modal fade" id="hide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> 投稿の非表示
                    {{-- <i class="fa-solid fa-eye-slash"></i> Hide Post --}}
                </h3>
            </div>

            <div class="modal-body">
                <p>本当にこの投稿を非表示にしますか?</p>
                {{-- <p>Are you sure you want to hide this post?</p> --}}
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.posts.hide', $post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal">キャンセル</button>
                    {{-- <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-danger btn-sm">非表示</button>
                    {{-- <button type="submit" class="btn btn-danger btn-sm">Hide</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Unhide Post --}}
<div class="modal fade" id="unhide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-eye"></i> 投稿の表示
                    {{-- <i class="fa-solid fa-eye"></i> Unhide Post --}}
                </h3>
            </div>

            <div class="modal-body">
                <p>本当にこの投稿を表示させますか?</p>
                {{-- <p>Are you sure you want to unhide this post?</p> --}}
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.posts.unhide', $post->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal">Cancel</button> --}}
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal">キャンセル</button>
                    {{-- <button type="submit" class="btn btn-success btn-sm">Unhide</button> --}}
                    <button type="submit" class="btn btn-success btn-sm">表示</button>
                </form>
            </div>
        </div>
    </div>
</div>






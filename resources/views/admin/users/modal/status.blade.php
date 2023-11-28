{{-- Deactivative --}}
<div class="modal fade" id="deactivate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> ユーザーの無効化
                    {{-- <i class="fa-solid fa-user-slash"></i> Deactivative User --}}
                </h3>
            </div>

            <div class="modal-body">
                本当に <span class="fw-bold text-danger">{{ $user->name }}</span> を無効化にしますか?<br>
                無効化にしている間、該当のユーザに関する情報が <br> 全て参照出来なくなります。
                {{-- Are you sure you want to deactivative <span class="fw-bold">{{ $user->name }}</span>? --}}
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    {{-- <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-danger btn-sm">無効化</button>
                    {{-- <button type="submit" class="btn btn-danger btn-sm">Deactivate</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Activative --}}
<div class="modal fade" id="activate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i> ユーザーの有効化
                    {{-- <i class="fa-solid fa-user-check"></i> Activative User --}}
                </h3>
            </div>

            <div class="modal-body">
                本当に <span class="fw-bold text-danger">{{ $user->name }}</span> を有効にしますか?
                {{-- Are you sure you want to activative <span class="fw-bold">{{ $user->name }}</span>? --}}
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.users.activate', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">キャンセル</button>
                    {{-- <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-success btn-sm">有効化</button>
                    {{-- <button type="submit" class="btn btn-success btn-sm">Activate</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>


@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row gx-2 mb-4">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="カテゴリーを追加" autofocus>
                {{-- <input type="text" name="name" class="form-control" placeholder="Add a category..." autofocus> --}}
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> 追加
                    {{-- <i class="fa-solid fa-plus"></i> Add --}}
                </button>
            </div>
        </div>
        {{-- Error message area --}}
        @error('name')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </form>

    <div class="row">
        <div class="col-7">
            <table class="table table-hover align-middle bg-white table-sm text-secondary text-center">
                <thead class="table-warning small text-secondary">
                    <th>#</th>
                    <th>名前</th>
                    {{-- <th>NAME</th> --}}
                    <th>ポスト数</th>
                    {{-- <th>COUNT</th> --}}
                    <th>投稿日時</th>
                    {{-- <th>LAST UPDATED</th> --}}
                    <th></th>
                </thead>

                <tbody>
                    @forelse ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-dark">{{ $category->name }}</td>
                            <td>{{ $category->categoryPost->count() }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                {{-- Edit Button --}}
                                <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="編集">
                                {{-- <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit"> --}}
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                {{-- Delete Button --}}
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="削除">
                                {{-- <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete"> --}}
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Include the modal here --}}
                        @include('admin.categories.modal.action')
                    @empty
                        <tr>
                            <td colspan="5">カテゴリーが見つかりません</td>
                            {{-- <td colspan="5">No Categories Found</td> --}}
                        </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td class="text-dark">
                            Uncategorized
                            <p class="small mb-0 text-muted">非表示のポストは省く</p>
                            {{-- <p class="small mb-0 text-muted">Hidden posts are not included.</p> --}}
                        </td>
                        <td>{{ $uncategorized_count }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $all_categories->links() }}
            </div>
        </div>
    </div>
@endsection




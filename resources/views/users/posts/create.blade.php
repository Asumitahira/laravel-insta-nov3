@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                カテゴリー <span class="text-muted fw-normal">(最大 3個選択出来ます。)</span>
                {{-- Category <span class="text-muted fw-normal">(Up to 3)</span> --}}
            </label>
            @foreach ($all_categories as $category)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input"> {{-- $_POST['category'] = array(1, 2, 3); --}}
                <label for="{{  $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
            @endforeach
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">投稿内容</label>
            {{-- <label for="description" class="form-label fw-bold">Description</label> --}}
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="キャプションを入力">{{ old('description') }}</textarea>
            {{-- <textarea name="description" id="description" rows="5" class="form-control" placeholder="What's on your mind">{{ old('description') }}</textarea> --}}
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="form-label fw-bold">イメージ</label>
            {{-- <label for="image" class="form-label fw-bold">Image</label> --}}
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div class="form-text" id="image-info">
                使用できる拡張子は jpeg, jpg, png, gif です。 <br>
                最大ファイルサイズ: 1048kb.
            </div>
            {{-- <div class="form-text" id="image-info">
                The acceptable formats are jpeg, jpg,png,and gif only. <br>
                Max file size: 1048kb.
            </div> --}}
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary px-5">投稿</button>
        {{-- <button type="submit" class="btn btn-primary px-5">Post</button> --}}
    </form>
@endsection

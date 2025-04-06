{{-- 投稿作成ページ --}}
@extends('layouts.admin')
@section('title', '投稿作成')
@section('page-title', '投稿作成')
@section('content')
<div class="section">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>サムネイル</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>

                <div class="form-group">
                    <label>カテゴリー</label>
                    <select name="category_ids[]" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>コンテンツ</label>
                    <textarea name="content" class="form-control" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label>ステータス</label>
                    <select name="status" class="form-control">
                        <option value="draft">下書き</option>
                        <option value="published">公開</option>
                        <option value="archived">アーカイブ</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">作成</button>
            </form>
        </div>
    </div>
</div>
@endsection
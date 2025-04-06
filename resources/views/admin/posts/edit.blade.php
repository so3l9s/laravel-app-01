{{-- 投稿編集ページ --}}
@extends('layouts.admin')
@section('title', '投稿編集')
@section('page-title', '投稿編集')
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
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                </div>

                <div class="form-group">
                    <label>現在のサムネイル</label><br>
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" width="300">
                    @endif
                </div>

                <div class="form-group">
                    <label>新しいサムネイル</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>

                <div class="form-group">
                    <label>カテゴリー</label>
                    <select name="category_ids[]" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                @if($post->categories->contains($category->id)) selected @endif>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>コンテンツ</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label>ステータス</label>
                    <select name="status" class="form-control">
                        <option value="draft" @if($post->status === 'draft') selected @endif>下書き</option>
                        <option value="published" @if($post->status === 'published') selected @endif>公開</option>
                        <option value="archived" @if($post->status === 'archived') selected @endif>アーカイブ</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection

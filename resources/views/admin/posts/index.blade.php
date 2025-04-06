{{-- 投稿一覧ページ --}}
@extends('layouts.admin')
@section('title', '投稿一覧')
@section('page-title', '投稿一覧')
@section('content')
<div class="section">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">新規追加</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th>サムネイル</th>
                        <th>カテゴリー</th>
                        <th>ステータス</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" width="150">
                            @endif
                        </td>
                        <td>{{ $post->categories->pluck('category_name')->join(', ') }}</td>
                        <td>
                            @if($post->status === 'draft')
                                <span class="badge badge-secondary">下書き</span>
                            @elseif($post->status === 'published')
                                <span class="badge badge-success">公開</span>
                            @elseif($post->status === 'archived')
                                <span class="badge badge-danger">アーカイブ</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">編集</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('title', 'カテゴリー一覧')
@section('page-title', 'カテゴリー管理')

@section('content')
<div class="card">
  <div class="card-header">
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">新規カテゴリー追加</a>
  </div>
  <div class="card-body">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>カテゴリー名</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($category as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
              <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning">編集</a>
              <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
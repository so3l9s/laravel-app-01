@extends('layouts.admin')
@section('title', '管理者一覧')
@section('page-title', '管理者一覧')

@section('content')
<div class="card">
  <div class="card-header">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">新規管理者追加</a>
  </div>

  <div class="card-body">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>名前</th>
          <th>メールアドレス</th>
          <th>作成日</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('Y-m-d') }}</td>
            <td>
              <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">編集</a>
              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="d-flex justify-content-center mt-3">
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection

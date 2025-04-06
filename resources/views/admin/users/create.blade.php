@extends('layouts.admin')
@section('title', '管理者新規作成')
@section('page-title', '管理者新規作成')

@section('content')
<div class="card">
  <div class="card-header">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">一覧に戻る</a>
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <div class="form-group">
        <label>パスワード</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="form-group">
        <label>パスワード（確認）</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">登録する</button>
    </form>
  </div>
</div>
@endsection

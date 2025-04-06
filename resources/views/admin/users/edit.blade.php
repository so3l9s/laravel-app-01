@extends('layouts.admin')
@section('title', '管理者編集')
@section('page-title', '管理者編集')

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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
      </div>

      <div class="form-group">
        <label>パスワード（変更する場合のみ入力）</label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="form-group">
        <label>パスワード（確認）</label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">更新する</button>
    </form>
  </div>
</div>
@endsection

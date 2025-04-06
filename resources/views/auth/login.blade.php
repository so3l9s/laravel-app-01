@extends('layouts.admin')

@section('title', '管理者ログイン')
@section('page-title', '管理者ログイン')

@section('content')
<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.login') }}">
      @csrf

      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}">
        @error('email')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-block">ログイン</button>
    </form>
  </div>
</div>
@endsection

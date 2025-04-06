@extends('layouts.admin')
@section('title', 'カテゴリー作成')
@section('page-title', 'カテゴリー作成')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.category.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>カテゴリー名</label>
        <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>
        @error('category_name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
      <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">戻る</a>
    </form>
  </div>
</div>
@endsection
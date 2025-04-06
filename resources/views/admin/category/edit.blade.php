@extends('layouts.admin')
@section('title', 'カテゴリー編集')
@section('page-title', 'カテゴリー編集')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>カテゴリー名</label>
        <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}">
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-success">更新</button>
      <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">戻る</a>
    </form>
  </div>
</div>
@endsection
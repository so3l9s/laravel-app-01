<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'thumbnail', 'status'];

    // カテゴリーとのリレーション（多対多）
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    // ユーザーとのリレーション（多対一）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

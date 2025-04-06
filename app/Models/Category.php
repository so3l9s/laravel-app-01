<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'slug'];

    // 投稿とのリレーション（多対多）
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
}

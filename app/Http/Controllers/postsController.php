<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;

class postsController extends Controller
{
    public function index()
    {
        $posts = posts::where('status', 'published')->paginate(9); // 公開された投稿のみ取得
        return view('posts.index', compact('posts'));
    }
}

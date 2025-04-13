<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostAdminController extends Controller
{
    public function index()
    {
        // 投稿一覧を取得（カテゴリーも一緒に取得）
        $posts = Post::with('categories', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        // カテゴリー一覧を取得
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // TODO フォームリクエストを使用
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'category_ids' => 'array|required',
        ]);

        // 投稿データを取得
        $data = $request->all();
        $data['user_id'] = auth()->id();

        // サムネイル画像の保存
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // 投稿の作成
        $post = Post::create($data);

        // カテゴリーを関連付け
        $post->categories()->attach($request->category_ids);

        return redirect()->route('admin.posts.index')->with('success', '投稿を作成しました。');
    }

    public function edit(Post $post)
    {
        // カテゴリー一覧を取得
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        // TODO フォームリクエストを使用
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'category_ids' => 'array|required',
        ]);

        // 投稿データを取得
        $data = $request->all();

        // サムネイル画像の更新処理
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($post->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // 投稿データを更新
        $post->update($data);

        // カテゴリーの関連付けを更新
        $post->categories()->sync($request->category_ids);

        return redirect()->route('admin.posts.index')->with('success', '投稿を更新しました。');
    }

    public function destroy(Post $post)
    {
        // サムネイル画像を削除
        Storage::disk('public')->delete($post->thumbnail);

        // TODO なくても良い
        // カテゴリーの関連付けを解除
        $post->categories()->detach();

        // 投稿を削除
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', '投稿を削除しました。');
    }
}

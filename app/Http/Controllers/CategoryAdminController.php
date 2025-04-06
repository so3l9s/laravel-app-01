<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    // 一覧表示
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    // 作成画面
    public function create()
    {
        return view('admin.category.create');
    }

    // 保存処理
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);
        
        return redirect()->route('admin.category.index')->with('success', 'カテゴリーを作成しました。');
    }

    // 編集画面
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    // 更新処理
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->id . '|max:255',
        ]);
    
        // カテゴリー名を更新しつつ、スラッグも再生成
        $category->update([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);
    
        return redirect()->route('admin.category.index')->with('success', 'カテゴリーを更新しました。');
    }

    // 削除処理
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'カテゴリーを削除しました。');
    }
}

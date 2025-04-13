<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 一覧
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 作成画面
    public function create()
    {
        return view('admin.users.create');
    }

    // 保存処理
    public function store(Request $request)
    {
        // TODO フォームリクエストを使用
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', '管理者を作成しました。');
    }

    // 編集画面
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 更新処理
    public function update(Request $request, User $user)
    {
        // TODO フォームリクエストを使用
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only('name', 'email');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', '管理者を更新しました。');
    }

    // 削除処理
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', '管理者を削除しました。');
    }
}

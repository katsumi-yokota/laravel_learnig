<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest; // フォームリクエスト store
use App\Http\Requests\User\UpdateRequest; // フォームリクエスト update
use Illuminate\Support\Facades\Hash; // ハッシュ化
use Illuminate\Support\Facades\Route; // ルーティング

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $sort = $request->sort;
        $users = User::query()->sortable()->withTrashed()->paginate(5); // 論理削除されたユーザーも取得、表示
        return view('user.index', ['users' => $users, 'sort' => $sort]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->validated(); // バリデーション済み全データ
        $inputs['password'] = Hash::make($inputs['password']); // ハッシュ化
        User::create($inputs);

        return redirect('/user')->with('succeed', '新規登録が完了しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id); // 主キー（id）を指定
        dd($user->id);
        return view('user.show', compact('user')); // compact()関数でshow.blade.phpにデータを渡す
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id) // バリデーション
    {
        $validatedDataAtUpdate = $request->validated();

        // パスワードが空の場合はパスワードのみアップデートしない
        if (empty($validatedDataAtUpdate['password'])) 
        {
            unset($validatedDataAtUpdate['password']); // パスワードを破棄
        }

        $user = User::find($id);
        $user->fill($validatedDataAtUpdate)->save();

        return redirect()->route('user.index')->with('succeed', '編集が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // 複数削除
        return redirect()->route('user.index')->with('warning', '削除が完了しました。');
    }

    // 論理削除の復元
    public function restore(User $user)
    {
        User::withTrashed()->where('id', $user->id)->restore();
        return redirect()->route('user.index')->with('succeed', '復元が完了しました。');
    }
}

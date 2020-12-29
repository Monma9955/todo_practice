<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // リクエストを引数「$request」として渡す
    public function create(CreateFolder $request)
    {
        $folder = new Folder();
        // フォルダーテーブルのtitleカラムに入力値のtitleを代入
        $folder->title = $request->title;
        // リレーションを利用してログインユーザーに紐付けてDBに保存
        Auth::user()->folders()->save($folder);

        // 作成したフォルダーIDで一覧に戻る
        return redirect()->route('tasks.index', [
            'folder' => $folder->id
        ]);
    }
}

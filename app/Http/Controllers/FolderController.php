<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // リクエストを引数「$request」として渡す
    public function create(Request $request)
    {
        $folder = new Folder();
        // フォルダーテーブルのtitleカラムに入力値のtitleを代入
        $folder->title = $request->title;
        // DBに保存
        $folder->save();

        // 作成したフォルダーIDで一覧に戻る
        return redirect()->route('tasks.index', [
            'id' => $folder->id
        ]);
    }
}

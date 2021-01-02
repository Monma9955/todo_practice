<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // ログインユーザーに紐付いた最初のフォルダを取得
        $user = Auth::user();
        $folder = $user->folders()->first();

        // フォルダが存在しなければhomeビューを表示
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダが存在していればtasks.indexビューを表示
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // URLのidをindexアクションで受け取る
    public function index(int $id)
    {
        // フォルダーテーブルのレコードをすべて格納
        $folders = Folder::all();

        // ビューを返す
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id
        ]);
    }
}

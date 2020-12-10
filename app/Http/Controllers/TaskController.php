<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // URLのidをindexアクションで受け取る
    public function index(int $id)
    {
        // フォルダテーブルのレコードをすべて取得
        $folders = Folder::all();

        // 選択されたフォルダのレコードを取得
        $current_folder = Folder::find($id);

        // 選択されたフォルダに紐づくタスクのレコードを取得(getを忘れないよう注意)
        $tasks = $current_folder->tasks()->get();

        // ビューを返す
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder,
            'tasks' => $tasks
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }
}

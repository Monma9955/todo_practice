<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // URLのidをindexアクションで受け取る
    public function index(Folder $folder)
    {
        // ログインユーザーに紐づくフォルダを取得
        $folders = Auth::user()->folders()->get();

        // 選択されたフォルダに紐づくタスクのレコードを取得(getを忘れないよう注意)
        $tasks = $folder->tasks()->get();

        // ビューを返す
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks
        ]);
    }

    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder' => $folder->id,
        ]);
    }

    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 現在のフォルダーのタスクとしてテーブルに保存
        $folder->tasks()->save($task);

        // 作成したタスクの格納されているフォルダーのindexにリダイレクト
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    public function showEditForm(Folder $folder, Task $task)
    {
        // checkRelationでリレーションのエラーチェック
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        // $taskにリクエストのデータを代入してsave
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        // フォルダーのIDが編集中タスクのフォルダIDと異なる場合は404エラー
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
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

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // current_folderのタスクとしてテーブルに保存
        $current_folder->tasks()->save($task);

        // 作成したタスクの格納されているフォルダーのindexにリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        // DBからリクエストされたタスクを取得
        $task = Task::find($task_id);

        // $taskにリクエストのデータを代入してsave
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}

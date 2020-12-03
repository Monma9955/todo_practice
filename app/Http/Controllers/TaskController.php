<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $folders = Folder::all();
        return view('tasks/index', [
            'folders' => $folders
        ]);
    }
}

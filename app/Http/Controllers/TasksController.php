<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class TasksController extends Controller
{
    public function userList()
    {
        $users = User::getUsersList();
        return view('Tasks.TasksList.TasksList', ['users' => $users]);
    }

    public function taskList(int $userId):JsonResponse
    {
        $tasks = Task::getTasksByUserId($userId);
        return response()->json($tasks, 200, ['Content-Type' => 'string']);
    }
}

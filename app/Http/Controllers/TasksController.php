<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function userList(): View

    {
        $users = User::getUsersList();
        return view('Tasks.TasksList.TasksList', ['users' => $users]);
    }

    public function taskList(int $userId): JsonResponse
    {
        $tasks = Task::getTasksByUserId($userId);
        return response()->json($tasks, 200, ['Content-Type' => 'string']);
    }

    public function indexCreate(): View
    {
        $users = User::getUsersList();
        return view('Tasks.TasksForm.TasksForm', ['users' => $users]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string|ends_with:Сделано,В работе,Не сделано',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect(route('taskIndexCreate'))->withErrors([
                'error' => $validator->errors()->first()
            ])->withInput();
        }
        $task = Task::query()->create($fields);
        return redirect(route('taskIndexPersonal', $task->id));
    }

    public function indexPersonal(int $taskId)
    {
        $task = Task::query()->find($taskId);
        if ($task !== null) {
            return view('Tasks.TasksPersonal.TasksPersonal', ['task' => $task]);
        }
        return redirect(route('userList'));
    }
}

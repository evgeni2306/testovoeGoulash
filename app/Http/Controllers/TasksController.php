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

    public function form($task = null):View
    {
        $users = User::getUsersList();
        return view('Tasks.TasksForm.TasksForm', ['users' => $users, 'task' => $task]);
    }

    public function store(Request $request)
    {
        if ($request->method() === "GET") {
            return $this->form();
        }
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

    public function update(Request $request, int $taskId): \Illuminate\Http\RedirectResponse|View
    {
        $task = Task::query()->find($taskId);
        if ($request->method() === "GET") {
            if ($task !== null) {
                return $this->form($task);
            }
            return redirect(route('userList'));
        }
        $fields = $request->all();
        $fields['taskId'] = $taskId;
        $validator = Validator::make($fields, [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string|ends_with:Сделано,В работе,Не сделано',
            'user_id' => 'required|integer|exists:users,id',
            'taskId' => 'required|integer|exists:tasks,id'
        ]);
        $task->update($fields);
        return redirect(route('userList'));
    }


    public function indexPersonal(int $taskId): \Illuminate\Http\RedirectResponse|View
    {
        $task = Task::query()->find($taskId);
        if ($task !== null) {
            $task->userName = User::query()->find($task->user_id)->name;
            return view('Tasks.TasksPersonal.TasksPersonal', ['task' => $task]);
        }
        return redirect(route('userList'));
    }

    public function delete(int $taskId): \Illuminate\Http\RedirectResponse
    {
        $task = Task::query()->find($taskId);
        if ($task !== null) {
            $task->delete();
        }
        return redirect(route('userList'));
    }


}

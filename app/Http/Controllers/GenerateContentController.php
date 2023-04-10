<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GenerateContentController extends Controller
{
    public function generate(){
        $users = [
            ['name'=>'evgen','email'=>"evgen@mail.ru",'age'=>9,'password'=>'evgen123'],
            ['name'=>'alex','email'=>"alex@mail.ru",'age'=>4,'password'=>'alex123'],
            ['name'=>'vlad','email'=>"vlad@mail.ru",'age'=>9,'password'=>'vlad123'],
            ['name'=>'ivan','email'=>"ivan@mail.ru",'age'=>9,'password'=>'ivan123'],
        ];
        $tasks=[
            ["name"=>"Сделать коммит","description"=>'описание1',"status"=>'Не сделано','user_id'=>1],
            ["name"=>"отрефакторить код","description"=>'описание5',"status"=>'Не сделано','user_id'=>3],
            ["name"=>"Исправить баг","description"=>'описание2',"status"=>'Сделано','user_id'=>2],
            ["name"=>"Поднять сервак","description"=>'описание3',"status"=>'В работе','user_id'=>1],
            ["name"=>"Написать контроллер","description"=>'описание4',"status"=>'Не сделано','user_id'=>4],
        ];
        foreach ($users as $user){
            User::query()->create($user);
        }
        foreach ($tasks as $task){
            Task::query()->create($task);
        }

        dd('gotovo');
    }
}

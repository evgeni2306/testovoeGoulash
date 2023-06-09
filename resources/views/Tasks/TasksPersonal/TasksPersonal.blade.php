<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/Pages/Tasks/TasksPersonal/styles.css"}}"/>
</head>
<body>
<div class="container">
    <div class="taskInformation">
        <div class="information">
            <div class="fieldBLock">
                <div class="fieldName">Название:</div>
                <div class="informationField">{{$task->name}}</div>
            </div>
            <div class="fieldBLock">
                <div class="fieldName">Описание:</div>
                <div class="informationField">{{$task->description}}</div>
            </div>
            <div class="fieldBLock">
                <div class="fieldName">Статус:</div>
                <div class="informationField">{{$task->status}}</div>
            </div>
            <div class="fieldBLock">
                <div class="fieldName">Пользователь:</div>
                <div class="informationField">{{$task->userName}}</div>
            </div>
            <div class="fieldBLock">
                <div class="fieldName">Дата создания:</div>
                <div class="informationField">{{$task->created_at}}</div>
            </div>
        </div>
    </div>
    <div class="taskButtons">
        <div class="buttons">
            <button><a class="link" href="{{route('taskDelete',$task->id)}}">Удалить</a></button>
            <button><a class="link" href="{{route('taskIndexUpdate',$task->id)}}">Редактироваать</a></button>
        </div>

    </div>
</div>
</body>
</html>

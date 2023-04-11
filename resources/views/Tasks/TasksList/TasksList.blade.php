<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/Pages/Tasks/TasksList/styles.css"}}"/>
</head>
<body>
<select id="users" onchange="getTasks()">
    <option class="hidden" value="" disabled selected>Выберите пользователя</option>
    @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
</select>


<div class="taskList" id="taskList">

</div>


</body>
<script>
    function getTasks() {
        const taskList = document.getElementById('taskList');
        while (taskList.hasChildNodes()) {
            taskList.removeChild(taskList.lastChild);
        }
        userId = document.getElementById('users').value;
        tasks = requestGet(userId);
        for (i = 0; i < tasks.length; i++) {

            taskCard = document.createElement('div');
            taskCard.className = "taskCard";
            taskCard.innerHTML = taskCardBuilder(tasks[i]);
            taskList.append(taskCard);
        }
    }


    function taskCardBuilder(task) {
        const route = "{{route('tasks')}}"
        const routePersonal = "{{route('tasks')}}"+'='+task.id;
        const routeDelete="{{route('tasks')}}"+'/delete='+task.id;
        const routeUpdate="{{route('tasks')}}"+'/update='+task.id;
        const element =
           ' <div class="taskNameAndDate">'+
                '<div class="taskName">'+task.name+'</div>'+
                '<div class="taskDate">'+task.created_at+'</div>'+
           ' </div>'+
            '<div class="taskButtons">' +
            '<button><a href="'+ routePersonal+'">Смотреть</a></button>' +
            '<button><a href="'+ routeUpdate+'">Редактировать</a></button>' +
            '<button><a href="'+ routeDelete+'">Удалить</a></button>' +
            '</div>'
        return element
    }

    function requestGet(id) {
        route = "{{route('userList')}}" + "/user=" + id
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false);
        xmlHttp.send(null);
        return JSON.parse(xmlHttp.responseText);
    }

</script>
</html>

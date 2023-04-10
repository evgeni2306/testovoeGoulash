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
    {{--    <div class="taskCard">prjvet1</div>--}}
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
            taskCard.innerHTML = taskCardBuilder(tasks[i].name);
            taskList.append(taskCard);
        }
    }


    function taskCardBuilder(name) {
        const element = '<div> ' + name + ' </div>'
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

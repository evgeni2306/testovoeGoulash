<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/Pages/Tasks/TasksForm/styles.css"}}"/>
</head>
<body>
<div>
    @if($task===null)
        <form class="form" method="POST" action="{{route("taskCreate")}}">
            <div class="headline">Добавление задачи</div>
            <input class="form__input" required type="text" name="name" value="{{old('name')}}" placeholder="Название">
            <textarea class="form__input" required name="description"
                      placeholder="Описание">{{old('description')}}</textarea>
            <select class="form__input" required name="status">
                <option value="" disabled selected style="display:none;">Выберите статус</option>
                <option value="Сделано">Сделано</option>
                <option value="В работе">В работе</option>
                <option value="Не сделано">Не сделано</option>
            </select>
            <select class="form__input" required name="user_id">
                <option value="" disabled selected style="display:none;">Выберите Пользователя</option>
                @foreach( $users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @if ($errors->any())
                <div class="form__error">
                    <p class="">{{$errors->first()}}</p>
                </div>
            @endif
            <input type="submit" class="form__input" value="Отправить">
            @csrf
        </form>
    @else
        <form class="form" method="POST" action="{{route("taskUpdate", $task->id)}}">
            <div class="headline">Редактирование задачи</div>
            <input class="form__input" required type="text" name="name" value="{{$task->name}}" placeholder="Название">
            <textarea class="form__input" required name="description"
                      placeholder="Описание">{{$task->description}}</textarea>
            <select class="form__input" id="status" required name="status">
                <option value="{{$task->status}}" disabled selected style="display:none;">Выберите статус</option>
                <option value="Сделано">Сделано</option>
                <option value="В работе">В работе</option>
                <option value="Не сделано">Не сделано</option>
            </select>
            <select class="form__input" id="user_id" required name="user_id">
                <option value="{{$task->user_id}}" disabled selected style="display:none;">Выберите Пользователя
                </option>
                @foreach( $users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @if ($errors->any())
                <div class="form__error">
                    <p class="">{{$errors->first()}}</p>
                </div>
            @endif
            <input type="submit" class="form__input" value="Отправить">
            @csrf
        </form>
    @endif


</div>
</body>
<script>
    @if($task!==null)
    const select1 = document.getElementById('status').getElementsByTagName('option')
    if (select1[0].value !== "") {
        for (let i = 1; i < select1.length; i++) {
            if (select1[i].value === select1[0].value) select1[i].setAttribute('selected', 'selected')
        }
    }
    const select2 = document.getElementById('user_id').getElementsByTagName('option')
    if (select2[0].value !== "") {
        for (let i = 1; i < select2.length; i++) {
            if (select2[i].value === select2[0].value) select2[i].setAttribute('selected', 'selected')
        }
    }
    @endif
</script>
</html>

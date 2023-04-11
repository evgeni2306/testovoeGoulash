<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/Pages/Tasks/TasksForm/styles.css"}}"/>
</head>
<body>
<div>

    <form class="form" method="POST" action="{{route("taskCreate")}}">
        <div class="headline">Добавление задачи</div>
        <input class="form__input" required type="text" name="name" value="{{old('name')}}" placeholder="Название">
        <textarea class="form__input" required name="description" value="{{old('description')}}"
                  placeholder="Описание"></textarea>
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


</div>
</body>
</html>

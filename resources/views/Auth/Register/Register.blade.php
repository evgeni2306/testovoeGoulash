<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Register</title>
    <link rel="stylesheet" href="{{"/Pages/Auth/Registration/styles.css"}}">
</head>
<body>
<div class="container">
</div>
<div class="form__container">
    <h1 class="register__title">Регистрация</h1>
    <form class="form" action="{{route("registration")}}" method="post">
        <input class="form__input" required type="text" name="name" value="{{old('name')}}" placeholder="Имя">
        <input class="form__input" required type="email" name="email" value="{{old('email')}}" placeholder="Почта">
        <input class="form__input" type="number" step="1" min="0" value="{{old('age')}}" name="age" placeholder="Возраст">
        <input class="form__input" required type="password" name="password" value="" placeholder="Пароль">
        <input type="submit" class="primary-button" value="Зарегистрироваться">
        @csrf
    </form>
    @if ($errors->any())
        <div class="form__error">
            <p class="">{{$errors->first()}}</p>
        </div>
    @endif
</div>
</body>
</html>

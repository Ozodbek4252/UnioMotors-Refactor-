@extends('layouts.auth.main')

@section('content')
    <form class="theme-form login-form" style="border-radius: 10px" action="{{ route('login') }}" method="post">
        @csrf
        <h4>Войти</h4>
        <div class="form-group">
            <label>Логин</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="icon-email"></i>
                </span>
                <input name="email" class="form-control" type="email" required="">
            </div>
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="icon-lock"></i>
                </span>
                <input class="form-control" type="password" name="password" required="">
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Войти</button>
        </div>
        <p>Нет аккаунта?<a class="ms-2" href="{{ route('register') }}">Зарегистрироваться</a></p>
    </form>
@endsection
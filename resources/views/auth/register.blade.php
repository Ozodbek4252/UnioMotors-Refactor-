@extends('layouts.auth.main')

@section('content')
    <form class="theme-form login-form" style="border-radius: 10px" action="{{ route('register') }}" method="post">
        @csrf
        <h4>Зарегистрироваться</h4>
        <div class="form-group">
            <label>Имя</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="icon-user"></i>
                </span>
                <input name="name" class="form-control" type="text" required="">
            </div>
        </div>
        <div class="form-group">
            <label>Email</label>
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
            <label>Подтвердите пароль</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="icon-lock"></i>
                </span>
                <input class="form-control" type="password" name="password_confirmation" required="">
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Войти</button>
        </div>
        <p>Есть аккаунта?<a class="ms-2" href="{{ route('login') }}">Войти</a></p>
    </form>
@endsection



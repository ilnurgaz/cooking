<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/main.css">
        <script type="text/javascript" src="../assets/js/burger_menu.js"></script>
    </head>
    <body class="antialiased">
        <div class="wrapper">
            <header>
                <div class="header_wrapper container">
                    <div class="header_column-1">
                        <div class="burger_wrapper">
                            <button class="burger-btn" id="burgerBtn">&#9776;</button>
                            <nav class="navbar" id="navbar">
                                <ul>
                                    @if (Route::has('login'))
                                        @auth
                                            <li class="burger_reg-auth">
                                                <a href="{{ url('/dashboard') }}" class="link header_link">Профиль</a>
                                            </li>
                                            <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                        @else
                                            <li class="burger_reg-auth">
                                                <a href="{{ route('login') }}" class="link header_link">Войти |</a>
                                                <a href="{{ route('register') }}" class="link header_link">Зарегистрироваться</a>
                                            </li>
                                            <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                        @endauth
                                    @endif
                                    <a href="{{ route('main') }}" class="link header_link">Главная</a>
                                    <a href="{{ route('main') }}" class="link header_link">Главная</a>
                                    <a href="{{ route('main') }}" class="link header_link">Главная</a>
                                    <a href="{{ route('main') }}" class="link header_link">Главная</a>
                                </ul>
                            </nav>
                        </div>
                        <a href="{{ route('main') }}">
                            <img src="/assets/image/main/logo.svg" alt="Logo" title="Logo" class="header_logo">
                        </a>
                    </div> 
                    <div class="header_column-2">
                        <div class="header_reg-auth__wrapper">
                            <a href="{{ route('main') }}" class="link header_link">Главная</a>
                            <a href="{{ route('main') }}" class="link header_link">Рецепты</a>
                            <a href="{{ route('main') }}" class="link header_link">Статьи</a>
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('main') }}" class="link header_link">Мои рецепты</a>
                                    <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                @else
                                    <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                @endauth
                            @else
                                <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                            @endif
                        </div>
                    </div> 
                    <div class="header_column-3">
                        @if (Route::has('login'))
                            <div class="header_reg-auth__wrapper">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="link header_link">Профиль</a>
                                @else
                                    <a href="{{ route('login') }}" class="link header_link">Войти</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="link header_link">Зарегистрироваться</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </header>
            <main>
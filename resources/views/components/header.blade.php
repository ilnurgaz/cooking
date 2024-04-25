<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title-block')</title>
        <meta name="description" content="@yield('description-block')">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/main1.css">
        <script type="text/javascript" src="/assets/js/burger_menu.js"></script>
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
                                            @if(Auth::user()->hasRole('admin'))
                                                <li>
                                                    <a href="{{ route('admin') }}" class="link header_link">Панель администратора</a>
                                                </li>
                                                
                                            @endif
                                            <li class="burger_reg-auth">
                                                <a href="{{ url('/profile') }}" class="link header_link">Профиль</a>
                                            </li>
                                            <li class="button-target_wrapper">
                                                <a href="{{ route('add-recipes') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('my-recipes') }}" class="link header_link">Мои рецепты</a>
                                            </li>
                                        @else
                                            <li class="burger_reg-auth">
                                                <a href="{{ route('login') }}" class="link header_link">Войти |</a>
                                                <a href="{{ route('register') }}" class="link header_link">Зарегистрироваться</a>
                                            </li>
                                            <li  class="button-target_wrapper">
                                                <a href="{{ route('main') }}" class="link header_link button-target">+ Добавить рецепт</a>
                                            </li>
                                        @endauth
                                    @endif
                                    <li>
                                        <a href="{{ route('main') }}" class="link header_link">Главная</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('recipes') }}" class="link header_link">Рецепты</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('articles-data') }}" class="link header_link">Статьи</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}" class="link header_link">Контакты</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <a href="{{ route('main') }}">
                            <img src="/assets/image/main/logo.svg" alt="Logo" title="Logo" class="header_logo">
                            <img src="/assets/image/main/logo-small.svg" alt="Logo" title="Logo" class="header_logo-small">
                        </a>
                    </div> 
                    <div class="header_column-2">
                        <form action="{{ route ('recipes')}}" method="get"  class="header_seacrh__wrapper">
                            <input type="text" placeholder="Поиск рецептов" class="header_seacrh__input" name='search' id="search">
                            <button type="submit" class="header_seacrh__button" name='submit' id="submit"><img src="/assets/image/icon/search.svg" alt=""></button>
                        </form>
                        <a href="{{ route('add-recipes') }}" class="link header_link button-target">+ Добавить рецепт</a>
                    </div> 
                    <div class="header_column-3">
                        @if (Route::has('login'))
                            <div class="header_reg-auth__wrapper">
                                @auth
                                    <a href="{{ url('/profile') }}" class="link header_link">Профиль</a>
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
                <div class="main_content container">
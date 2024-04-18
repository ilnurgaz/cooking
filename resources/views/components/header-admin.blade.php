<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/main1.css">

        <script type="text/javascript" src="../assets/js/burger_menu.js"></script>
    </head>
    <body class="antialiased">
        <div class="wrapper">
            <header class="header_admin">
                <div class="header_wrapper container">
                    <div class="header_column-1">
                        <div class="burger_wrapper">
                            <button class="burger-btn" id="burgerBtn">&#9776;</button>
                            <nav class="navbar" id="navbar">
                                <ul>
                                    <li>
                                        <a href="{{ route('admin') }}" class="link header_link">Главная</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact-data') }}" class="link header_link">Сообщения</a>
                                    </li>
                                    <li>
                                    <a href="{{ route('admin-articles') }}" class="link header_link">Cтатьи</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin-recipes') }}" class="link header_link">Рецепты</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin-categories') }}" class="link header_link">Категории</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin-users') }}" class="link header_link">Пользователи</a>
                                    </li>
                                    <li class="burger_reg-auth">
                                        <a href="{{ url('/profile') }}" class="link header_link">Профиль</a>
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
                        <form action="" class="header_seacrh__wrapper">
                            <input type="text" placeholder="Поиск рецептов" class="header_seacrh__input" name='search' id="search">
                            <button type="submit" class="header_seacrh__button" name='submit' id="submit"><img src="/assets/image/icon/search.svg" alt=""></button>
                        </form>
                    </div> 
                    <div class="header_column-3">
                        <div class="header_reg-auth__wrapper">
                            <a href="{{ route('admin') }}" class="link header_link">Главная</a>
                            <a href="{{ route('contact-data') }}" class="link header_link">Сообщения</a>
                            <a href="{{ route('admin-articles') }}" class="link header_link">Cтатьи</a>
                            <a href="{{ route('admin-recipes') }}" class="link header_link">Рецепты</a>
                            <a href="{{ route('admin-categories') }}" class="link header_link">Категории</a>
                            <a href="{{ route('admin-users') }}" class="link header_link">Пользователи</a>
                            <a href="{{ url('/profile') }}" class="link header_link">Профиль</a>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <div class="main_content container">
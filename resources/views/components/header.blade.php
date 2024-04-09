<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body class="antialiased">
        <div class="wrapper container">
            <header class="container">
                <div class="header_wrapper">
                    <div class="header_column-1">

                    </div> 
                    <div class="header_column-2">

                    </div> 
                    <div class="header_column-3">
                        @if (Route::has('login'))
                            <div class="">
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
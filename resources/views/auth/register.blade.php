@section('title-block')
Регистрация
@endsection
<x-header/>
    <form method="POST" action="{{ route('register') }}" class="form_r_a">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="" />
        </div>

        <!-- Email Address -->
        <div class="">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>

        <!-- Password -->
        <div class="">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class=""
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="" />
        </div>

        <!-- Confirm Password -->
        <div class="">
            <x-input-label for="password_confirmation" :value="__('Подтверждение пароля')" />

            <x-text-input id="password_confirmation" class=""
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="" />
        </div>

        <div class="flex items-center justify-end ">
            <a class="form_link" href="{{ route('login') }}">
                {{ __('Уже зарегистрированы?') }}
            </a>

            <x-primary-button class="form_button">
                {{ __('Зарегистрироваться') }}
            </x-primary-button>
        </div>
    </form>
<x-footer/>

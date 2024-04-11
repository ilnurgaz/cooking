<x-header/>

    <form method="POST" action="{{ route('login') }}" class="form_r_a">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>

        <div class="">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class=""
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="" />
        </div>

        <div class="">
            <label for="remember_me" class="form_label__checkbox">
                <input id="remember_me" type="checkbox" class="" name="remember">
                <span class="">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="">
            @if (Route::has('password.request'))
                <!-- <a class="form_link" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a> -->
            @endif

            <x-primary-button class="form_button">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
<x-footer/>

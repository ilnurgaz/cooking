<section>
    <form method="post" action="{{ route('password.update') }}" class="form_r_a">
        @csrf
        @method('put')

        <div>
            <h2 class="form_title">
                {{ __('Обновление пароля') }}
            </h2>
        </div>
        <div>
            <x-input-label for="update_password_current_password" :value="__('Текущий пароль')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Новый пароль')" />
            <x-text-input id="update_password_password" name="password" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Повторите пароль')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="" />
        </div>

        <div class="">
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="form_text-react"
                >{{ __('Сохранено.') }}</p>
            @endif
            <button type="submit" class="form_button">Сохранить</button>
        </div>
    </form>
</section>

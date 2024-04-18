<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form_r_a">
        @csrf
        @method('patch')
        <div>
            <h2 class="form_title">
                {{ __('Информация пользователя') }}
            </h2>
        </div>
        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="" :messages="$errors->get('email')" />
        </div>

        <div class="">
        @if (session('status') === 'profile-updated')
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

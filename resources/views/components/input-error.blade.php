@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'input_error']) }}>
        @foreach ((array) $messages as $message)
            <?php
                if ($message == 'These credentials do not match our records.') {
                    $message = 'Эти учетные данные не соответствуют нашим записям.';
                }
                if ($message == 'The password field confirmation does not match.') {
                    $message = 'Подтверждение поля пароля не совпадает.';
                }
                if ($message == 'The password field must be at least 8 characters.') {
                    $message = 'Пароль должен быть не менее 8 символов';
                }
               
            ?>
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

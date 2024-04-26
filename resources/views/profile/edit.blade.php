@section('title-block')
Профиль
@endsection

<x-header/>
    <div class="profile_container">
        <div class="profile_wrapper">
            <div class="">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="">
                @include('profile.partials.update-password-form')
            </div>
            <div class="">
                <form action="{{route('logout')}}" method="post" class="form_logout">
                    @csrf
                    <input type="submit" value="Выйти" class="form_button">
                </form>
            </div>
        </div>
    </div>
<x-footer/>
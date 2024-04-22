<x-header-admin/>
    <div class="bloks_wrapper">
        <div class="block_container">
            <h2 class="admin_title">Панель администратора</h2>
            <div class="admin_main_wrapper">
                <a href="{{ route('admin-recipes') }}">
                    <div class="admin_main_el">
                        <h3>Рецепты: {{$count_recipes}}</h3>
                    </div>
                </a>
                <a href="{{ route('admin-categories') }}">
                    <div class="admin_main_el">
                        <h3>Категории: {{$count_cat}}</h3>
                    </div>
                </a>
                <a href="{{ route('admin-users') }}">
                    <div class="admin_main_el">
                        <h3>Пользователи: {{$count_users}}</h3>
                    </div>
                </a>
                <a href="{{ route('admin-articles') }}">
                    <div class="admin_main_el">
                        <h3>Статьи: {{$count_articles}}</h3>
                    </div>
                </a>
                <a href="{{ route('contact-data') }}">
                    <div class="admin_main_el">
                        <h3>Сообщения: {{$count_contact}}</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

<x-footer-admin/>
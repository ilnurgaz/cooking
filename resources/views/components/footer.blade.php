</div>
            </main>
            <footer>
                <div class="footer_wrapper container">
                    <div class="footer-main">
                        <div class="footer_column-1">
                            <a href="{{ route('main') }}">
                                <img src="/assets/image/main/logo.svg" alt="Logo" title="Logo" class="footer_logo">
                            </a>
                            <h6 class="footer_desc">Рецепты на все случаи жизни</h6>
                            <div class="footer_soc-link__wrapper">
                                <a href="{{ url('https://vk.com') }}" target="_blank">
                                    <img src="/assets/image/icon/vk.svg" alt="" title="" class="footer_soc-link__image">
                                </a>
                                <a href="{{ url('https://web.telegram.org') }}" target="_blank">
                                    <img src="/assets/image/icon/telegram.svg" alt="" title="" class="footer_soc-link__image">
                                </a>
                                <a href="{{ url('https://ok.ru') }}" target="_blank">
                                    <img src="/assets/image/icon/ok.svg" alt="" title="" class="footer_soc-link__image">
                                </a>
                                <a href="{{ url('https://ru.pinterest.com') }}" target="_blank">
                                    <img src="/assets/image/icon/pinterest.svg" alt="" title="" class="footer_soc-link__image">
                                </a>
                            </div>
                        </div>
                        <div class="footer_column-2">
                            <div class="footer_menu__wrapper">
                                <a href="{{ route('main') }}" class="link footer_link">Главная</a>
                                <a href="{{ route('recipes') }}" class="link footer_link">Рецепты</a>
                                <a href="{{ route('articles-data') }}" class="link footer_link">Статьи</a>
                                <a href="{{ route('contact') }}" class="link footer_link">Контакты</a>
                            </div>
                        </div>
                        <div class="footer_column-3">
                            <div class="footer_menu__wrapper">
                                <a href="{{ route('main') }}" class="link footer_link">Первые блюда</a>
                                <a href="{{ route('main') }}" class="link footer_link">Вторые блюда</a>
                                <a href="{{ route('main') }}" class="link footer_link">Салаты</a>
                                <a href="{{ route('main') }}" class="link footer_link">Десерты</a>
                            </div>
                        </div>
                        <div class="footer_column-4">
                            <div class="footer_menu__wrapper">
                                <a href="{{ route('main') }}" class="link footer_link">Закуски</a>
                                <a href="{{ route('main') }}" class="link footer_link">Напитки</a>
                                <a href="{{ route('main') }}" class="link footer_link">Изделия из теста</a>
                                <a href="{{ route('main') }}" class="link footer_link">Другие</a>
                            </div>
                        </div>
                    </div>
                    <div class="copyrights_wrapper">
                        <p class="copyrights">© 2024 Culinary.ru</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
<x-header-admin/>
    <div class="bloks_wrapper">
        @if(Session::has('success'))
            <div class="message-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="message-error">
                {{ Session::get('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="message-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="block_container">
            <h2 class="admin_title">Добавить рецепт</h2>
            <form action="{{ route('add-category') }}" class="admin_form" method='POST' enctype='multipart/form-data'>
                @csrf
                <div>
                    <label for="name">Название</label>
                    <input type="text" name="name" id="name" placeholder="Название">
                </div>
                <div>
                    <label for="image">Картинка</label>
                    <input type="file" name="image" id="image">
                </div>
                <div>
                    <span class="input_rule">
                        Видео рецепты можно размещать только с YouTube<br>
                        Инструкция: Нажать Поделиться -> Встроить -> Копировать. 
                    </span>
                    <label for="video">Видео</label>
                    <input type="text" name="video" id="video" placeholder="Ссылка на видео">
                </div>
                <div>
                    <label for="category">Категория</label>
                    <select name="category" id="category">
                        <?php
                            foreach($categories as $cat) {
                                $catName = $cat->name;
                                $catId = $cat->id;
                                echo "
                                    <option value='$catId'>$catName</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="time_cook">Время приготовления</label>
                    <input type="number" name="time_cook" id="time_cook" min=1 value="1">
                </div>
                <div>
                    <label for="number_servings">Количество порций</label>
                    <input type="number" name="number_servings" id="number_servings" min=1 value="1">
                </div>
                <div>
                    <span class="input_rule">
                    Каждый ингредиент необходимо размещать на новой строке, без ведущих знаков<br>
                    сметана - 2 ст.л.<br>
                    лук - 2 шт.<br>
                    масло - 100 г<br>
                    </span>
                    <label for="ingredients">Ингедиенты</label>
                    <textarea name="ingredients" id="ingredients" class="form_textarea" placeholder="Ингедиенты"></textarea>
                </div>
                <div>
                    <label for="recipes">Способ приготовления</label>
                    <textarea name="recipes" id="recipes" class="form_textarea" placeholder="Способ приготовления"></textarea>
                </div>
                <div>
                    <label for="description">Дополнительная информация</label>
                    <textarea name="description" id="description" class="form_textarea" placeholder="Дополнительная информация"></textarea>
                </div>
                <div class="checkbox_wrapper">
                    <label for="recipes">Опупликовать</label>
                    <input type="checkbox" value="published">
                </div>
                <input type="submit" value="Добавить">
            </form>
        </div>
            <?php
                if($count > 0) {
            ?>
                <div class="block_container">
                    <h2 class="admin_title">Рецепты</h2>
                    <table class="admin_table table_categories">
                        <thead>
                            <th>Картинка</th>
                            <th>Название</th>
                            <th>Ярлык</th>
                            <th colspan='2'>Действия</th>
                        </thead>
                        <tbody>
                            @foreach($data as $el)
                                <?php
                                    if($el->image) {
                                        $image = $el->image;
                                        $path = "./assets/image/categorises/$image";
                                        if (file_exists($path)) {
                                            $image = "/assets/image/categorises/$image";
                                        }
                                        else {
                                            $image = "/assets/image/categorises/image-placeholder.png";
                                        }
                                    }
                                    else {
                                        $image = "/assets/image/categorises/image-placeholder.png";
                                    }
                                ?>
                                <tr>
                                    <td><img src="{{$image}}" alt="" class="table_categorie__image"></td>
                                    <td>{{$el->name}}</td>
                                    <td>{{$el->slug}}</td>
                                    <td><a href="{{route('cat-update',$el->id)}}" class="table_link link_update">Изменить</a></td>
                                    <td><a href="{{route('cat-delete',$el->id)}}" class="table_link link_delete">Удалить</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <?php
                        $page_count = ceil($count / 10);
                        if($page_count > 1) {
                            echo "<div class='block_container'><div class='pagination_wrapper'>";
                            echo "<a href='/admin-cat/0' class='pagination_link'><<</a>";
                            $currentPage = $page + 1;
                            $start = max($currentPage - 3, 1);
                            $end = min($currentPage + 3, $page_count);
                            for ($i = $start; $i <= $end; $i++) {
                                $p = $i - 1;
                                $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                                echo "<a href='/admin-cat/$p' class='$pag_class'>$i</a>";
                            }
                            echo "<a href='/admin-cat/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            echo "</div></div>";
                        }
                    ?>
            <?php
                } else {
            ?>
                <div class="block_container">
                    <h2 class="admin_title">Рецептов нет</h2>
                </div>
            <?php
                };
            ?>
    </div>
<x-footer-admin/>

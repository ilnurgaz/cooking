<?php
    use App\Models\categories;
?>
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
            <form action="{{ route('admin-add-recipes') }}" class="admin_form" method='post' enctype='multipart/form-data'>
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
                <input type="submit" value="Добавить">
            </form>
        </div>
                <div class="block_container">
                    <?php
                        if($count > 0) {
                            
                    ?>
                    <h2 class="admin_title">Рецепты</h2>
                    <?php
                        } else {
                    ?>
                    <h2 class="admin_title">Рецептов нет</h2>
                    <?php
                        }
                    ?>
                    <div class="admin_ricipes_filter">
                        <form action="{{ route('recipes-cat-fil', 'cat') }}" class="admin_form form_row" method='post' enctype='multipart/form-data'>
                            @csrf
                            <div class="">
                                <label for="category">Категория</label>
                                <select name="category" id="category">
                                    <?php
                                        foreach($categories as $cat) {
                                            $catName = $cat->name;
                                            $catId = $cat->id;
                                            if ($cat_pag) {
                                                if ($categoryName == $catName) {
                                                    $selected = 'selected';
                                                }
                                                else {
                                                    $selected = '';
                                                }
                                            }
                                            else {
                                                $selected = '';
                                            }
                                                
                                            echo "
                                                <option $selected value='$catId'>$catName</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" value="Применить">
                        </form>
                    </div>
                    <?php
                        if($count > 0) {
                            
                    ?>
                    <table class="admin_table table_categories">
                        <thead>
                            <th>Картинка</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th colspan='2'>Действия</th>
                        </thead>
                        <tbody>
                            @foreach($data as $el)
                                <?php
                                $category = categories::where('id', $el->category)->first();
                                    if($el->image) {
                                        $image = $el->image;
                                        $path = "./assets/image/recipes/$image";
                                        if (file_exists($path)) {
                                            $image = "/assets/image/recipes/$image";
                                        }
                                        else {
                                            $image = "/assets/image/recipes/image-placeholder.png";
                                        }
                                    }
                                    else {
                                        $image = "/assets/image/recipes/image-placeholder.png";
                                    }
                                ?>
                                <tr>
                                    <td><img src="{{$image}}" alt="" class="table_categorie__image"></td>
                                    <td>{{$el->name}}</td>
                                    <td>{{$category->name}}</td>
                                    <td><a href="{{route('recipes-update',$el->id)}}" class="table_link link_update">Изменить</a></td>
                                    <td><a href="{{route('recipes-delete',$el->id)}}" class="table_link link_delete">Удалить</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <?php
                        $page_count = ceil($count / 10);
                        if($page_count > 1) {
                            echo "<div class='block_container'><div class='pagination_wrapper'>";
                            if ($cat_pag) {
                                echo "<a href='/admin-recipes/cat/$categoryName/0' class='pagination_link'><<</a>";
                            }
                            else {
                                echo "<a href='/admin-recipes/0' class='pagination_link'><<</a>";
                            }
                            $currentPage = $page + 1;
                            $start = max($currentPage - 3, 1);
                            $end = min($currentPage + 3, $page_count);
                            for ($i = $start; $i <= $end; $i++) {
                                $p = $i - 1;
                                $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                                if ($cat_pag) {
                                    echo "<a href='/admin-recipes/cat/$categoryName/$p' class='$pag_class'>$i</a>";
                                }
                                else {
                                    echo "<a href='/admin-recipes/$p' class='$pag_class'>$i</a>";
                                }
                            }
                            if ($cat_pag) {
                                echo "<a href='/admin-recipes/cat/$categoryName/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            }
                            else {
                                echo "<a href='/admin-recipes/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            }
                            echo "</div></div>";
                        }
                    ?>
            <?php
                } 
            ?>
    </div>
<x-footer-admin/>

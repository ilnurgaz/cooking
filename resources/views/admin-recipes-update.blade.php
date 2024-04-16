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
            <form action="{{ route('recipes-update-controller', $data->id) }}" class="admin_form" method='post' enctype='multipart/form-data'>
                @csrf
                <div>
                    <label for="name">Название</label>
                    <input type="text" name="name" id="name" placeholder="Название" value="{{$data->name}}">
                </div>
                <?php
                    if($data->image) {
                        $image = $data->image;
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
                <div>
                    <label for="image">Картинка</label>
                    <img src="{{$image}}" alt="" class="admin_cat__image">
                </div>
                <div>
                    <label for="image">Выбрать новую картинку</label>
                    <input type="file" name="image" id="image">
                </div>
                <div>
                    <span class="input_rule">
                        Видео рецепты можно размещать только с YouTube<br>
                        Инструкция: Нажать Поделиться -> Встроить -> Копировать. 
                    </span>
                    <label for="video">Видео</label>
                    <input type="text" name="video" id="video" placeholder="Ссылка на видео"  value="{{$data->video}}">
                </div>
                <div>
                    <label for="category">Категория</label>
                    <select name="category" id="category">
                        <?php
                            foreach($categories as $cat) {
                                $catName = $cat->name;
                                $catId = $cat->id;
                                if($data->category ==  $cat->id) {
                                    echo "
                                        <option selected value='$catId'>$catName</option>
                                    ";
                                }
                                else {
                                    echo "
                                        <option value='$catId'>$catName</option>
                                    ";
                                }
                                
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="time_cook">Время приготовления</label>
                    <input type="number" name="time_cook" id="time_cook" min=1 value="{{$data->time_cook}}">
                </div>
                <div>
                    <label for="number_servings">Количество порций</label>
                    <input type="number" name="number_servings" id="number_servings" min=1 value="{{$data->number_servings}}">
                </div>
                <div>
                    </span>
                    <label for="ingredients">Ингедиенты</label>
                    <textarea name="ingredients" id="ingredients" class="form_textarea" placeholder="Ингедиенты">{{$data->ingredients}}</textarea>
                </div>
                <div>
                    <label for="recipes">Способ приготовления</label>
                    <textarea name="recipes" id="recipes" class="form_textarea" placeholder="Способ приготовления">{{$data->recipes}}</textarea>
                </div>
                <div>
                    <label for="description">Дополнительная информация</label>
                    <textarea name="description" id="description" class="form_textarea" placeholder="Дополнительная информация">{{$data->description }}</textarea>
                </div>
                <input type="submit" value="Добавить">
            </form>
        </div>
    </div>
<x-footer-admin/>

<x-header/>
    <div class="bloks_wrapper">
            <div class="block_container">
                <div class="recipe_page">
                    <h2 class="title">{{$data->name}}</h2>
                    <div class="recipe_page_section">
                        <div class="column-1">
                            <img src="/assets/image/recipes/{{$data->image}}" class="recipe_page__image" alt="">
                        </div>
                        <div class="column-2">
                            <div class="info_el">
                                Категория: <a href="/recipes/category/{{$cat_slug}}">{{$category}}</a>
                            </div>
                            <div class="info_el">
                                Время готовки: {{$data->time_cook}} мин
                            </div>
                            <div class="info_el">
                                Количество порций: {{$data->number_servings}}  
                                
                            </div>
                            <div class="info_el">
                                Дата публикации: {{$data->created_at}} 
                            </div>
                        </div>
                    </div>
                    <div class="ingredients">
                        <div class="title-2">Ингредиенты</div>
                        <div class="ingredients_main">
                            {{$data->ingredients}}
                        </div>
                    </div>
                    <?php
                        if($data->video) {
                    ?>
                    <div class="recipe">
                        <div class="title-2">Видео рецепт</div>
                        <div class="recipe_main">
                            {!! $data->video !!}
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="recipe">
                        <div class="title-2">Рецепт приготовления</div>
                        <div class="recipe_main">
                            {{$data->recipes}}
                        </div>
                    </div>
                    <?php
                        if($data->description) {
                    ?>
                    <div class="recipe">
                        <div class="title-2">Дополнительная информация</div>
                        <div class="recipe_main">
                            {!! $data->description !!}
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
    </div>
<x-footer/>
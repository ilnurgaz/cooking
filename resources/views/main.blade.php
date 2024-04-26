@section('title-block')
Пошаговые кулинарные рецепты для вдохновения и творчества.
@endsection

@section('description-block')
Ищете вдохновение в кулинарии? Наш сайт предлагает богатый выбор изысканных рецептов со всего мира. Насладитесь кулинарным искусством, создавайте вкусные блюда и делитесь своими творениями с сообществом любителей гастрономии.
@endsection

<?php
    use App\Models\categories;

use function PHPSTORM_META\elementType;

?>

<x-header/>
<div class="bloks_wrapper">
        <div class="block_container">
            <h2 class="title-2">Новые рецепты</h2>
            <div class="recipes_wrapper">
            @foreach($new_recipes as $el)
                    <div class="recipes_el">
                        <div class="recipes_title">
                            <a href="{{route('recipe-page',$el->id)}}" class="recipes_link">
                                {{$el->name}}
                            </a>
                        </div>
                        <?php
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
                            $category = categories::where('id', $el->category)->first();
                        ?>
                        <a href="{{route('recipe-page',$el->id)}}" class="recipes_link">
                            <img src="{{$image}}" alt="" class="recipes_image" title="{{ substr($el -> image, 0, strrpos($el -> image, ".")) }}">
                        </a>
                        <div class="line"></div>
                        <div class="category">
                            <a href="" class="recipes_category_link">
                                Категория: {{$category->name}}
                            </a>
                        </div>
                        <div class="line"></div>
                        <div class="date">
                            {{$el->created_at}}
                        </div>
                        <div class="line"></div>
                        <div class="ingredients">
                            {{$el->ingredients}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="block_container">
            <h2 class="title-2">Популярные категории</h2>
            <div class="main_category_wrapper">
                @foreach($pop_categories as $el)
                            <div class="category_el">
                                <a href="/recipes/category/{{$el->slug}}">
                                    <img src="/assets/image/categorises/{{$el->image}}" class="category_el__image" alt="">
                                    <div class="category_el__text">{{$el->name}}</div>
                                </a>
                            </div>
                @endforeach
            </div>
        </div>
        <div class="block_container">
            <h2 class="title-2">Статьи</h2>
            <div class="articles_wrapper">
                @foreach($articles as $el)
                    <?php
                        if($el->image) {
                            $image = $el->image;
                            $path = "./assets/image/articles/$image";
                            if (file_exists($path)) {
                                $image = "/assets/image/articles/$image";
                            }
                            else {
                                $image = "/assets/image/articles/image-placeholder.png";
                            }
                        }
                        else {
                            $image = "/assets/image/articles/image-placeholder.png";
                        }
                    ?>
                    <div class="articles_el">
                        <a href="{{route('articles-data-one',$el->id)}}">
                            <img src="{{$image}}" class="articles_image" alt="">
                        </a>
                        <a href="{{route('articles-data-one',$el->id)}}">
                            <div class="articles_title">{{$el->theme}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="block_container">
            <h2 class="title-2">Кулинарные рецепты на сайте Culinary.ru</h2>
            <p class="main_text">Всех нас объединяет любовь к кулинарии. Мы не боимся экспериментировать со вкусами, потому что это — ключ к созданию гастрономического шедевра. На нашем сайте собраны рецепты блюд из разных стран и даже самых отдаленных уголков мира. Благодаря пошаговым инструкциям, фото и видео, каждая хозяйка сможет повторить их на своей кухне.
            <br><br>
            Culinary.ru — это не только энциклопедия простых и сложных, домашних и изысканных рецептов, но и социальная сеть, на площадке которой кулинары общаются, делятся опытом и дают полезные советы. </p>
        </div>
</div>
<x-footer/>

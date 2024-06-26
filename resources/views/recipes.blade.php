@section('title-block')
Все рецепты с фото
@endsection

@section('description-block')
От классических блюд до современных изысков, от сытных основных блюд до аппетитных десертов — мы собрали все, что нужно, чтобы побаловать свои вкусовые рецепторы.
@endsection

<?php
    use App\Models\categories;

use function PHPSTORM_META\elementType;

?>
<x-header/>
    <div class="bloks_wrapper">
        <div class="block_container">
            <h2 class="title-2">Все рецепты</h2>
            <div class="category_wrapper">
                <?php
                    if ($cat_active) {
                        echo "
                            <a href='/recipes'>
                                <div class='category_el'>
                                Все
                                </div>
                            </a>
                        ";
                    }
                ?>
                @foreach($categories as $el)
                    <a href="/recipes/category/{{$el->slug}}">
                        <div class="category_el
                        <?php
                            if ($cat_active == $el->slug) {
                                echo " active";
                            }
                        ?>
                        ">
                            {{$el->name}}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="block_container">
            <div class="recipes_wrapper">
                <?php 
                    if($count > 0) {
                    ?>
                        @foreach($recipes as $el)
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
                    <?php
                    }
                    else {
                        echo "
                        <h2 class='title-2'>Рецептов нет</h2>
                        ";
                    }
                ?>
            </div>
        </div>
        <?php
            $page_count = ceil($count / 20);
            if($page_count > 1) {
                echo "<div class='block_container'><div class='pagination_wrapper'>";
                if($cat_active) {
                    echo "<a href='/recipes/category/$cat_active/0' class='pagination_link'><<</a>";
                }
                else {
                    echo "<a href='/recipes/0' class='pagination_link'><<</a>";
                }
                $currentPage = $page + 1;
                $start = max($currentPage - 3, 1);
                $end = min($currentPage + 3, $page_count);
                for ($i = $start; $i <= $end; $i++) {
                    $p = $i - 1;
                    $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                    if($cat_active) {
                        echo "<a href='/recipes/category/$cat_active/$p' class='$pag_class'>$i</a>";
                    }
                    else {
                        echo "<a href='/recipes/$p' class='$pag_class'>$i</a>";
                    }
                }
                if($cat_active) {
                    echo "<a href='/recipes/category/$cat_active/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                }
                else {
                    echo "<a href='/recipes/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                }
                echo "</div></div>";
            }
        ?>
        <?php
            if($cat_active) {
        ?>
            <div class="block_container">
            <h2 class="title-2">{{$cat_name}}</h2>
            <div class="category_description">
                {{$cat_description}}
            </div>
            </div>
        <?php 
            }
        ?>
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
    </div>
<x-footer/>
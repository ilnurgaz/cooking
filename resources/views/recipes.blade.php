<?php
    use App\Models\categories;
?>
<x-header/>
    <div class="bloks_wrapper">
        <div class="block_container">
            <h2 class="title-2">Все рецепты</h2>
            <div class="category_wrapper">
                @foreach($categories as $el)
                    <a href="/recipes/category/{{$el->name}}">
                        <div class="category_el
                        <?php
                            if ($cat_active == $el->name) {
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
                            <a href="" class="recipes_link">
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
                        <a href="" class="recipes_link">
                            <img src="{{$image}}" alt="" class="recipes_image">
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
                if($cat_pag) {
                    echo "<a href='/recipes/category/$cat_active/0' class='pagination_link'><<</a>";
                }
                else {
                    echo "<a href='/recipes/category/$cat_active/0' class='pagination_link'><<</a>";
                }
                $currentPage = $page + 1;
                $start = max($currentPage - 3, 1);
                $end = min($currentPage + 3, $page_count);
                for ($i = $start; $i <= $end; $i++) {
                    $p = $i - 1;
                    $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                        if($cat_pag) {
                            echo "<a href='/recipes/category/$cat_active/$p' class='$pag_class'>$i</a>";
                        }
                        else {
                            echo "<a href='/recipes/category/$cat_active/$p' class='$pag_class'>$i</a>";
                        }
                }
                if($cat_pag) {
                    echo "<a href='/recipes/category/$cat_active/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                }
                else {
                    echo "<a href='/recipes/category/$cat_active/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                }
                echo "</div></div>";
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
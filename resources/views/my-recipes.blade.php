@section('title-block')
Мои рецепты
@endsection

@section('description-block')
Можете добавить свой рецепт
@endsection

<?php
    use App\Models\categories;
?>
<x-header/>
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
            <h2 class="title-2">Мои рецепты</h2>
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
                        <a href="{{route('recipe-delete',$el->id)}}" class="delete">Удалить</a>    
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
                echo "<a href='/my-recipes/0' class='pagination_link'><<</a>";
                $currentPage = $page + 1;
                $start = max($currentPage - 3, 1);
                $end = min($currentPage + 3, $page_count);
                for ($i = $start; $i <= $end; $i++) {
                    $p = $i - 1;
                    $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                    echo "<a href='/my-recipes/$p' class='$pag_class'>$i</a>";
                }
                echo "<a href='/my-recipes/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                echo "</div></div>";
            }
        ?>
    </div>
<x-footer/>
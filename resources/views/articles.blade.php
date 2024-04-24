@section('title-block')
Статьи
@endsection

@section('description-block')
Добро пожаловать в наш раздел статей, где мы делимся ценными знаниями и советами, которые помогут вам стать настоящим мастером кулинарного искусства.
@endsection

<x-header/>
    <div class="bloks_wrapper">
        <div class="block_container">
        <h2 class="title">Статьи</h2>
        @foreach($data as $el)
        <div class="alert-articles">
            <h1 class="articles_title">{{ $el->theme}}</h1>
            <div class="alert-img">
                <img src="/assets/image/articles/{{ $el->image}}" alt="">
            </div>
            <p style="font-size: 20px;" class="articles_description">{{ $el->content}}</p>
            <a href="{{ route ('articles-data-one', $el->id)}}" class="link">Подробнее</a>
        </div>
        @endforeach
        </div>
        <?php
                        $page_count = ceil($count / 10);
                        if($page_count > 1) {
                            echo "<div class='block_container'><div class='pagination_wrapper'>";
                            echo "<a href='/admin-articles/all/0' class='pagination_link'><<</a>";
                            $currentPage = $page + 1;
                            $start = max($currentPage - 3, 1);
                            $end = min($currentPage + 3, $page_count);
                            for ($i = $start; $i <= $end; $i++) {
                                $p = $i - 1;
                                $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                                echo "<a href='/admin-articles/all/$p' class='$pag_class'>$i</a>";
                            }
                            echo "<a href='/admin-articles/all/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            echo "</div></div>";
                        }
                    ?>
    </div>
<x-footer/>
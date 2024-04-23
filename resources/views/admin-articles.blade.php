<x-header-admin/>
    <div class="bloks_wrapper">
    @if($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <div class="block_container">
            <h2 class="admin_title">Добавить статью</h2>
            <form class="admin_form" action="{{ route ('articles-form')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div>
                    <label class="labl" for="name">Название статьи</label>
                    <input  type="text" name="theme" placeholder="Введите название" id="theme">
                </div>
                <div>
                    <label class="labl" for="email">Картинка</label>
                    <input type="file" name="image" id="image">
                </div>
                <div>
                    <label class="labl" for="message">Содеражние</label>
                    <textarea type="text" name="content" id="content" class="form_textarea" placeholder="Введите текст"></textarea>
                </div>
                <input type="submit" value="Опубликовать">
            </form>
        </div>
        <?php
                if($count > 0) {
            ?>
                <div class="block_container">
                    <h2 class="admin_title">Статьи</h2>
                    <table class="admin_table table_categories">
                        <thead>
                            <th>Картинка</th>
                            <th>Тема</th>
                            <th colspan='3'>Действия</th>
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
                                    <td>{{$el->theme}}</td>
                                    <td><a href="{{route('articles-data-one',$el->id)}}" class="table_link link_update">Перейти</a></td>
                                    <td><a href="{{route('articles-update',$el->id)}}" class="table_link link_update">Изменить</a></td>
                                    <td><a href="{{route('articles-delete',$el->id)}}" class="table_link link_delete">Удалить</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <?php
                        $page_count = ceil($count / 10);
                        if($page_count > 1) {
                            echo "<div class='block_container'><div class='pagination_wrapper'>";
                            echo "<a href='/admin-articles/0' class='pagination_link'><<</a>";
                            $currentPage = $page + 1;
                            $start = max($currentPage - 3, 1);
                            $end = min($currentPage + 3, $page_count);
                            for ($i = $start; $i <= $end; $i++) {
                                $p = $i - 1;
                                $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                                echo "<a href='/admin-articles/$p' class='$pag_class'>$i</a>";
                            }
                            echo "<a href='/admin-articles/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            echo "</div></div>";
                        }
                    ?>
            <?php
                } else {
            ?>
                <div class="block_container">
                    <h2 class="admin_title">Статей нет</h2>
                </div>
            <?php
                };
            ?>
    </div>

<x-footer-admin/>
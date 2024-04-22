<?php
use App\Models\categories;
use PhpParser\Node\Stmt\Else_;

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
                                            echo "
                                                <option value='$catId'>$catName</option>
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
                } 
            ?>
    </div>
<x-footer-admin/>

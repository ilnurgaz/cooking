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
            <h2 class="admin_title">Добавить категорию</h2>
            <form action="{{ route('add-category') }}" class="admin_form" method='POST' enctype='multipart/form-data'>
                @csrf
                <div>
                    <label for="name">Название</label>
                    <input type="text" name="name" id="name" placeholder="Название">
                </div>
                <div>
                    <label for="slug">Ярлык</label>
                    <input type="text" name="slug" id="slug" placeholder="Ярлык">
                </div>
                <div>
                    <label for="image">Картинка</label>
                    <input type="file" name="image" id="image">
                </div>
                <div>
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" class="form_textarea" placeholder="Описание"></textarea>
                </div>
                <input type="submit" value="Добавить">
            </form>
        </div>
        <div class="block_container">
            <h2 class="admin_title">Категории</h2>
            <table class="admin_table table_categories">
                <thead>
                    <th>Картинка</th>
                    <th>Название</th>
                    <th>Ярлык</th>
                    <th colspan='2'>Действия</th>
                </thead>
                <tbody>
                    @foreach($data as $el)
                        <?php
                            if($el->image) {
                                $image = $el->image;
                            }
                            else {
                                $image = "image-placeholder.png";
                            }
                        ?>
                        <tr>
                            <td><img src="./assets/image/categorises/{{$image}}" alt="" class="table_categorie__image"></td>
                            <td>{{$el->name}}</td>
                            <td>{{$el->slug}}</td>
                            <td><a href="{{route('cat-update',$el->id)}}" class="table_link link_update">Изменить</a></td>
                            <td><a href="{{route('cat-delete',$el->id)}}" class="table_link link_delete">Удалить</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<x-footer/>



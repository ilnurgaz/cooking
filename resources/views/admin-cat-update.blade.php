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
            <h2 class="admin_title">Изменить категорию</h2>
            <form action="{{ route('cat-update-controller', $data->id) }}" class="admin_form" method='post' enctype='multipart/form-data'>
                @csrf
                <div>
                    <label for="name">Название</label>
                    <input type="text" name="name" id="name" placeholder="Название" value="{{$data->name}}">
                </div>
                <div>
                    <label for="slug">Ярлык</label>
                    <input type="text" name="slug" id="slug" placeholder="Ярлык" value="{{$data->slug}}">
                </div>
                <?php
                    if($data->image) {
                        $image = $data->image;
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
                <div>
                    <label for="image">Картинка</label>
                    <img src="{{$image}}" alt="" class="admin_cat__image">
                </div>
                <div>
                    <label for="image">Выбрать новую картинку</label>
                    <input type="file" name="image" id="image" value="{{$data->image}}">
                </div>
                <div>
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" class="form_textarea" placeholder="Описание">{{$data->description}}</textarea>
                </div>
                <input type="submit" value="Изменить">
            </form>
        </div>
    </div>
<x-footer-admin/>
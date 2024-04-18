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
            <h2 class="admin_title">Обновить статью</h2>
            <form class="admin_form" action="{{ route ('articles-update-submit', $data->id)}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div>
                            <label class="labl" for="name">Название новости</label>
                            <input type="text" value="{{$data->theme}}" name="theme" placeholder="Введите название" id="theme">
                        </div>
                        <div>
                            <label class="labl" for="email">Картинка</label>
                            <input type="file" name="image"  id="image">
                        </div>
                        <div>
                            <label class="labl" for="message">Содеражние</label>
                            <textarea name="content"  id="content" class="form_textarea" placeholder="Введите текст">{{$data->content}}</textarea>
                        </div>
                        <input type="submit" value="Обновить">
                    </form>
        </div>
    </div>

<x-footer-admin/>
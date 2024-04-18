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
                    <label for="name">Название статьи</label>
                    <input type="text" name="theme" placeholder="Введите название" id="theme">
                </div>
                <div>
                    <label for="email">Картинка</label>
                    <input type="file" name="image" id="image">
                </div>
                <div>
                    <label for="message">Содеражние</label>
                    <textarea name="content" id="content" class="form_textarea" placeholder="Введите текст"></textarea>
                </div>
                <input type="submit" value="Опубликовать">
            </form>
        </div>
    </div>

<x-footer-admin/>
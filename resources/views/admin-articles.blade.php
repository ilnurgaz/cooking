<x-header-admin/>

@if($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

<form class="obr-form" action="{{ route ('articles-form')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Название новости</label>
                            <input class="input-obr" type="text" name="theme" placeholder="Введите название" id="theme">
                        </div>
    
                        <div class="form-group">
                            <label for="email">Картинка</label>
                            <input type="file" name="image" id="image">
                        </div>
    
                        <div class="form-group">
                            <label for="message">Содеражние</label>
                            <textarea name="content" id="content" class="form-control" placeholder="Введите текст"></textarea>
                        </div>
    
                         <button type="submit" class="btn-success">Опубликовать</button>
    
                    </form>
<x-footer-admin/>
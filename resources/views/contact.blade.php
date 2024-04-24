@section('title-block')
Контакты
@endsection

@section('description-block')
Мы всегда рады общаться с вами и отвечать на любые ваши вопросы или запросы. Свяжитесь с нами любым удобным для вас способом
@endsection

<x-header/>
    <div class="container-1">
        <div class="row">
            <div class="col-md-12">
                <div class="contact">

                    <h1 id="text" class="heading">Контакты</h1>
                    <p  style="font-size: 35px; margin-bottom: 25px;">Свяжитесь с нами любым удобным для вас способом:</p>
                    <ul class="ull" style="font-size: 25px; margin-bottom: 15px; line-height: 2;">
                        <li class="lii" ><strong>Email:</strong> <a href="mailto:info@culinaryrecipes.com">info@culinaryrecipes.com</a></li>
                        <li><strong>Телефон:</strong> +7 (495) 123-45-67</li>
                        <li><strong>Адрес:</strong> г. Москва, ул. Ленина, д. 1</li>
                    </ul>
                </div>

                <div class="form">
                <p class="pp" style="font-size: 25px; text-align: center;margin-bottom: 25px;">Также вы можете заполнить форму обратной связи ниже:</p>

                @if($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                @if(session('success'))
                <div class="alert-success">
                    {{ session('success')}}
                </div>
                @endif
                
                    <form class="form_r_a" action="{{ route ('contact-form')}}" method="post">
                        @csrf
                        <div>
                            <label class="labl" for="name">Введите имя</label>
                            <input class="input-obr" type="text" name="name" placeholder="Введите имя" id="name" class="form-control">
                        </div>
    
                        <div>
                            <label class="labl" for="email">Email</label>
                            <input class="input-obr" type="text" name="email" placeholder="Введите email" id="email" class="form-control">
                        </div>
    
                        <div>
                            <label class="labl" for="subject">Тема сообщения</label>
                            <input class="input-obr" type="text" name="subject" placeholder="Тема сообщения" id="subject" class="form-control">
                        </div>
    
                        <div>
                            <label class="labl" for="message">Сообщение</label>
                            <textarea name="message" id="message" class="form-textarea" placeholder="Введите сообщение"></textarea>
                        </div>
                        <div class="">
                            <button type="submit" class="form_button">Отправить</button>
                        </div>
    
                    </form>
                </div>


                
            </div>
        </div>
    </div>

<x-footer/>


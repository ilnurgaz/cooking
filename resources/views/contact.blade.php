<x-header/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contact">

                    <h1 id="text">Контакты</h1>
                    <p>Свяжитесь с нами любым удобным для вас способом:</p>
                    <ul style="font-size: 25px; margin-bottom: 15px; line-height: 2;">
                        <li><strong>Email:</strong> <a href="mailto:info@culinaryrecipes.com">info@culinaryrecipes.com</a></li>
                        <li><strong>Телефон:</strong> +7 (495) 123-45-67</li>
                        <li><strong>Адрес:</strong> г. Москва, ул. Ленина, д. 1</li>
                    </ul>
                </div>



                <div class="form">
                <p style="font-size: 25px; text-align: center;">Также вы можете заполнить форму обратной связи ниже:</p>
                    <form class="obr-form" action="/contact/submit" method="post">
                        <div class="form-group">
                            <label for="name">Введите имя</label>
                            <input type="text" name="name" placeholder="Введите имя" id="name" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Введите email" id="email" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <label for="subject">Тема сообщения</label>
                            <input type="text" name="subject" placeholder="Тема сообщения" id="subject" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <label for="message">Сообщение</label>
                            <textarea name="message" id="message" class="form-control" placeholder="Введите сообщение"></textarea>
                        </div>
                         <button type="submit" class="btn btn-success">Отправить</button>
    
                    </form>
                </div>


                
            </div>
        </div>
    </div>

<x-footer/>

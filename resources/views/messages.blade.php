<x-header-admin/>
    <div class="bloks_wrapper">
        <div class="block_container">
            <h2 class="admin_title">Все сообщения</h2>
            @foreach($data as $el)
            <div class="alert-info">
                <h3 class="heading3" >{{ $el->name}}</h3>
                <p>{{ $el->email}}</p>
                <p>{{ $el->subject}}</p>
                <p>{{ $el->message}}</p>
                <p> <small class="smals"> {{ $el->created_at}}</small> </p>
            </div>
            @endforeach
        </div>
    </div>
<x-footer-admin/>
<x-header/>
<div style="  margin: 0 auto;">
    <h1 style="text-align: center;">Все сообщения</h1>
</div>
@foreach($data as $el)
<div class="alert-info">
    <h3>{{ $el->name}}</h3>
    <p>{{ $el->email}}</p>
    <p>{{ $el->subject}}</p>
    <p>{{ $el->message}}</p>
    <p> <small> {{ $el->created_at}}</small> </p>
</div>
@endforeach
<x-footer-admin/>
<x-header-admin/>
<div style="  margin: 0 auto;">
    <h1 style="text-align: center;">Все сообщения</h1>
</div>
@foreach($data as $el)
<div class="alert-info">
    <h3 class="heading3" >{{ $el->name}}</h3>
    <p>{{ $el->email}}</p>
    <p>{{ $el->subject}}</p>
    <p>{{ $el->message}}</p>
    <p> <small class="smals"> {{ $el->created_at}}</small> </p>
</div>
@endforeach
<x-footer-admin/>
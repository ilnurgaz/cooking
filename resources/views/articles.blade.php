<x-header/>
@foreach($data as $el)
<div class="alert-info">
    <h1>{{ $el->theme}}</h1>
    <p>{{ $el->image}}</p>
    <p>{{ $el->content}}</p>
</div>
@endforeach
<x-footer/>
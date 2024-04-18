<x-header/>
@foreach($data as $el)
<div class="alert-info">
    <h1>{{ $el->theme}}</h1>
    <img src="/assets/image/articles/{{ $el->image}}" alt="">
    <p>{{ $el->content}}</p>
</div>
@endforeach
<x-footer/>
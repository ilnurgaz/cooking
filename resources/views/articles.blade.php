<x-header/>
@foreach($data as $el)
<div class="alert-articles">
    <h1>{{ $el->theme}}</h1>
    <div class="alert-img">
        <img src="/assets/image/articles/{{ $el->image}}" alt="">
    </div>
    <p>{{ $el->content}}</p>
    @if(Auth::check() && Auth::user()->hasRole('admin'))
    <a href="{{ route ('articles-data-one', $el->id)}}"> <button class="btn-wawning">Детальнее</button> </a>
    @endif
</div>
@endforeach
<x-footer/>
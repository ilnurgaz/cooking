<x-header/>
<div class="alert-articles">
    <h1>{{ $data->theme}}</h1>
    <div class="alert-img">
        <img src="/assets/image/articles/{{ $data->image}}" alt="">
    </div>
    <p>{{ $data->content}}</p>
    <p> <small> {{ $data->created_at}}</small> </p>

    <a href="{{ route ('articles-update', $data->id)}}"> <button class="btn-wawning">Редактрировать</button> </a>
    <a href="{{ route ('articles-delete', $data->id)}}"> <button class="btn-wawning">Удалить</button> </a>

   
</div>

<x-footer/>
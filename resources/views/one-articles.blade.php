<x-header/>
<div class="alert-articles">
    <h1 class="heading">{{ $data->theme}}</h1>
    <div class="alert-img">
        <img src="/assets/image/articles/{{ $data->image}}" alt="">
    </div>
    <p class="pp">{{ $data->content}}</p>

    <a href="{{ route ('articles-update', $data->id)}}"> <button class="btn-wawning">Редактрировать</button> </a>
    <a href="{{ route ('articles-delete', $data->id)}}"> <button class="btn-wawning">Удалить</button> </a>

   
</div>

<x-footer/>
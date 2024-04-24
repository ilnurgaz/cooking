@section('title-block')
{{ $data->theme }}
@endsection

@section('description-block')
{{ $data->content }}
@endsection


<x-header/>
    <div class="bloks_wrapper">
            <div class="block_container">
                <h2 class="admin_title" style="text-align: center;">{{ $data->theme}}</h2>
                    <img src="/assets/image/articles/{{ $data->image}}" alt="{{ $data -> image}}" title="{{ substr($data -> image, 0, strrpos($data -> image, ".")) }}" class="articles_image_">
                <p class="articles_p_">{{ $data->content}}</p>
            </div>
    </div>
<x-footer/>
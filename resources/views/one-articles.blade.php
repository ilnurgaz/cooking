<x-header/>
    <div class="bloks_wrapper">
            <div class="block_container">
                <h2 class="admin_title">{{ $data->theme}}</h2>
                <img src="/assets/image/articles/{{ $data->image}}" alt="" class="articles_image_">
                <p class="articles_p_">{{ $data->content}}</p>
            </div>
    </div>
<x-footer/>
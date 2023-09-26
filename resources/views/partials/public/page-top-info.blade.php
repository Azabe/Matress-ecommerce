<div class="page-top-info">
    <div class="container">
        <h4>{{$header}}</h4>
        <div class="site-pagination">
            @foreach ($links as $link)
            <a href={{ $link['route'] !== "" ? route($link['route']) : "" }}>{{$link['label']}}</a> /
            @endforeach
        </div>
    </div>
</div>
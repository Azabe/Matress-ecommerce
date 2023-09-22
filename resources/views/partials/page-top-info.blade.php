<div class="page-top-info">
    <div class="container">
        <h4>{{$header}}</h4>
        <div class="site-pagination">
            {{-- <a href="">Home</a> /
            <a href="">Login</a> --}}
            @foreach ($links as $link)
                <a href="{{route($link['route'])}}">{{$link['label']}}</a> /
            @endforeach
        </div>
    </div>
</div>
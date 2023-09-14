<center>
    <div id="abc">
        <div id="loading-slider">
            <div class="cssload-loader">
                <div class="cssload-inner cssload-one"></div>
                <div class="cssload-inner cssload-two"></div>
                <div class="cssload-inner cssload-three"></div>
            </div>
        </div>
        <div class="border itemsScaleUp-true owl-carousel">
            <!-- Manga -->
            @foreach ($populars as $popular)
                <a href="{{ route('comic.show',$popular->comic->slug) }}" title="{{ $popular->comic->title ?? '-' }} terbaru">
                    <img src="{{ url('storage/comic/image/'.$popular->comic->slug.'.jpg') }}" height="245" width="145" onerror="imerriwp(this);"/>
                </a>
            @endforeach
        </div>
    </div>
</center>
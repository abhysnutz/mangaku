<div id="sidebar">
    <!--themesia cache start-->
    <div class="section">
        <div class="releases"><h3>Serial baru</h3></div>
        <span style="visibility: unset;">
            <div class="serieslist">
                <ul>
                    @foreach ($sideNews as $sideNew)
                        <li>
                            <div class="imgseries">
                                <a class="series" href="{{ route('comic.show',$sideNew->slug) }}" rel="{{ $sideNew->id }}">
                                    <img src="{{ asset('storage/comic/thumbnail/'.$sideNew->slug.'.jpg') }}" class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" title="{{ $size->title ?? '-' }}" alt="{{ $size->title ?? '-' }}" width="200" height="283"/>
                                </a>
                            </div>
                            <div class="leftseries">
                                <h2>
                                    <a class="series" href="{{ route('comic.show',$sideNew->slug) }}" rel="{{ $sideNew->id }}">{{ $sideNew->title ?? '-' }}</a>
                                </h2>
                                <span>
                                    <b>Genres</b>: 
                                    @foreach ($sideNew->categories as $category)
                                        <a href="{{ route('genre',$category->slug) }}" rel="tag">{{ $category->title ?? '-' }}</a>,
                                    @endforeach
                                </span>
                                <span>{{ $sideNew->detail->released ?? '-' }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </span>
    </div>
    <div class="section">
        <div class="releases"><h3>Genres</h3></div>
        <ul class="genre">
            @if ($genres->count())
                @foreach ($genres as $genre)
                    <li>
                        <a href="{{ route('genre',$genre->slug) }}" title="View all series in {{ $genre->title }}">
                            {{ $genre->title }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
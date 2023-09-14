@foreach ($chars as $key => $char)
    <div class="npx">
        <a class="hrff" name="{{ $char }}">{{ $char }}</a>
        <ul>
            @foreach ($comics[$key] as $comic)
                <li class="an">
                    <a class="tooltip"  href="{{ route('comic.show',$comic->slug) }}">
                        {{ $comic->title ?? '-' }}
                        <span id="fip">
                            
                            <img class="gbrhv lazy" data-src="{{ asset('storage/comic/image/'.$comic->slug.'.jpg') }}">
                            <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width: {{ $comic->detail->rating ? $comic->detail->rating * 10 : 0 }}%"></div>
                            </div>
                            <p style="position: relative;top: 1px;left: 5px;color:#fff;font-weight:bold;display: inline-block;margin: 0 auto;font-size: 12px;">{{ $comic->detail->rating ?? 0 }}</p>
                            <br>
                            <strong >Genre : </strong>
                            @foreach ($comic->categories as $category)
                                {{ $category->title }}@if(!$loop->last),@endif
                            @endforeach 
                            <br>
                            <strong >Sinopsis : </strong>{{ $comic->detail->description ?? '-' }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
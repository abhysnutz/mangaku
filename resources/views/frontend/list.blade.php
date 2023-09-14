@extends('frontend.layout.layout')
@section('title','List Mode - '.env('APP_NAME'))
@section('meta-description','Baca Manga Komik Bahasa Indonesia')

@section('content')
    <div id="content">
        <div class="wrapper">
            <div class="postbody">
                <div class="bixbox seriesearch">
                    <div class="releases"><h1>Manga Lists</h1></div>
                    <div class="mrgn">
                        <div class="nav_apb">
                            @foreach ($chars as $key => $char)
                                @if ($char >= 'A' && $char <= 'Z')
                                    <a href="#{{ $char }}">{{ $char }}</a>
                                @endif
                            @endforeach
                        </div>
                        <div class="clear"></div>
                        <div class="modex">
                            <a href="{{ route('comic.index') }}">Image Mode</a>
                        </div>
                        <div class="soralist">
                            <div class="lxx"></div>
                            @foreach ($chars as $key => $char)
                                <div class="blix">
                                    <span><a name="{{ $char }}">{{ $char }}</a></span>
                                    <ul>
                                        @foreach ($comics[$key] as $comic)
                                            <li><a class="series" rel="{{ $comic->id }}" href="{{ route('comic.show',$comic->slug) }}">{{ $comic->title ?? '-' }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @include('frontend.layout.sidebar')
            <script>
                $(".section .quickfilter").parent().remove();
            </script>
        </div>
    </div>
@endsection
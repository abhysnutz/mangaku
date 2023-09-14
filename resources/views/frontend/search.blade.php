@extends('frontend.layout.layout')
@section('title','Daftar Komik - '.env('APP_NAME'))
@section('meta-description','Daftar Komik - '.env('APP_NAME'))

@section('content')
    <div id="content">
        <div class="wrapper">
            <div class="postbody">
                <div class="bixbox">
                    <div class="releases">
                        <h1>Cari '{{ $search ?? '-' }}'</h1>
                    </div>
                    <div class="listupd">
                        @foreach ($comics as $comic)
                            <div class="bs">
                                <div class="bsx">
                                    <a href="{{ route('comic.show',$comic->slug) }}" title="{{ $comic->title ?? '-' }}">
                                        <div class="limit">
                                            <div class="ply"></div>
                                            <span class="type {{ $comic->detail->type ?? 'Manga' }}"></span>
                                            <img src="{{ asset('storage/comic/image/'.$comic->slug.'.jpg') }}" class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" title="{{ $comic->title ?? '-' }}" alt="{{ $comic->title ?? '-' }}" width="209" height="300"/>
                                        </div>
                                        <div class="bigor">
                                            <div class="tt"> {{ $comic->title ?? '-' }} </div>
                                            <div class="adds">
                                                <div class="epxs">
                                                    @if ($comic->chapters->count())
                                                        {{ $comic->chaptersDown()->first()->title }}
                                                    @endif
                                                </div>
                                                @if ($comic->detail)
                                                    <div class="rt">
                                                        <div class="rating">
                                                            <div class="rating-prc">
                                                                <div class="rtp">
                                                                    <div class="rtb">
                                                                        <span style="width: {{ $comic->detail->rating ? $comic->detail->rating * 10 : 0 }}%;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="numscore">{{ $comic->detail->rating ?? 0 }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('frontend.layout.sidebar')
            <script>
                $(".section .quickfilter").parent().remove();
            </script>
        </div>
    </div>
@endsection

@push('js-bottom')
    <script data-minify="1" type="text/javascript" src="{{ asset('assets/frontend/js/filter.js') }}" id="filter-js"></script>
    
@endpush
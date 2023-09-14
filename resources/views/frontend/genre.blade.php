@extends('frontend.layout.layout')
@section('title','Baca Komik Genre '.($category->title ?? null).' - '.env('APP_NAME'))
@section('meta-description','Link baca komik Genre '.($category->title ?? null).' terlengkap di '.env('APP_NAME').'. Semua manga Genre '.($category->title ?? null).' sudah diterjemahkan kedalam bahasa Indonesia.')
@push('css-top')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/genre.css') }}">
@endpush
@section('content')
    <div class="cgarisbw" id="contentwrap">
        <div class="bixbox">
            <div class="releases">
                <h1><span class="mgk-a">Search Manga Genre : " <em>{{ $category->title ?? '-' }}</em> "</span></h1>
            </div>
            {{-- <div id="search" style="background:none;">
                <form action="https://mangaku.fun" class="searchh" id="searchform" method="GET">
                    <input type="text" name="s" id="keyword" autocomplete="off" placeholder="Cari..." required="">
                    <button type="submit" id="header-search-button" value="Search"><i class="fa fa-search"></i></button>
                </form>
            </div> --}}
            <div class="ctr">
                <div class="notIE">
                    <span class="genrearrow"></span>
                    <select name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                        <option value="#">Genre Komik..</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->slug }}" @if($genre->slug == $category->slug) selected @endif>{{ $genre->title }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <span class="ord">Order By </span>
                <a href="https://mangaku.fun/?s=&amp;label=hot" title="View all Manga Hot"><button class="view">Hot</button></a>
                <a href="https://mangaku.fun/?s=&amp;label=project" title="View all Manga Project"><button class="view">Project</button></a>
                <a href="https://mangaku.fun/?s=&amp;label=tamat" title="View all Manga Tamat"><button class="view">Tamat</button></a> --}}
            </div>
            <div class="hr"></div>
            <div id="wrapper-a">
                @foreach ($comics as $comic)
                    <div id="content-a">
                        <span class="bsr"><a href="{{ route('comic.show', $comic->slug) }}">
                            {{ $comic->title ?? '-' }}</a>
                        </span>
                        <span class="inf">
                            <span class="infx">Alternative Name</span> :&nbsp;
                            <p>{{ $comic->detail->alias ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Genre</span> :&nbsp;
                            <p>
                                @foreach ($comic->categories as $category)
                                    <a href="{{ route('genre',$category->slug) }}" rel="tag">{{ $category->title }}</a>@if(!$loop->last),&nbsp;@endif
                                @endforeach 
                            </p>
                        </span>
                        <span class="inf">
                            <span class="infx">Type</span> :&nbsp;
                            <p>{{ $comic->detail->type ?? 'Manga' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Score</span> :&nbsp;
                            <p>{{ $comic->detail->rating ?? 0 }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Latest chapter</span> :&nbsp;
                            <p>
                                @if ($comic->chapters->count())
                                    @foreach ($comic->chapters()->select('slug','title','updated_at')->orderBy('order','DESC')->limit(1)->get() as $chapter)
                                        {{ $chapter->title ?? '-' }}
                                    @endforeach
                                @endif
                            </p>
                        </span>
                    </div>
                    <div id="sidebar-a">
                        <div class="separator" style="clear: both; text-align: center;">
                            <a href="{{ route('comic.show', $comic->slug) }}" imageanchor="1" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;padding-right: 10px;">
                            <img style="width: 150px;height: 150px;" class="mgkbdr_s" data-src="{{ asset('storage/comic/image/'.$comic->slug.'.jpg') }}" width="200" height="257" border="0" src="{{ asset('storage/comic/image/'.$comic->slug.'.jpg') }}"></a>
                        </div>
                    </div>
                    <div id="cleared"></div>
                @endforeach

                <div id="hal">
                    {{ $comics->links('vendor.pagination.mangaku') }}
                </div>
            </div>
        </div>
    </div>
@endsection
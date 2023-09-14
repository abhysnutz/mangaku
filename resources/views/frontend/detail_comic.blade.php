@extends('frontend.layout.layout')
@section('title',$comic->title.' - '.env('APP_NAME'))
@section('meta-description',$description)

@push('css-top')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/detail-comic.css') }}">
@endpush
@section('content')
    <div id="contentwrap">
        <div class="post singlep">
            <h1 class="titles">
                <a style="color: #fff;" href="" rel="bookmark" title="Permanent Link to {{ $comic->title ?? '-' }}">{{ $comic->title ?? '-' }} Bahasa Indonesia</a>
            </h1>
            <div class="entry">
                <div id="wrapper-a">
                    <div id="content-a">
                        <span class="inf">
                            <span class="infx">Alternative Name</span> :&nbsp;
                            <p class="alx">{{ $comic->detail->alias ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Genre</span> :&nbsp;
                            <p>
                                @if ($comic->categories->count())
                                    @foreach ($comic->categories as $category)
                                        <a href="{{ route('genre',$category->slug) }}" rel="tag">{{ $category->title }}</a>,&nbsp;
                                    @endforeach    
                                @endif    
                            </p>
                        </span>
                        <span class="inf">
                            <span class="infx">Type</span> :&nbsp;
                            <p>{{ $comic->detail->type ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Score</span> :&nbsp;
                            <p>{{ $comic->detail->rating ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Release Date</span> :&nbsp;
                            <p>{{ $comic->detail->released ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Author</span> :&nbsp;
                            <p>{{ $comic->detail->author ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Serialization</span> :&nbsp;
                            <p>{{ $comic->detail->serialization ?? '-' }}</p>
                        </span>
                        <span class="inf">
                            <span class="infx">Sinopsis</span> :&nbsp;
                            <p class="obv">
                                {{ $comic->detail->description ?? '-' }}
                            </p>
                        </span>
                    </div>
                    <div id="sidebar-a" class="mgkbdr">
                        <div class="separator" style="clear: both; text-align: center;">
                            <a href="#" imageanchor="1" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;padding-right: 10px;">
                                <img src="{{ url('storage/comic/image/'.$comic->slug.'.jpg') }}" width="200" height="257" border="0">
                            </a>
                        </div>
                    </div>
                    <div id="cleared"></div>
                </div>
               
                <div id="wrapper-b">
                    <div id="content-b">
                        <div style="-moz-border-radius: 5px 5px 5px 5px; border: 1px solid rgb(255, 204, 0); color: black; overflow: auto; width: 100%;margin: 0 auto;margin-top: 5px;">
                            @forelse ($comic->chapters()->has('images')->orderBy('order','DESC')->get() as $chapter)
                                <a href="{{ route('comic.chapter',$chapter->slug) }}">
                                    {{ $comic->title ?? '-' }} - {{ $chapter->title ?? '-' }}</a>
                                <br>
                            @empty
                                NO CHAPTER
                            @endforelse
                        </div>
                    </div>
                    <div id="sidebar-b">
                        <div style="-moz-border-radius: 5px 5px 5px 5px; border: 1px solid rgb(183, 183, 183); color: black; overflow: auto; width: 100%;margin: 0 auto;margin-top: 5px !important;text-align: center;">
                            <div class="separator" style="clear: both; text-align: center;"><a href="https://duniata.com/pemasangan-iklan/" imageanchor="1" style="margin-left: 1em; margin-right: 1em;">
                                <img border="0" data-original-height="1300" data-original-width="905" src="https://cdn.mangaku.my.id/gambar/2022/10/8b9697864b94ff6713986cdd-fecb5d18ec594df8d33f90b179ad402d.gif"></a>
                            </div>
                            <br>  <br>  
                            <div class="separator" style="clear: both; text-align: center;"><a href="https://mangalist.org/url/go/Mzl4ZGp3dEwvOXEzbTNJd3pWSkhmVmdNdHA4YU5yNmM1Z2Q1WXJMZEtPREtvK0Z4Sk1nM1RveDVGTUtsS3AwZkFJa0R3RXZ0Sm52UkNXK1dSWTBVSVE9PQ==&amp;owner=manganime.in" imageanchor="1" style="margin-left: 1em; margin-right: 1em;">
                                <img border="0" data-original-height="1300" data-original-width="905" src="https://cdn.mangaku.my.id/gambar/2022/12/5c62c80b1a9ad90942797e34-a8b509f283a8e1ab4601036930451f71.gif"></a>
                            </div>
                            <br>  <br>  
                        </div>
                    </div>
                    <div id="cleared"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('frontend.layout.layout')
@section('thememode','none')
@section('title','Komik '.$chapter->comic->title.' '.$chapter->title.' - '.env('APP_NAME'))
@section('meta-description',$description)
@push('css-top')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/detail-chapter.css') }}">
@endpush
@section('content')
    <div id="contentwrap">
        <div class="post singlep">
            <h1 class="titles">
                <a style="color: #fff;" href="{{ \Request::url() }}" rel="bookmark" title="Permanent Link to Baca Manga {{ $chapter->comic->title }} {{ $chapter->title }} Bahasa Indonesia">Baca {{ $chapter->comic->detail->type ?? 'Manga' }} {{ $chapter->comic->title ?? '-' }} {{ $chapter->title ?? '-' }} Bahasa Indonesia</a>
            </h1>
            <div class="fndsosmed-social">
                <button style="width: 150px;" class="glho glkn_1" type="button">
                    <div class="notIE" style="margin:0; position:unset;">
                        <span class="genrearrow"></span>
                        <select id="pilihchapter" style="height: 20px;" name="tag-dropdown" onchange="this.options[this.selectedIndex].value&amp;&amp;window.open(this.options[this.selectedIndex].value,'_self')">
                            @foreach ($chapter->comic->chapters()->orderBy('order','DESC')->get() as $chapter2)
                                <option data-id="{{ $chapter2->id }}" value="{{ route('comic.chapter',$chapter2->slug) }}" @if($chapter->id == $chapter2->id) selected @endif>{{ $chapter2->title ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                </button>
                @if($prev) <a href="{{ route('comic.chapter',$prev->slug, ) }}"><button class="glho glkp_1" type="button"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;PREV</button></a> @endif
                @if($next) <a href="{{ route('comic.chapter',$next->slug, ) }}"><button class="glho glkn_1" type="button">NEXT&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></button></a> @endif
                <a href="https://docs.google.com/forms/d/1vRH7eoJRnmkBRrGUytSsYp5TSoLOjTb6n2-1lAklqFI/">
                    <button style="width: 150px;" class="glho glkn_1" type="button">
                        <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Laporan Error
                    </button>
                </a>
                <span class="mgk-a aup">Author : {{ $chapter->comic->detail->author ?? '-' }}</span>
            </div>
            
            <div class="sURNPDfJAlmp">
                @foreach ($chapter->images as $key => $image)
                    <img class="ts-main-image" data-index="{{ $key }}" src="{{ $image->url }}"/>
                @endforeach
            </div>
            
            <div class="ctr" style="padding-bottom: 5px;">
                @if($prev) <div><a href="{{ route('comic.chapter',$prev->slug, ) }}"><button class="view">Chapter Sebelumnya</button></a></div> @endif
                <div><a href="{{ route('comic.show',$chapter->comic->slug) }}"><button class="view">Daftar Chapter</button></a></div>
                @if($next) <div><a href="{{ route('comic.chapter',$next->slug, ) }}"><button class="view">Chapter Selanjutnya</button></a></div> @endif
            </div>
            
            <div class="postmetadata">
                {{ \Carbon\Carbon::now()->format('F d, Y') }} in 
                <a href="{{ route('comic.show',$chapter->comic->slug) }}" rel="category tag">
                    {{ $chapter->comic->title }}
                </a>                
            </div>
        </div>
    </div>
@endsection

@push('js-bottom')
    
@endpush
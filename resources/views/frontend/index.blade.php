@extends('frontend.layout.layout')
@section('title',env('APP_NAME').' - Baca Komik Bahasa Indonesia')
@section('meta-description','Baca Komik Bahasa Indonesia')

@section('content')
    <table style="width: 99%;background: #000;" border="2" bordercolor="#0066FF" style="background-color:#0F0F0F" width="700" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="bixbox bd">
                    <div class="releases bdlkb">
                        <h3>
                            <span class="mgk-a">
                                <center> Update Proyek </center>
                            </span>
                        </h3>
                    </div>
                    <div class="listupd proyek">
                        <div class="row">
                            {{-- START PROJECT --}}
                            @if ($projects->count())
                                @foreach ($projects as $project)
                                    <div class="utao">
                                        <div class="uta">
                                            <div class="imgu">
                                                <img class="lazy" data-src="{{ asset('storage/comic/image/'.$project->slug.'.jpg') }}">
                                            </div>
                                            <div class="luf">
                                                <a title="{{ $project->title ?? '-' }}" data-tipso="{{ $project->title ?? '-' }}" class="series bseries fnd-tip" href="{{ route('comic.show', $project->slug) }}">
                                                    {{ $project->title ?? '-' }}
                                                </a>
                                                <div class="rtg">
                                                    <div class="br-wrapper br-theme-fontawesome-stars">
                                                        <div class="br-widget br-readonly">
                                                            <div class="scorenya">
                                                                <div class="ftt">
                                                                    <div class="bintangrating">
                                                                        <span style="width: {{ $project->detail->rating ? $project->detail->rating * 10 : 0 }}%;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="vts"><b>{{ $project->detail->rating ?? 0 }}</b></span>
                                                </div>
                                                <ul class="Manga_Chapter">
                                                    @if ($project->chapters->count())
                                                        @foreach ($project->chapters()->select('slug','title','updated_at')->orderBy('order','DESC')->limit(1)->get() as $chapter)
                                                            <li>
                                                                <a href="{{ route('comic.chapter',$chapter->slug) }}">
                                                                    <button class="viewind">
                                                                        {{ $chapter->title ?? '-' }}
                                                                    </button>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                    <li><a href="{{ route('comic.show', $project->slug) }}"><button class="viewind">Daftar Isi</button></a></li>
                                                    <li>
                                                        <time class="timeago">
                                                            {{ \Carbon\Carbon::parse($project->updated_at)->diffForHumans() }}
                                                        </time>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            {{-- END PROJECT --}}
                        </div>
                    </div>
                </div>
                <div id="t1" class="bixbox">
                    <div class="releases bdl">
                        <h3>
                            <span class="mgk-a">
                                <center> Update Komik </center>
                            </span>
                        </h3>
                    </div>
                    <div class="listupd">
                        <div class="kiri_anime">
                            @if ($latests->count())
                                @foreach ($latests as $key => $latest)
                                    @if ($key %2 == 0)
                                        <div class="utao">
                                            <div class="uta">
                                                <div class="imgu">
                                                    <img class="lazy" data-src="{{ asset('storage/comic/image/'.$latest->slug.'.jpg') }}">
                                                </div>
                                                <div class="luf">
                                                    <a title="{{ $latest->title ?? '-' }}" data-tipso="{{ $latest->title ?? '-' }}" class="series bseries fnd-tip" href="{{ route('comic.show', $latest->slug) }}">
                                                        {{ $latest->title ?? '-' }}
                                                    </a>
                                                    <div class="rtg">
                                                        <div class="br-wrapper br-theme-fontawesome-stars">
                                                            <div class="br-widget br-readonly">
                                                                <div class="scorenya">
                                                                    <div class="ftt">
                                                                        <div class="bintangrating">
                                                                            <span style="width: {{ $latest->detail->rating ? $latest->detail->rating * 10 : 0 }}%;"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="vts"><b>{{ $latest->detail->rating ?? 0 }}</b></span>
                                                    </div>
                                                    <ul class="Manga_Chapter">
                                                        @if ($latest->chapters->count())
                                                            @foreach ($latest->chapters()->select('slug','title','updated_at')->orderBy('order','DESC')->limit(1)->get() as $chapter)
                                                                <li>
                                                                    <a href="{{ route('comic.chapter',$chapter->slug) }}">
                                                                        <button class="viewind">
                                                                            {{ $chapter->title ?? '-' }}
                                                                        </button>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                        <li><a href="{{ route('comic.show', $latest->slug) }}"><button class="viewind">Daftar Isi</button></a></li>
                                                        <li>
                                                            <time class="timeago">
                                                                {{ \Carbon\Carbon::parse($latest->updated_at)->diffForHumans() }}
                                                            </time>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach    
                            @endif
                        </div>
                        <div class="kanan_manga">
                            @if ($latests->count())
                                @foreach ($latests as $key => $latest)
                                    @if ($key %2 == 1)
                                        <div class="utao">
                                            <div class="uta">
                                                <div class="imgu">
                                                    <img class="lazy" data-src="{{ asset('storage/comic/image/'.$latest->slug.'.jpg') }}">
                                                </div>
                                                <div class="luf">
                                                    <a title="{{ $latest->title ?? '-' }}" data-tipso="{{ $latest->title ?? '-' }}" class="series bseries fnd-tip" href="{{ route('comic.show', $latest->slug) }}">
                                                        {{ $latest->title ?? '-' }}
                                                    </a>
                                                    <div class="rtg">
                                                        <div class="br-wrapper br-theme-fontawesome-stars">
                                                            <div class="br-widget br-readonly">
                                                                <div class="scorenya">
                                                                    <div class="ftt">
                                                                        <div class="bintangrating">
                                                                            <span style="width: {{ $latest->detail->rating ? $latest->detail->rating * 10 : 0 }}%;"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="vts"><b>{{ $latest->detail->rating ?? 0 }}</b></span>
                                                    </div>
                                                    <ul class="Manga_Chapter">
                                                        @if ($latest->chapters->count())
                                                            @foreach ($latest->chapters()->select('slug','title','updated_at')->orderBy('order','DESC')->limit(1)->get() as $chapter)
                                                                <li>
                                                                    <a href="{{ route('comic.chapter',$chapter->slug) }}">
                                                                        <button class="viewind">
                                                                            {{ $chapter->title ?? '-' }}
                                                                        </button>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                        <li><a href="{{ route('comic.show', $latest->slug) }}"><button class="viewind">Daftar Isi</button></a></li>
                                                        <li><time class="timeago">{{ \Carbon\Carbon::parse($latest->updated_at)->diffForHumans() }}</time></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach    
                            @endif
                        </div>
                    </div>
                </div>
                <div class="ctr">
                    <a href="{{ route('comic.index') }}" title="View all Manga"><button class="view">View all Komik</button></a>
                </div>
                <td class="sdbr">
                    <div class="releases" style="margin-left: 3px;border-radius: 2px;">
                        <h3>
                            <span class="mgk-a">
                                <center> Info Penting </center>
                            </span>
                        </h3>
                    </div>
                    <div class="rightBox" id="topUsers" style="-webkit-text-stroke-width: 0px;color: #393939; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal;     text-transform: none; white-space: normal;  width: 320px; word-spacing: 0px;">
                        <a class="chapter" onclick="window.open('https://mangaku.fun/lowongan/')" href="#">
                            <strong>
                                <marquee scrollamount="3" class="mrq" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseleave="this.start();">
                                    Info :  Jika Jaringan Indihome & Telkomsel Lagi Lemot Banget [Cloudflare issue]. Gunakan jaringan lain / gunakan VPN Singapura/Usa - Baca Info anime menarik lainnya di : www.mangalist.org
                            </strong>
                            </marquee> <!-- TEMPAT INFO PENTING -->     
                        </a>
                    </div>
                    {{-- <div id="search">
                        <h3 style="border-top: 1px solid #393939;">
                            <span class="mgk-a">
                                <center> Masukkan Judul Manga </center>
                            </span>
                        </h3>
                        <form action="https://mangaku.fun" class="searchh" id="searchform" method="GET">
                            <input class="search-box" type="text" name="s" id="keyword" autocomplete="off" placeholder="Cari..." maxlength="150" pattern=".{3,150}" required title="Masukkan Minimal 4 Huruf">
                            <span class="close-icon" onclick="ClearFields();"></span>
                            <button style="display:none" class="close-iconx" type="reset"></button>
                            <button type="submit" id="header-search-button" value="Search"><i class="fa fa-search"></i></button>
                        </form>
                    </div> --}}
                    <div class="lds-ring">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div id="datalivesearch"></div>
                    <br> </br> 
                    <center>
                        <div id="fb-root"></div>
                        <div class="fb-page" data-href="https://www.facebook.com/Mangaku.in" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote class="fb-xfbml-parse-ignore" cite="https://www.facebook.com/Mangaku.in">
                                <p><a href="https://www.facebook.com/Mangaku.in">Mangaku</a></p>
                            </blockquote>
                        </div>
                    </center>
                    </br> 
                    <!-- sosmed sidebar-->
                    <ul class="social-follow" itemscope="" itemtype="http://schema.org/Organization">
                        <link itemprop="url" href="https://mangaku.fun">
                        <li class="service">
                            <a href="https://www.facebook.com/groups/465470483575238/" class="service-link facebook cf" itemprop="sameAs">
                            <i class="icon fa fa-facebook-square"></i>
                            <span class="label"> Join The Group Facebook </span>
                            </a>
                        </li>
                        <li class="service">
                            <a href="https://www.instagram.com/distro.mangaku/" class="service-link instagram cf" itemprop="sameAs">
                            <i class="icon fa fa-instagram"></i>
                            <span class="label">Follow on Instagram</span>
                            </a>
                        </li>
                        <li class="service">
                            <a href="https://www.youtube.com/channel/UCNgt8E7F1hsDInH9S00OH5g" class="service-link youtube cf" itemprop="sameAs">
                            <i class="icon fa fa-youtube"></i>
                            <span class="label">Subscribe on YouTube</span>
                            </a>
                        </li>
                    </ul>
                    <!-- end sosmed -->
                    </br> 
                    <li style="border-top-color: #393939; border-top-style: solid; border-top-width: 1px; cursor: pointer; display: block; list-style-type: none; padding: 5px;"> </li>
                    <center>
                    </center>
                    <li style="border-top-color: #393939; border-top-style: solid; border-top-width: 1px; cursor: pointer; display: block; list-style-type: none; padding: 5px;"> </li>
                    </br>
                    <div dir="ltr" style="text-align: left;" trbidi="on">
                    <div class="rightBox" id="topUsers" style="-webkit-text-stroke-width: 0px; background-color: 0F0F0F; background-position: initial initial; background-repeat: initial initial; border-bottom-width: 0px; border-left-color: rgb(154, 185, 255); border-left-style: solid; border-left-width: 1px; border-right-width: 0px !important; border-top-width: 0px; color: #393939; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; width: 320px; word-spacing: 0px;">
                    </div>
                    <div id="h_read" style="-webkit-text-stroke-width: 0px; background-color: 0F0F0F; background-position: initial initial; background-repeat: initial initial;  border-bottom-style: solid; border-bottom-width: 1px; border-left-style: solid; border-left-width: 1px; border-right-width: 0px !important; border-top-width: 0px; color: #393939; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; width: 320px; word-spacing: 0px;">
                        <div id="h_read2"></div>
                    </div>
                    <div class="rightBox" id="topManga" style="-webkit-text-stroke-width: 0px; background-color: 0F0F0F; background-position: initial initial; background-repeat: initial initial;  border-bottom-style: solid; border-bottom-width: 1px; border-left-style: solid; border-left-width: 1px; border-right-width: 0px !important; border-top-width: 0px; color: #393939; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; width: 320px; word-spacing: 0px;">
                        <div class="releases" style="border-radius: 2px;">
                            <h3>
                                <span class="mgk-a">
                                    <center>  Komik Rekomendasi</center>
                                </span>
                            </h3>
                        </div>
                        @foreach ($populars as $popular)
                     
                        <div class="sidebar-content" style="display:inline-block;">
                            <a href="{{ route('comic.show',$popular->comic->slug) }}">
                            <img class="lazy" data-src="{{ url('storage/comic/image/'.$popular->comic->slug.'.jpg') }}" width="50" height="66"></a>
                            <h2><a href="{{ route('comic.show',$popular->comic->slug) }}" title="{{ $popular->comic->title ?? '-' }}">{{ $popular->comic->title ?? '-' }}</a></h2>
                            <div style="padding-right:5px">
                                @foreach ($popular->comic->chapters()->select('slug','title','updated_at')->orderBy('order','DESC')->limit(1)->get() as $chapter)
                                    <a class="" href="{{ route('comic.chapter',$chapter->slug) }}" title="titlenya"><i class="fa fa-caret-right"></i> {{ $chapter->title ?? '-' }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="notIE">
                            <span class="genrearrow"></span>
                            <select disabled id="noact" name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                                <option value="#">Genre Komik..</option>
                            </select>
                            <ul class='wp-genre'>
                                @foreach ($genres as $genre)
                                    <li class='an'>
                                        <i class='fa fa-caret-right'></i>
                                        <a href='{{ route('genre',$genre->slug) }}' title='{{ $genre->title }}' target='_blank'>{{ $genre->id }}. {{ $genre->title }}</a>
                                    </li>
                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br><br>
                </td>
            </td>
        </tr>
    </table>
@endsection
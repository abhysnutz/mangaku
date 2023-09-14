@extends('frontend.layout.layout')
@section('title',env('APP_NAME').' - Baca Komik Bahasa Indonesia')
@section('meta-description','Baca Komik Bahasa Indonesia')
@push('css-top')
    <link rel='stylesheet' id='fip-css'  href='https://mangaku.fun/wp-content/themes/FlexorMagazine/css/jquery.fip.css?ver=3.1' type='text/css' media='all' />
    <script type="text/javascript" src="https://mangaku.fun/wp-content/themes/FlexorMagazine/js/jquery.fip.min.js?ver=3.1"></script>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/comic-list.css') }}">
@endpush
@section('content')
    <div class="post singlep" id="post-454">
        <div class="entry">
            <h2 class="titles"><a href="https://mangaku.fun/daftar-komik-bahasa-indonesia/" rel="bookmark" title="Permanent Link to Daftar Komik Bahasa Indonesia">Daftar Komik Bahasa Indonesia</a>
            </h2>
            <div class="advancedsearch advs">
                <div class="notIE">
                    <span class="genrearrow"></span>
                    <select id="genre" name="tag-dropdown">
                        <option value="#">Genre Komik..</option>
                        @foreach ($genres as $genre)
                            <option value='{{ $genre->id }}'>{{ $genre->title ?? '-' }}</option>    
                        @endforeach
                    </select>
                </div>
                    <div class="radio-item">
                        <input type="radio" id="all" name="ritem" value="all" checked>
                        <label for="all">ALL</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="hot" name="ritem" value="hot" >
                        <label for="hot">HOT</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="project" name="ritem" value="project" >
                        <label for="project">PROJECT</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="tamat" name="ritem" value="end" >
                        <label for="tamat">TAMAT</label>
                    </div>
                    <div class="btnx" style="width: 100%">
                        <button class="searchz">Search</button>
                    </div>
            </div>
            <div class="ctr">
                @foreach ($chars as $key => $char)
                    @if ($char >= 'A' && $char <= 'Z')
                        <a href="#{{ $char }}">
                            <button class="daftarlk">{{ $char }}</button>
                        </a>
                    @endif
                @endforeach
                
                <p></p>
                <div class="clear"></div>
            </div>
            <div id="data" class="dftmgk">
                
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection

@push('js-bottom')
    <script>
        $(document).ready(function(){
            $.each($('a.tooltip'), function (index, item) {
                const ini = $(this);
                const rpx = item.firstElementChild.innerHTML;
                const xpr = rpx.replace('data-src', 'src');
                ini.qtip({
                    content: {
                        text: xpr
                    },
                    show: 'mouseover',
                    hide: {
                        delay: 200,
                        fixed: true
                    },
                    style: {
                        classes: ''
                    },
                    position: {
                        target: 'event',
                        my: 'top center',
                        at: 'bottom center',
                        adjust: {
                            mouse: false
                        },
                        viewport: $(window)
                    }
                });
            });

            data();

            $(document).on('click','.searchz', function(){
                let genre = $('#genre').val()
                let type = $('input[name="ritem"]:checked').val();

                data(genre, type)
            })
        });

        function data(genre = '#', type = 'all'){
            console.log('test');
            $.ajax({
                url : "{{ route('comic.filter') }}",
                method : "POST",
                data : {genre,type},
                success : reply => {
                    $('#data').empty().html(reply);
                }
            })
        }
    </script>
@endpush
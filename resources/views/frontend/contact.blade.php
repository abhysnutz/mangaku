@extends('frontend.layout.layout')

@section('content')
    <div id="content">
        <div class="wrapper">
            <div class="postbody">
                <div class="bixbox">
                    <div class="releases">
                        <h1><span>Contact</span></h1>
                    </div>
                    <div class="page">
                        <p>If you have any questions</p>
                        <p>please contact us : {{ env("MAIL_FROM_ADDRESS") }}</p>
                        <p>Thanks</p>
                    </div>
                </div>
            </div>
            @include('frontend.layout.sidebar')
        </div>
    </div>
@endsection
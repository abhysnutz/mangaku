@extends('frontend.layout.layout')
@section('title','DMCA - '.env('APP_NAME'))
@section('meta-description','If you have reason to believe that one of our content is violating your copyrights or some of Search Results references to illegal contents, please send a email for us. Please allow up to a 1-5 business days for an email response.')

@section('content')
    <div id="content">
        <div class="wrapper">
            <div class="postbody">
                <div class="bixbox">
                    <div class="releases">
                        <h1><span>DMCA</span></h1>
                    </div>
                    <div class="page">
                        <p>
                            If you have reason to believe that one of our content is violating your copyrights or some of Search Results references to illegal contents, please send a email for us. Please allow up to a 1-5 business days for an
                            email response. Note that emailing your complaint to other parties such as our Internet Service Provider, Hosting Provider, and other third party will not expedite your request and may result in a delayed response
                            due to the complaint not being filed properly.
                        </p>
                        <p>Required information</p>
                        <p>Please note that we deal only with messages that meet the following requirements:</p>
                        <p>
                            – Please Provide us with your name, address and telephone number. We reserve the right to verify this information.<br />
                            – Explain which copyrighted material is affected.<br />
                            – Please provide the exact and complete to the url link.<br />
                            – If it a case of files with illegal contents, please describe the contents briefly in two or three points.<br />
                            – Please ensure that you can receive further enquiries from us at the e-mail address you are writing from.<br />
                            – Please write to us only in English or Indonesian.
                        </p>
                        <p>Notice:</p>
                        <p>Anonymous or incomplete messages will not be deal with it. Thank you for your understanding.</p>
                        <p>
                            DISCLAIMER:<br />
                            None of the all files and video listed in this website are hosted on the server of {{ env('APP_URL') }} all point to content hosted on third party websites. {{ env('APP_URL') }} does not accept responsibility for content
                            hosted on third party websites and does not have any involvement in the downloading/uploading of pictures. We just post links available in internet. If you think any of the contents of this site infringes any
                            intellectual property law and you hold the copyright of that content please report it to {{ env('MAIL_FROM_ADDRESS') }} the content will be immediately removed.<br />
                            Thank you.
                        </p>
                    </div>
                </div>
            </div>
            @include('frontend.layout.sidebar')
        </div>
    </div>
@endsection
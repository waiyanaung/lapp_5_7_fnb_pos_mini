@extends('layouts_frontend.master_frontend')
@section('title','Login')
@section('content')
    <div id="header_id">
        <img class="img-responsive img-hover" src="shared/images/slider1.png">
    </div>
    </div>
    </section>

    <h3>Test Multi_language</h3>
    <div>
        <a href="/lang/jp">
            <img src="/images/mmflag.png">
        </a>
        <a href="/lang/en">
            <img src="/images/usflag.png">
        </a>
    </div>
    <p>{{trans('messages.home')}}</p>
@stop

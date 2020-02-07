@extends('layouts_frontend.master_frontend')
@section('title','Brand')
@section('content')

<section>

    <div class="container">
        <div class="row rounded_div_with_shadow">
            <div div class="col-md-12">
                <span><b>Brands</b></span>
            </div>
        </div>
        <br>

        <div class="row">
        @foreach($objs as $obj)
            
            <!-- <div class="row rounded_div_with_shadow">
                <div class="col-md-3">
                    <a class="link_button" href="/brand_detail/{{$obj['id']}}">
                        <img class="image" src="{{$obj['image_url']}}" alt="{{$obj['name']}}">
                    </a>
                </div>

                <div class="col-md-7 align-middle">
                    <p>
                        <a class="link_button" href="/brand_detail/{{$obj['id']}}">
                            <b>{{$obj['name']}}</b>
                        </a>
                    </p>
                    
                    <p>{{$obj['description']}}</p>
                </div>

                <div class="col-md-2">
                    <a class="form-control btn btn-primary" href="/brand_detail/{{$obj['id']}}">Brand detail</a>
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="card rounded_div_with_shadow2">
                    <img class="card-img-top image" src="{{$obj['image_url']}}" alt="Card image cap">
                    <div class="card-body">
                        <h6 class="card-title">
                            <a class="link_button" href="/brand_detail/{{$obj['id']}}">
                                {{$obj['name']}}
                            </a>
                        </h6>
                        <br><br>

                        <p class="button">
                            <a class="form-control link_button3" href="/brand_detail/{{$obj['id']}}">view items</a>
                        </p>
                    </div>
                </div>
            </div>

        @endforeach

    <!--End dynamic objs content-->
    </div>
</section>


@stop

@section('page_script')

@stop
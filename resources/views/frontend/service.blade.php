@extends('layouts_frontend.master_frontend')
@section('title','Service')
@section('content')
        <div class="header_id div_under_header_menu"></div>
        </div>
    </div>

    </section>

     <section>

     <div class="container">
            <div class="row">
                <div div class="col-md-12 rounded_div_with_shadow">
                    <span><b>Services</b></span>
                </div>
            </div>

            <div class="row">

                @foreach($objs as $obj)
                <div class="row rounded_div_with_shadow">
                    <div div class="col-md-3">
                        <img
                            class="image"
                            src="{{$obj['image_url']}}"
                            alt="Image 1">
                    </div>
                    <div div class="col-md-7">
                            <h5 class="mt-0">{{$obj['name']}}
                            <h5 class="mt-0">{{$obj['description']}}

                    </div>

                    <div div class="col-md-2">
                        <a class="link_button" href="/service_detail/{{$obj['id']}}">Detail</a>
                    </div>


                </div>
                @endforeach
            </div>
            <!--End dynamic objs content-->
    </section>


@stop

@section('page_script')

@stop

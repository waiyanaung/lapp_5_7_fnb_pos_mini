@extends('layouts_frontend.master_frontend')
@section('title','Service')
@section('content')
        <div class="header_id div_under_header_menu"></div>
        </div>
    </div>

    </section>

    <section>

        <div class="container"><!--Start class container -->

            <div class="row rounded_div_with_shadow"><!--Start class row 1 -->
                <div class="col-md-12">
                    <span><b>Frequently asked questions</b></span>
                </div>
            </div><!--End class row 1-->

                @foreach($objs as $obj)
                <!-- <div class="row rounded_div_with_shadow">   
                    <div class="col-md-3">
                        <img
                            class="image"
                            src="{{$obj['image_url']}}"
                            alt="Image 1">
                    </div>
                    <div class="col-md-7">
                            <p>{{$obj['name']}}</p>
                            <p>{{$obj['description']}}</p>

                    </div>

                    <div class="col-md-2">
                        <a class="link_button" href="/service_detail/{{$obj['id']}}">Detail</a>
                    </div>

                </div> -->

                <div class="row rounded_div_with_shadow">
                    <div class="col-md-12">
                        <div class="div_with_bottom_line">
                            {!! $obj['name'] !!}
                        </div>
                       <div class="div_with_top_padding">
                           {!! $obj['detail_info'] !!}
                        </div>

                    </div>

                </div>
                @endforeach
        
        </div><!--End class container -->
        
    </section>


@stop

@section('page_script')

@stop

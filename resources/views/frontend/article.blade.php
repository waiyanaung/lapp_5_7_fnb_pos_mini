@extends('layouts_frontend.master_frontend')
@section('title','Article')
@section('content')



<div class="container">
    {{-- <div class="row rounded_div_with_shadow">
                <div div class="col-md-12">
                    <span><b>Articles</b></span>
                </div>
            </div> --}}

    <!--Start dynamic objs content-->
    <!--$counter is to create a row for every three elements-->
    <?php $counter = 0; ?>
    <div class="row rounded_div_with_shadow">
        @foreach($objs as $obj)
        <!--If elements are up to 3, they will be in the same row-->
        @if($counter <3) <!--Plus 1 to counter for each element rendered-->
            <?php $counter++; ?>
            <div class="col-md-4">
                <a class="no_underline_link" href="/article_detail/{{$obj['id']}}">
                    <div>
                        <h6>{{$obj['name']}}</h6>
                    </div>
                    <div class="gallery_image_div" style="background-image: url({{$obj['image_url']}})">
                    </div>
                </a>
            </div>
            @else
            <!--For the fourth element, reset the counter to 0 and close the current row-->
    </div>
    <?php $counter = 0; ?>
    <!--And open another row-->
    <div class="row rounded_div_with_shadow">
        <!--Plus 1 to counter for each element rendered-->
        <?php $counter++; ?>
        <div class="col-md-4">
            <a class="no_underline_link" href="/article_detail/{{$obj['id']}}">
                <div>
                    <h6>{{$obj['name']}}</h6>
                </div>
                <div class="gallery_image_div" style="background-image: url({{$obj['image_url']}})">
                </div>
            </a>
        </div>
        @endif
        @endforeach
        <!--render close tag for the last row-->
    </div>
    <!--End dynamic objs content-->

    {{--<a href="#" class="link">more >> </a>--}}
</div><!-- /.container -->

@stop

@section('page_script')

@stop
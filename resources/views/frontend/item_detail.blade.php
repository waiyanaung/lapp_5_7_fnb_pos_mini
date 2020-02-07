<?php
use App\Core\Check as Check;
?>
@extends('layouts_frontend.master_frontend')
@section('title','Item Detail')
@section('content')


    <div class="container" ">
        <div class="row rounded_div_with_shadow">
            <div div class="col-md-12">
                <span><b>{{$obj->name}}</b></span>
            </div>
        </div>


        <div class="row rounded_div_with_shadow">
            <div class="col-md-12">
                <b>Name : </b>{{$obj->name}}</br>
                <b>Model : </b>{{$obj->model}}</br>
                <b>Brand : </b>{{$brands[$obj['brand_id']]->name}}</br>                

                <b>Category : </b>{{$categories[$obj['category_id']]->name}}</br>
                <b>Made in : </b>{{$countries[$obj['country_id']]->name}}</br>
                <b>Price : </b>{{$obj['price']}} ( MMK )</br>
            </div>
        </div>
        
        <div class="row rounded_div_with_shadow">
            <div class="col-md-12">
                <b>Detail Features</b></br>
                {!! $obj->custom_features !!}
            </div>
        </div>
        
        {!! Form::open(array('url' => '/order', 'class'=> 'form-horizontal', 'id'=>'registration', 'class' =>'frm_wrap'))
        !!}

        <div class="row rounded_div_with_shadow">

            <div class="col-md-12">
                <b>Order This Item - <span>{{$obj->name}}</span></b></br>
                <hr><br>
            </div>
            
            <div class="col-md-4">
                Air-Con Quantity *</br>
                <input required type="number" min="1" step="1" class="form-control" id="qty" name="qty" placeholder="1"
                    value="1">
                <input type="hidden" id="item_id" name="item_id" value="{{$obj->id}}">
                <b><label id="error_qty" class="text-danger">{{$errors->first('qty')}}</label></b>
            </div>

            <div class="col-md-4">
                Add Installation *</br>
                <select class="form-control" id="add_installation" name="add_installation">
                    <option value="0" selected>Do not add installation</option>
                    <option id="error_add_installation" value="1" selected>Add installation</option>
                </select>
            </div>

            <div class="col-md-4">
                Order Person's Name *</br>
                <input required type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                <b><label id="error_name" class="text-danger">{{$errors->first('name')}}</label></b>
            </div>

            <div class="col-md-4">
                Order Person's Phone *</br>
                <input required type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone No." required>
                <b><label  id="error_phone" class="text-danger">{{$errors->first('phone')}}</label></b>
            </div>

            {{-- <div class="col-md-4">
                Order Person's Township *</br>
                <input required type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone No.">
                <label class="text-danger">{{$errors->first('phone')}}</label>
            </div>

            <div class="col-md-4">
                Order Person's Address</br>
                <input required type="text" class="form-control" id="address" name="address" placeholder="Your Address">
                <label class="text-danger">{{$errors->first('phone')}}</label>
            </div>

            <div class="col-md-8">
                Remark</br>
                <input required type="text" class="form-control" id="remark_customer" name="remark_customer" placeholder="Your Remark">
                <label class="text-danger">{{$errors->first('phone')}}</label>
            </div> --}}

            <div class="col-md-4">
                <br>
                <button type="button" id="btn_submit" class="btn btn-secondary form-control">Order Now</button>
            </div>
        </div>
        {!! Form::close() !!}
        

        <div class="row rounded_div_with_shadow">
            <div class="col-md-12">
                <p><b>Gallery</b></p>
                <div id="jssor_main" class="slider_one_for_shop_image_slider">
                    <div data-u="slides" class="slider_images_for_shop_image_slider">

                        <?php 
                                if(strcmp($obj['image_url'],"/images/item/")){
                                    $img_src = $obj['image_url'];
                                }
                                else{
                                    $img_src = '/images/default/ac.jpg';
                                }
                                
                                
                                if(strcmp($obj['image_url1'],"/images/item/")){
                                    $img_src1 = $obj['image_url1'];
                                }
                                else{
                                    $img_src1 = '/images/default/ac.jpg';
                                }
                                ?>

                        <div>
                            <img data-u="image" src="{{$img_src}}" />
                        </div>
                        <div>
                            <img data-u="image" src="{{$img_src1}}" />
                        </div>
                    </div>

                    <!-- Thumbnail Navigator -->
                    <div data-u="thumbnavigator" class="jssort01"
                        style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
                        <!-- Thumbnail Item Skin Begin -->
                        <div data-u="slides">
                            <div data-u="prototype" class="p">
                                <div class="w">
                                    <div data-u="thumbnailtemplate" class="t"></div>
                                </div>
                                <div class="c"></div>
                            </div>
                        </div>
                        <!-- Thumbnail Item Skin End -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->



           
        </div>

    </div>
<!-- Optional JavaScript -->

@stop

@section('page_script')

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {

             var numslider   = $('.slider_two').length;
            //jssor slider init functions
            jssor_main_slider_init();

            $("#btn_submit").on("click", function (){ 
                
                var qty = $("#qty").val();
                var name = $("#name").val();
                var phone = $("#phone").val();

                $("#error_qty").html("");
                $("#error_name").html("");
                $("#error_phone").html("");

                if(qty != "" && name != "" && phone != ""){

                    swal({
                        title: "Are you sure?",
                        text: "Are you sure want to add these items into your cart ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            // swal("Poof! Your imaginary file has been deleted!", {
                            // icon: "success",
                            // });
                            $('#registration').submit();
                        } else {
                            return 0;
                        }
                        });

                }
                else{
                    if(qty == ""){
                        $("#error_qty").html("* Quantity is required !");
                    }

                    if(name == ""){
                        $("#error_name").html("* Name is required !");
                    }

                    if(phone == ""){
                        $("#error_phone").html("* Phone is required !");
                    }

                }

            });

            
        });

    jssor_main_slider_init = function() {

            var jssor_main_SlideshowTransitions = [
                {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_main_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_main_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Cols: 10,
                    $SpacingX: 8,
                    $SpacingY: 8,
                    $Align: 360
                }
            };

            var jssor_main_slider = new $JssorSlider$("jssor_main", jssor_main_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_main_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1070);
                    jssor_main_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };

    
</script>

@stop
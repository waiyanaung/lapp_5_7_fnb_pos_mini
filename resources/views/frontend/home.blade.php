@extends('layouts_frontend.master_frontend')
@section('title','About Us')
@section('content')

<style>
.carousel-inner>.item img {
  
    width: 100%;
    max-height: 500px;
    margin: auto;
}

.carousel-control.left,
.carousel-control.right {
    background-image: none
}

.imgfit {
  /* object-fit: contain; */
  object-fit: cover;

  /* width: 300px;
  height: 337px; */
}

.slider_one_for_brand_image_slider {
    position:relative;
    margin:0 auto;
    top:0px;
    left:0px;
    width:800px;
    /* height:550px; */
    height:450px;
    overflow:hidden;
    visibility:hidden;
    background-color:rgb(238, 212, 212);"
}

.slider_images_for_brand_image_slider {
    cursor:default;
    position:relative;
    top:0px;
    left:0px;
    width:800px;
    height:450px;
    overflow:hidden;";
}

.slider_images {
    border: 1px solid blue;
}

.slider_nagivator_images {    
    left:10px;
    border: 1px solid blue;
}


#myModal {
    z-index: 1500;
}

.modal-dialog {
  top: calc(10% - 200px); 
}


#myModal2 {
    z-index: 1500;
}

</style>

</section>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    {{-- Calculating for the slider navigators --}}
    <ol class="carousel-indicators">

        <?php 
        $active_navigator = 0;
        $active_slide = 0;
        ?>

        @if(isset($brands) && count($brands) > 0)        
        
            @foreach($brands as $brand)
                <?php
                    if($active_navigator == 0){
                        $active_flag_navigator = 'active';
                    }
                    else{
                        $active_flag_navigator = '';
                    }
                        
                ?>

                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $active_navigator }}" class="<?php echo $active_flag_navigator; ?>"></li>
                <?php $active_navigator++; ?>
                
            @endforeach
        @else
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        @endif
    </ol>

    <div class="carousel-inner">

        @if(isset($brands) && count($brands) > 0)

                @foreach($brands as $brand)
                    <?php
                        if($active_slide == 0){
                            $active_flag = 'active';
                        }
                        else{
                            $active_flag = '';
                        }                            
                    
                        if(strcmp($brand['image_url'],"/images/brand/")){
                            $img_src = $brand['image_url'];
                        }
                        else{
                            $img_src = '/images/default/default_image.jpg';
                        }
                        ?>

                        <div class="carousel-item item <?php echo $active_flag; ?>">
                            <img class="d-block w-100 imgfit" src="{{ $img_src }}" alt="{{ $brand->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $brand->name }}</h5>
                                <p>{{ $brand->description }}</p>
                            </div>
                        </div>

                    <?php $active_slide++; ?>
                    
                @endforeach
            @else
            
                <div class="carousel-item active">
                    <div class="fill"><img class="imgfit" src="/images/default/default_image.jpg"></div>
                    <div class="carousel-caption">
                        <h1 class="container">Slider 1 Title</h1>
                        <p class="container">This is slider 1</p>
                    </div>
                </div>
                <div class="carousel-item item">
                    <div class="fill"><img class="imgfit" src="/images/default/default_image.jpg"></div>
                    <div class="carousel-caption">
                        <h1 class="container">Slider 2 Title</h1>
                        <p class="container">This is slider 2</p>
                    </div>
                </div>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/images/default/default_image.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>My Caption Title (1st Image)</h5>
                        <p>The whole caption will only show up if the screen is at least medium size.</p>
                    </div>
                </div>

            @endif

        
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section>
    <div class="container">

        <div class="row rounded_div_with_shadow6"> <!-- /. start 3rd row -->

            <div class="col-md-6">
                <a class="form-control btn link_button4" href="/coming">view service Detail</a>
            </div>

            <div class="col-md-6">
                {{-- <a class="form-control btn link_button2" href="/coming">view Repair Detail</a> --}}
                <button type="button" class="form-control btn link_button4" data-toggle="modal" data-target="#myModal">View Service Detail</button>
            </div>

            <div class="col-md-6">
                {{-- <a class="form-control btn link_button2" href="/coming">view Service Detail</a>                     --}}
                <button type="button" class="form-control btn link_button4" data-toggle="modal" data-target="#myModal2">View Service Detail</button>
            </div>

            <div class="col-md-6">
                <a class="form-control btn link_button4" href="/coming">view Service Detail</a>
            </div>

        </div><!-- /. start 3rd row -->

       
        @include('frontend.check_hp')
        
    </div><!-- /.container -->
</section>


 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <button type="button" class="btn link_button4 pull-right" data-dismiss="modal">Close</button>
              <h4 class="modal-title"><b>Service Contact Information</b></h4>
            </div>
            <div class="modal-body">
    
                <div class="row rounded_div_with_shadow6"> <!-- /. start 3rd row -->
                    
                    <div class="col-md-12"> 

                        Phone: 09 4200 88 636 <br>

                        Hot Line: 09 4200 88 636 <br>

                        Email: waiyan.office@gmail.com <br>
                        
                    </div>
                
                </div><!-- /. start 3rd row -->
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn link_button4" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
</div>
 <!-- Modal -->

 <!-- Modal -->
 <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <button type="button" class="btn link_button4 pull-right" data-dismiss="modal">Close</button>
              <h4 class="modal-title"><b>Service Contact Information</b></h4>
            </div>
            <div class="modal-body">
    
                <div class="row rounded_div_with_shadow6"> <!-- /. start 3rd row -->
                    
                    <div class="col-md-12"> 

                        Phone: 09 4200 88636 <br>

                        Hot Line: 09 4200 88636 <br>

                        Email: waiyan@gmail.com <br>
                        
                    </div>
                
                </div><!-- /. start 3rd row -->
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn link_button4" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
</div>
 <!-- Modal -->


@stop

@section('page_script')
    <script>
        $(document).ready(function() {            
            $('.carousel').carousel({
                interval: 2000
                })
        });
    </script>
@stop



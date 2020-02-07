@extends('layouts_frontend.master_frontend')
@section('title','Service')
@section('content')
            <div class="header_id div_under_header_menu"></div>
            </div>
        </div>
    </section>

    <section>
        
    <div class="container">
            <div class="row rounded_div_with_shadow">
                <div div class="col-md-12">
                    <span><b>Service - {{$obj['name']}}</b></span>
                </div>
            </div>

            <!-- Start class='row' One -->
            <div class="row rounded_div_with_shadow">
                </br>
                <div class="col-md-4">
                    <div id="img_{{$obj['id']}}" onclick="showImageModal(this.id)"  class="gallery_image_div img-responsive img-hover adjust-img-height" style="background-image: url({{$obj['image_url']}})">
                    </div>
                </div>

                <div class="col-md-8">
                    <p>
                    {{$obj['detail_info']}}
                    </p>
                </div>
            </div>
              
        </div><!-- /.container -->
    </section><!-- /.section -->

    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span id="modal_close_btn" class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="modal_show_image">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>

@stop

@section('page_script')
<script>
$(document).ready(function(){
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("modal_show_image");
    var captionText = document.getElementById("caption");

    // img.onclick = function(){
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    //     captionText.innerHTML = this.alt;
    // }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
        modal.style.display = "none";
    }
});

$(document).keydown(function(event) { 
    if (event.keyCode == 27) { 
        $('#myModal').hide();
    }
});

function showImageModal(img_id){
    var modal = document.getElementById('myModal');
    var img = document.getElementById(img_id);
    var modalImg = document.getElementById("modal_show_image");
    var captionText = document.getElementById("caption");
    //var img_src = document.getElementById(img_id).src;
    var img_src_raw = document.getElementById(img_id).style.backgroundImage;
    var img_src = img_src_raw.replace(/(url\(|\)|")/g, '');;
    var img_alt = document.getElementById(img_id).alt;
    console.log(img_src);
    modal.style.display = "block";
    modalImg.src = img_src;
    captionText.innerHTML = img_alt;
}
</script>
@stop

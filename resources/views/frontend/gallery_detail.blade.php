@extends('layouts_frontend.master_frontend')
@section('title','Gallery')
@section('content')

<div class="container">
    <div class="row rounded_div_with_shadow">
        <div div class="col-md-12">
            <span><b>Album - {{$obj_gallery['name']}}</b></span>
        </div>
    </div>

    <!--Start dynamic objs content-->
    <!--$counter is to create a row for every three elements-->
    <?php $counter = 0; 
            ?>
    <div class="rounded_div_with_shadow">
        <div class="row">
            @foreach($objs_galleryimages as $obj)
            <!--If elements are up to 3, they will be in the same row-->
            @if($counter <3) <!--Plus 1 to counter for each element rendered-->
                <?php $counter++; ?>
                <div class="col-md-4">
                    <div>
                        <h5>{{$obj['name']}}</h5>
                    </div>
                    <div id="img_{{$obj['id']}}" onclick="showImageModal(this.id)"
                        class="gallery_image_div img-responsive img-hover adjust-img-height"
                        style="background-image: url({{$obj['image_url']}})">
                    </div>
                </div>
                @else
                <!--For the fourth element, reset the counter to 0 and close the current row-->
        </div>
        <?php $counter = 0; ?>
        <!--And open another row-->
        <div class="row">
            <!--Plus 1 to counter for each element rendered-->
            <?php $counter++; ?>
            <div class="col-md-4">
                <div>
                    <h5>{{$obj['name']}}</h5>
                </div>
                <div id="img_{{$obj['id']}}" onclick="showImageModal(this.id)"
                    class="gallery_image_div img-responsive img-hover adjust-img-height"
                    style="background-image: url({{$obj['image_url']}})">
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <!--render close tag for the last row-->


    </div><!-- /.container -->

    <!-- <img id="myImg" src="img_snow.jpg" alt="Snow" style="width:100%;max-width:300px"> -->
    <!-- The Modal -->
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
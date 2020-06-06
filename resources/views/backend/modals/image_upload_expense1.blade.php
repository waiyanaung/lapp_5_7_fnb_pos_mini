<!-- ============================================================== -->
<!-- Start Modal for the image upload  -->
<!-- ============================================================== -->

<div class="modal fade" id="Modal_image_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="/backend/matrix_admin/assets/images/img5.jpg" width="100% ">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <div class="modal fade" id="modal-image1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload item image,</h4>
                    <p>Please ensure file is in .jpg, .png, .gif format.</p>
                </div>

                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 380px; height: 220px;">
                                <img id='image_urlPopUp1' src="{{ isset($obj)? $obj->image_url1:Request::old('image_url1') }}" alt="Load Image"/>
                            </div>
                            <div data-provides="fileinput">
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new" data-trigger="fileinput">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            <input id="image_url1" type="file" name="image_url1" accept="image.*" />
                            {{--{{ Form::file('nric_front_img') }}--}}
                        </span>
                                {{--<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>--}}
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="changeItemImage1()" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-image1-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Remove Image !</h4>
                    <p>Please ensure you want to remove this image .</p>
                </div>

                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        Are you sure want to remove this image ?
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="removeIMG()" class="btn btn-default" data-dismiss="modal">Yes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="image_error_fileFormat1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label class="font-big-red">You can only upload a .jpg / jpeg / png / gif file format.</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image_error_fileSize1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label class="font-big-red">This is not an allowed file size !</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
<!-- ============================================================== -->
<!-- End Modal for the image upload  -->
<!-- ============================================================== -->

<script type="text/javascript">
    $(document).ready(function() {

    $(".add_image_div1").click(function(){
        showPopup1();
    });

    $("#removeImage1").click(function(){
        $('#modal-image1-remove').modal();
    });

    $('INPUT[type="file"]').change(function () {

        var ext = this.value.match(/\.(.+)$/)[1];
        var f=this.files[0];
        var fileSize = (f.size||f.fileSize);
        var imgkbytes = Math.round(parseInt(fileSize)/1024);

        if(imgkbytes > 5000){
            $('#image_error_fileSize1').modal('show');
            $('#image_urlPopUp1').attr('src') = '';
        }
        // else{
        switch (ext) {
            case 'jpg':
            case 'JPG':
            case 'jpeg':
            case 'png':
            case 'PNG':
            case 'gif':
                break;
            default:
                $('#image_error_fileFormat1').modal('show');
                $('#image_urlPopUp1').attr('src') = '';
        }
        //}

    });
    });

    function saveConfig(action) {
        var errorCount = 0;
        if(errorCount>0) {
            return;
        }
        else{
            $("#backend_posconfigs").submit();
        }
    }

    function showPopup1() {
        $('#modal-image1').modal();
    }

    function changeItemImage1(){
        var images = $('#modal-image1 img').attr('src');
        $('.add_image_div1').css('background-image', 'url(' + images + ')');
        $('#removeImageFlag1').val(0);
    }

    function removeIMG(){
        $('#modal-image1 img').attr('src','second.jpg');
        $('.add_image_div1').css('background-image', 'url()');
        $('#removeImageFlag1').val(1);
    }   
</script>
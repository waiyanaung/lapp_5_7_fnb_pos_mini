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

 <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <img id='site_logoPopUp' src="{{ $configs['SETTING_LOGO'] }}" alt="Load Image"/>
                            </div>
                            <div data-provides="fileinput">
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new" data-trigger="fileinput">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            <input id="site_logo" type="file" name="site_logo" accept="image.*" />
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
                    <button type="button" onclick="changeItemImage()" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-image-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="image_error_fileFormat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="image_error_fileSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    $(".add_image_div").click(function(){
        showPopup();
    });

    $("#removeImage").click(function(){
        $('#modal-image-remove').modal();
    });

    $('INPUT[type="file"]').change(function () {

        var ext = this.value.match(/\.(.+)$/)[1];
        var f=this.files[0];
        var fileSize = (f.size||f.fileSize);
        var imgkbytes = Math.round(parseInt(fileSize)/1024);

        if(imgkbytes > 5000){
            $('#image_error_fileSize').modal('show');
            $('#site_logoPopUp').attr('src') = '';
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
                $('#image_error_fileFormat').modal('show');
                $('#site_logoPopUp').attr('src') = '';
        }
        //}

    });
    });

    function saveConfig(action) {
        var rate = $("#SETTING_TAXRATE").val();
        $("#error_lbl_SETTING_TAXRATE").text("");
        var errorCount = 0;
        if(isNaN(rate)){
            $("#error_lbl_SETTING_TAXRATE").text("Invalid Tax Rate !. It allow Number only !");
            errorCount++;
        }

        if(errorCount>0) {
            return;
        }
        else{
            $("#backend_posconfigs").submit();
        }
    }

    function showPopup() {
        $('#modal-image').modal();
    }

    function changeItemImage(){
        var images = $('#modal-image img').attr('src');console.log(images);
        $('.add_image_div').css('background-image', 'url(' + images + ')');
        $('#removeImageFlag').val(0);
    }

    function removeIMG(){
        $('#modal-image img').attr('src','second.jpg');
        $('.add_image_div').css('background-image', 'url()');
        $('#removeImageFlag').val(1);
    }   
</script>
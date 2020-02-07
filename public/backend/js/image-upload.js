 $(document).ready(function() {

        $(".add_image_div").click(function(){
            showPopup();
        });

        $("#removeImage").click(function(){
            $('#modal-image-remove').modal();
        });

        $(".add_image_div1").click(function(){
            showPopup();
        });

        $("#removeImage1").click(function(){
            $('#modal-image-remove1').modal();
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
                case 'jpeg':
                case 'png':
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
        var images = $('#modal-image img').attr('src');
        $('.add_image_div').css('background-image', 'url(' + images + ')');
        $('#removeImageFlag').val(0);
    }

    function removeIMG(){
        $('#modal-image img').attr('src','second.jpg');
        $('.add_image_div').css('background-image', 'url()');
        $('#removeImageFlag').val(1);
    }

    function showPopup1() {
        $('#modal-image1').modal();
    }

    function changeItemImage1(){
        var images = $('#modal-image1 img').attr('src');
        $('.add_image_div1').css('background-image', 'url(' + images + ')');
        $('#removeImageFlag1').val(0);
    }

    function removeIMG1(){
        $('#modal-image1 img').attr('src','second.jpg');
        $('.add_image_div1').css('background-image', 'url()');
        $('#removeImageFlag1').val(1);
    }
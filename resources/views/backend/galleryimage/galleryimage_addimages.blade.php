@extends('layouts.master')
@section('title','galleryimage')
@section('content')

 <!-- CSS and JS Files for the Multiple File upload with ajax and bootstraps - Start  -->
<link href="/backend/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" rel="stylesheet">
<script src="/backend/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"></script>
<script src="/backend/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"></script>
 <!-- CSS and JS Files for the Multiple File upload with ajax and bootstraps - End  -->

<style type="text/css">
    /* CSS for the Ajax multiple file upload - Start */
    .main-sections{
        margin:0 auto;
        padding: 20px;
        margin-top: 100px;
        background-color: #fff;
        box-shadow: 0px 0px 20px #c1c1c1;
    }

    .fileinput-remove,
    .fileinput-upload{

        display: none;

    }
    /* CSS for the Ajax multiple file upload - End */
</style>
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj_gallery))
                    Album Images - Create

                @else
                    Album Images - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">galleryimage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @if(isset($obj_gallery))
        {!! Form::open(array('url' => '/backend_app/galleryimage/update','id'=>'galleryimage', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/galleryimage/store','id'=>'galleryimage', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($obj_gallery)? $obj_gallery->id:''}}"/>
    <input type="hidden" name="gallery_id" value="{{isset($obj_gallery)? $obj_gallery->id:''}}"/>   

    <div class="card">
        <div class="card-body">            
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Selected Album Name</h5>
                    <div class="form-group m-t-20">
                        <input readonly type="text" class="form-control" name="name" id="name" placeholder="Enter galleryimage Name"  value="{{ isset($obj_gallery)? $obj_gallery->name:Request::old('name') }}" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>                

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Selected Album Code</h5>
                    <div class="form-group m-t-20">
                        <input readonly type="text" class="form-control" id="code" name="code" placeholder="galleryimage Code" value="{{ isset($obj_gallery)? $obj_gallery->code:Request::old('code') }}"/>
                <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Selected Album Status</h5>
                    <div class="form-group m-t-20">
                    <input type="text" readonly class="form-control" name="status" id="status"                    
                        @if(isset($obj_gallery))
                            @if($obj_gallery->status == 1)
                                value='Active'>
                            @else
                            value='In-Active'>
                            @endif
                        @else
                            value='Active'>
                        @endif

                        <p class="text-danger">{{$errors->first('status')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->
        </div>
    </div>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Album Images
                </h4>
            </div>
        </div>
    </div>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">                    
                    <button onclick="cancel_setup('gallery')" type="button" class="btn btn-secondary btn-md">Done and Close</button>
                </div>
            </div>                     
        </div>
    </div>

    <div class="card">
        <div class="card-body">

           <!--Start div class row One -->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center text-primary">Multiple Images Upload Panel</h4><br>
                    <div class="form-group">
                        <div class="file-loading">
                            <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                        </div>
                    </div>

                </div>
            </div>
            <!--End div class row One -->
            
        </div>        
    </div>

    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button onclick="cancel_setup('gallery')" type="button" class="btn btn-secondary btn-md">Done and Close</button>
                </div>
            </div>                     
        </div>
    </div>
    @include('backend.modals.image_upload_galleryimage')    
    {!! Form::close() !!}
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer')
<script type="text/javascript">
// JS for the Ajax multiple file upload - Start 
 $("#file-1").fileinput({
    theme: 'fa',
    uploadUrl: "/backend_app/galleryimage/store",
    uploadExtraData: function() {
        return {
            _token: $("input[name='_token']").val(),
            gallery_id: $("input[name='gallery_id']").val(),
        };
    },
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
    maxFileSize:2000,
    maxFilesNum: 10,
    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});
// JS for the Ajax multiple file upload - Start 

</script>
@stop
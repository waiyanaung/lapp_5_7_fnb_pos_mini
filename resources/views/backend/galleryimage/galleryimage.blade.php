@extends('layouts.master')
@section('title','galleryimage')
@section('content')

<style>
.add,.remove{
    border: 1px solid black;
    padding: 2px 10px;
}

.add:hover,.remove:hover{
    cursor: pointer;
}
</style>
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj_gallery))
                    Album Images - Edit

                @else
                    Album Images - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <a href="/backend_app/galleryimage/add/{{isset($obj_gallery)? $obj_gallery->id:'0'}}" class="btn btn-primary btn-md">Add Images</a>
                    <button type="submit" class="btn btn-danger btn-md">
                        @if(isset($obj_gallery))
                            Remove Images

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('gallery')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>

    <div class="card">
        <div class="card-body">

           <!--Start dynamic objs content-->
            <!--$counter is to create a row for every three elements-->
            <?php $counter = 0; ?>
            <div class="row">
            @if(isset($objs_galleryimages) && count($objs_galleryimages)>0)
                @foreach($objs_galleryimages as $obj)
                    <!--If elements are up to 3, they will be in the same row-->
                    @if($counter <3)
                        <!--Plus 1 to counter for each element rendered-->
                        <?php $counter++; ?>
                        <div class="col-md-4">
                            <a class="no_underline_link">
                                <div>
                                    <input type="checkbox" name="gallery_image_id[{{$obj['id']}}]">  <b>{{$obj['name']}}</b>
                                </div>
                                <div class="form-group m-t-20">
                                    <div class="gallery_image_div" style="background-image: url({{$obj['image_url']}})">
                                    </div>
                                </div>
                            </a>
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
                            <a class="no_underline_link">
                                <div>
                                    <input type="checkbox" name="gallery_image_id[{{$obj['id']}}]">  <b>{{$obj['name']}}</b>
                                </div>
                                <div class="form-group m-t-20">
                                    <div class="gallery_image_div" style="background-image: url({{$obj['image_url']}})">
                                    </div>
                                </div>
                            </a>
                        </div>
                @endif
                @endforeach
            <!--render close tag for the last row-->
            @else
                <div class="col-md-4">
                    <h5> There is no image for your albumn !
                </div>
            @endif

            </div>
            <!--End dynamic objs content-->
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                <a href="/backend_app/galleryimage/add/{{isset($obj_gallery)? $obj_gallery->id:'0'}}" class="btn btn-primary btn-md">Add Images</a>
                    <button type="submit" class="btn btn-danger btn-md">
                        @if(isset($obj_gallery))
                            Remove Images

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('gallery')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
</script>
@stop
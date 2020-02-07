@extends('layouts.master')
@section('title','Service')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))
                    Service - Edit

                @else
                    Service - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service</li>
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
    @if(isset($obj))
        {!! Form::open(array('url' => '/backend_app/service/update','id'=>'service', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/service/store','id'=>'service', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($obj))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('service')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Service Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Service Name"  value="{{ isset($obj)? $obj->name:Request::old('name') }}" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>                

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Service Code</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Service Code" value="{{ isset($obj)? $obj->code:Request::old('code') }}"/>
                <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Status</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="status" id="status">                    
                        @if(isset($obj))
                            @if($obj->status == 1)
                                <option value="1" selected>Active</option>
                                <option value="0"> In-active</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected> In-active</option>
                            @endif
                        @else
                            <option value="1" selected>Active</option>
                            <option value="0"> In-active</option>
                        @endif
                            
                    </select>
                        <p class="text-danger">{{$errors->first('status')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Two -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Service Fee</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="price" id="name" placeholder="Enter Service Fee"  value="{{ isset($obj)? $obj->price:Request::old('price') }}">
                        <p class="text-danger">{{$errors->first('price')}}</p>
                    </div>
                </div>

                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Service Description</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="description" id="name" placeholder="Enter Service Description"  value="{{ isset($obj)? $obj->description:Request::old('description') }}">
                        <p class="text-danger">{{$errors->first('description')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' Two -->

            <!-- Start class='row' Three -->
            <div class="row">  

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Service Image</h5>
                    <div class="form-group m-t-20">
                        <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($obj)? $obj->image_url:Request::old('image_url') }});">
                        </div>
                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                        <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
                    </div>
                </div>

                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Detail Information</h5>
                    <div class="form-group m-t-20">
                        <textarea rows="10" cols="50" class="form-control" name="detail_info" id="detail_info" placeholder="Enter Service Detail Information">{{ isset($obj)? $obj->detail_info:Request::old('detail_info') }}</textarea>
                        <p class="text-danger">{{$errors->first('detail_info')}}</p>
                    </div>
                </div>
                
            </div>
            <!-- End class='row' Three -->
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($obj))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('service')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>
    @include('backend.modals.image_upload_service')    
    {!! Form::close() !!}
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer') 
<script type="text/javascript">
$(document).ready(function() {
        
        //Start Validation for Entry and Edit Form
        $('#service').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Service Name is required',
            },
            submitHandler: function(form) {
                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }
        });
        //End Validation for Entry and Edit Form

    });
</script>
@stop
@extends('layouts.master')
@section('title','Configs')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                    Configs - Module        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Configs</li>
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
   
    {!! Form::open(array('url' => '/backend_app/config','id'=>'config', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        Update
                    </button>
                    <button onclick="cancel_setup('config')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Site Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="SETTING_COMPANY_NAME" id="SETTING_COMPANY_NAME" placeholder="Enter Configs Name"  value="{{ isset($configs)? $configs['SETTING_COMPANY_NAME']:Request::old('SETTING_COMPANY_NAME') }}" required>
                        <p class="text-danger">{{$errors->first('SETTING_COMPANY_NAME')}}</p>
                    </div>
                </div>


                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Site Admin Emails (eg. admin1@gmail.com,admin2@gmail.com )</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="SETTING_ADMIN_EMAILS" id="SETTING_ADMIN_EMAILS" placeholder="Enter Configs Name"  value="{{ isset($configs)? $configs['SETTING_ADMIN_EMAILS']:Request::old('SETTING_ADMIN_EMAILS') }}">
                        <p class="text-danger">{{$errors->first('SETTING_ADMIN_EMAILS')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Two -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Site Logo</h5>
                    <div class="form-group m-t-20">
                        <div class="add_image_div add_image_div_red" style="background-image: url({{ $configs['SETTING_LOGO'] }});">
                        </div>
                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                        <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
                    </div>
                </div>
            </div>
            <!-- End class='row' Two -->
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                       Update
                    </button>
                    <button onclick="cancel_setup('config')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>    
    
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@include('backend.modals.image_upload_config')
    
{!! Form::close() !!}
@stop
@section('page_script_footer') 

@stop
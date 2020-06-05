@extends('layouts.master')
@section('title','Project')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($project))
                    Project - Edit

                @else
                    Project - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Project</li>
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
    @if(isset($project))
        {!! Form::open(array('url' => '/backend_app/project/update','id'=>'project', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/project/store','id'=>'project', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($project)? $project->id:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md">
                        @if(isset($project))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('project')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Project Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Project Name"  value="" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Project Code</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="code" name="code" placeholder="" value=""/>
                    <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Project Description</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="description" name="description" placeholder="" value=""/>
                    <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md">
                        @if(isset($project))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('project')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>    
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
        $('#project').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Project Name is required',
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
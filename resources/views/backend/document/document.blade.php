@extends('layouts.master')
@section('title','Document')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($document))
                    Document - Edit

                @else
                    Document - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Document</li>
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
    @if(isset($document))
        {!! Form::open(array('url' => '/backend_app/document/update','id'=>'document', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/document/store','id'=>'document', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($document)? $document->id:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md">
                        @if(isset($document))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('document')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Document Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Document Name"  value="" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Document Code</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="code" name="code" placeholder="" value=""/>
                    <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Document Description</h5>
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
                        @if(isset($document))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('document')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
        $('#document').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Document Name is required',
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
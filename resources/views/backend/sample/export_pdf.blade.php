@extends('layouts.master')
@section('title','Country')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-countrys-center">
            <h4 class="page-title">
                PDF Export Sample                       
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-country"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-country active" aria-current="page">PDF Export Sample</li>
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

        

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button onclick="cancel_setup('country')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Sample PDF</h5><br>
                </div>
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' One -->
            <div class="row">  
                
                <div class="col-md-4">
                    {!! Form::open(array('url' => '/backend_app/sample/pdf1','id'=>'pdf_export')) !!}
                    <button type="submit" class="btn btn-primary btn-md form-control">Export PDF 1</button>
                    {!! Form::close() !!}
                </div>


                <div class="col-md-4">
                    {!! Form::open(array('url' => '/backend_app/sample/pdf2','id'=>'pdf_export')) !!}
                    <button type="submit" class="btn btn-primary btn-md form-control">Export PDF 2</button>
                    {!! Form::close() !!}
                </div>

                <div class="col-md-4">
                    {!! Form::open(array('url' => '/backend_app/sample/pdf3','id'=>'pdf_export')) !!}
                    <button type="submit" class="btn btn-primary btn-md form-control">Export PDF 3</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- End class='row' One -->
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button onclick="cancel_setup('country')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer') 
<script type="text/javascript">
$(document).ready(function() {
        
        //Start Validation for Entry and Edit Form
        $('#pdf_export').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Country Name is required',
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
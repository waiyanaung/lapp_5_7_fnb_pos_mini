@extends('layouts.master')
@section('title','FAQ Informations')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                    FAQ Informations - Edit        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ Informations</li>
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
    
    {!! Form::open(array('url' => '/backend_app/faq_information','id'=>'faq_information', 'class'=> 'form-horizontal user-form-border')) !!}


    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        Update
                    </button>
                    <button onclick="cancel_setup('')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-12">  
                    <h5 class="card-title m-b-0">About us Text [English]</h5>
                    <div class="form-group m-t-20">
                        <textarea class="form-control text-area" id="description_en" name="description_en" placeholder="Enter FAQ Informations Text in English" rows="5" cols="50">{{ isset($faqInformation)? $faqInformation["description_en"]:Request::old('description_en') }}</textarea>
                    <p class="text-danger">{{$errors->first('description_en')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-12">  
                    <h5 class="card-title m-b-0">About us Text [Japan]</h5>
                    <div class="form-group m-t-20">
                        <textarea class="form-control text-area" id="description_jp" name="description_jp" placeholder="Enter FAQ Informations Text in English" rows="5" cols="50">{{ isset($faqInformation)? $faqInformation["description_jp"]:Request::old('description_jp') }}</textarea>
                    <p class="text-danger">{{$errors->first('description_jp')}}</p>
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
                    <button type="submit" class="btn btn-primary btn-md">
                            Update
                    </button>
                    <button onclick="cancel_setup('faq_information')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
            $('.text-area').summernote({
                height:300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['picture', ['picture']],
                    ['link', ['link']],
                    ['table', ['table']],
                    ['hr', ['hr']],
                    ['codeview', ['codeview']],
                    ['undo', ['undo']],
                    ['redo', ['redo']],
//                ['help', ['help']],
              ],
              placeholder: 'Enter text here...'
            });
        });
</script>
@stop
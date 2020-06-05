@extends('layouts.master')
@section('title','Checklistupload')
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
                @if(isset($checklistupload))
                    Checklistupload - Edit

                @else
                    Checklistupload - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checklistupload</li>
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
    @if(isset($checklistupload))
        {!! Form::open(array('url' => '/backend_app/checklistupload/update','id'=>'checklistupload', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/checklistupload/store','id'=>'checklistupload', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($checklistupload)? $checklistupload['id']:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md">
                        @if(isset($checklistupload))
                            @if($checklistupload['status'] == '1')
                                Inspect
                            @endif

                            @if($checklistupload['status'] == '3')
                                Verify
                            @endif

                            @if($checklistupload['status'] == '5')
                                Update
                            @endif

                        @else
                            Submit
                        @endif
                    </button>
                    <button onclick="cancel_setup('checklistupload')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">

         <!-- "id" => 4,
                "name" => "Checklist 4",
                "document_code" => "Q-004",
                "project_name" => "Project 4",
                "status" => "5",
                "status_string" => "Verified",
                "submitted_by" => "U Mg Mya",
                "inspected_by" => "U Kyaw Kyaw",
                "verified_by" => "U Nyi Nyi",
                "description" => "This is the checklist 4", -->
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Checklist upload Name ^</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Checklist upload Name"  value="" >
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Document Code and Name *</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" disabled selected>Select Document</option>
                        <option value="1">Q-001 / Material Inspection</option>
                        <option value="2">Q-002 / Site Clearing and Rehabilitation</option>
                        <option value="3">Q-003 / Surveying and Setting Out</option>
                    </select>
                    </div>
                </div>

                 <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Location *</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" disabled selected>Select Location</option>
                        <option value="1">Location 1</option>
                        <option value="2">Location 2</option>
                        <option value="3">Location 3</option>
                    </select>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->

            

            <!-- Start class='row' Three -->
            <div class="row">                        
                
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Project Name *</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" disabled selected>Select Project Name</option>
                        <option value="1">Project 1</option>
                        <option value="2">Project 2</option>
                        <option value="3">Project 3</option>
                    </select>
                    </div>
                </div>

                 <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Status *</h5>
                    <div class="form-group m-t-20">

                    @if(isset($checklistupload))
                        @if($checklistupload['status'] == '1')
                            <input type="text" class="form-control" name="status" id="status"  value="Submitted" readonly>
                        @endif

                        @if($checklistupload['status'] == '3')
                            <input type="text" class="form-control" name="status" id="status"  value="Inspected" readonly>
                        @endif

                        @if($checklistupload['status'] == '5')
                            <input type="text" class="form-control" name="status" id="status"  value="Verified" readonly>
                        @endif

                    @else
                        <input type="text" class="form-control" name="name" id="name"  value="New" readonly>
                    @endif

                    
                    </div>
                </div>
            </div>
            <!-- End class='row' Three -->

        <h5 class="card-title m-b-0">Checklist Document Upload URL</h5>

        @if(isset($checklistupload))

            <!-- Start class='duplicate_container' One -->
            <div class="duplicate_container" >
                <div class='duplicate_div_element' id='div_1'>

                    <!-- Start class='row' Three -->
                    <div class="row">                        
                        
                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your checklist document url' id='txt_1' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your remark' id='txt_remark_1' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0"></h5>
                            <div class="form-group m-t-20">
                                <span class="btn btn-secondary btn-md add">Add Checklist Document</span>
                            </div>
                        </div>

                        
                    </div>
                    <!-- End class='row' Three -->

                    <!-- Start class='row' Three -->
                    <div class="row">                        
                        
                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your checklist document url' id='txt_2' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your remark' id='txt_remark_2' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0"></h5>
                            <div class="form-group m-t-20">
                            <span id='remove_2' class='remove btn-danger'>Remove the document</span>
                            </div>
                        </div>

                        
                    </div>
                    <!-- End class='row' Three -->


                    <!-- Start class='row' Three -->
                    <div class="row">                        
                        
                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your checklist document url' id='txt_3' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your remark' id='txt_remark_3' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0"></h5>
                            <div class="form-group m-t-20">
                            <span id='remove_3' class='remove btn-danger'>Remove the document</span>
                            </div>
                        </div>

                        
                    </div>
                    <!-- End class='row' Three -->
                    

                </div>
            </div>
            <!-- End class='duplicate_container' One -->

        @else

            <!-- Start class='duplicate_container' Two -->
            <div class="duplicate_container" >
                <div class='duplicate_div_element' id='div_1'>

                    <!-- Start class='row' Three -->
                    <div class="row">                        
                        
                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your checklist document url' id='txt_1' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group m-t-20">                    
                                    <input class="form-control" type='text' placeholder='Enter your remark' id='txt_remark_1' >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0"></h5>
                            <div class="form-group m-t-20">
                                <span class="btn btn-secondary btn-md add">Add Checklist Document</span>
                            </div>
                        </div>

                        
                    </div>
                    <!-- End class='row' Three -->

                </div>
            </div>
            <!-- End class='duplicate_container' Two -->
        @endif

            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md">
                        @if(isset($checklistupload))
                            @if($checklistupload['status'] == '1')
                                Inspect
                            @endif

                            @if($checklistupload['status'] == '3')
                                Verify
                            @endif

                            @if($checklistupload['status'] == '5')
                                Update
                            @endif

                        @else
                            Submit
                        @endif
                    </button>
                    <button onclick="cancel_setup('checklistupload')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
    $(document).ready(function(){

// Add new duplicate_div_element
$(".add").click(function(){

    // Finding total number of duplicate_div_elements added
    var total_duplicate_div_element = $(".duplicate_div_element").length;
                
    // last <div> with duplicate_div_element class id
    var lastid = $(".duplicate_div_element:last").attr("id");
    var split_id = lastid.split("_");
    var nextindex = Number(split_id[1]) + 1;

    var max = 20;
    // Check total number duplicate_div_elements
    if(total_duplicate_div_element < max ){
        // Adding new div container after last occurance of duplicate_div_element class
        $(".duplicate_div_element:last").after("<div class='duplicate_div_element' id='div_"+ nextindex +"'></div>");
                    

        var new_element_string = "<div class='row'><div class='col-md-4'><div class='form-group m-t-20'><input class='form-control' type='text' placeholder='Enter your checklist document url' id='txt_"+ nextindex +"' ></div></div><div class='col-md-4'><div class='form-group m-t-20'><input class='form-control' type='text' placeholder='Enter your remark' id='txt_remark_"+ nextindex +"' ></div></div><div class='col-md-4'><h5 class='card-title m-b-0'></h5><div class='form-group m-t-20'><span id='remove_" + nextindex + "' class='remove btn-danger'>Remove the document</span></div></div></div>";

        // Adding duplicate_div_element to <div>
        $("#div_" + nextindex).append(new_element_string);
                
    }
                
});

// Remove duplicate_div_element
$('.duplicate_container').on('click','.remove',function(){
            
    var id = this.id;
    var split_id = id.split("_");
    var deleteindex = split_id[1];

    // Remove <div> with id
    $("#div_" + deleteindex).remove();
});                
});

</script>
@stop
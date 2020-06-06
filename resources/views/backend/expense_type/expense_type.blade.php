@extends('layouts.master')
@section('title','Expense Type')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-expense_types-center">
            <h4 class="page-title">
                Expense Type - 
                @if($action_type == 'edit' )
                    Edit
                @elseif($action_type == 'show' )
                    Show
                @else
                    Create
                @endif
                View
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-expense_type"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-expense_type active" aria-current="page">Expense Type</li>
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

    @if($action_type == 'edit' )
        {!! Form::open(array('url' => '/backend_app/expense_type/update','id'=>'expense_type', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
    @elseif($action_type == 'create' )
        {!! Form::open(array('url' => '/backend_app/expense_type/store','id'=>'expense_type', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
    @else
        <form>
    @endif 

    <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    @if($action_type == 'edit' )
                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                    @elseif($action_type == 'show' )
                        <a href="/backend_app/expense_type/{{$obj->id}}/edit" class="btn btn-primary btn-md">Edit</a>
                    @else
                        <button type="submit" class="btn btn-primary btn-md">Save</button>
                    @endif

                    <button onclick="cancel_setup('expense_type')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Expense Type Name</h5>
                    <div class="form-group m-t-20">

                        @if($action_type == 'show' )
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Expense Type Name"  value="{{ isset($obj)? $obj->name:Request::old('name') }}" readonly>
                        
                        @else
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Expense Type Name"  value="{{ isset($obj)? $obj->name:Request::old('name') }}" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                        @endif
                        
                    </div>
                </div>                

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Expense Type Code</h5>
                    <div class="form-group m-t-20">

                        @if($action_type == 'show' )
                            <input type="text" class="form-control" id="code" name="code" placeholder="Expense Type Code" value="{{ isset($obj)? $obj->code:Request::old('code') }}" readonly>
                        @else
                            <input type="text" class="form-control" id="code" name="code" placeholder="Expense Type Code" value="{{ isset($obj)? $obj->code:Request::old('code') }}"/>
                            <p class="text-danger">{{$errors->first('code')}}</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Status</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <input type="text" class="form-control" id="code" name="code" placeholder="Expense Type Code" value="{{Status::STATUS[$obj->status]}}" readonly>
                        @else
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
                        @endif

                    </div>
                </div>
            </div>
            <!-- End class='row' One -->


            <!-- Start class='row' Three -->
            <div class="row">

                <div class="col-md-12">  
                    <h5 class="card-title m-b-0">Remark</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <textarea rows="3" cols="50" class="form-control" name="description" id="description" placeholder="Enter Expense Type Description" readonly>{{ isset($obj)? $obj->description:Request::old('description') }}</textarea>
                        @else
                            <textarea rows="3" cols="50" class="form-control" name="description" id="description" placeholder="Enter Expense Type Description">{{ isset($obj)? $obj->description:Request::old('description') }}</textarea>
                            <p class="text-danger">{{$errors->first('description')}}</p>
                        @endif
                    </div>
                </div>
                
            </div>
            <!-- End class='row' Three -->

            <!-- Start class='row' Three -->
            <div class="row">  

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Expense Type Image</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($obj)? $obj->image_url:Request::old('image_url') }});">
                            </div>                            
                        @else
                            <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($obj)? $obj->image_url:Request::old('image_url') }});">
                            </div>
                            <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">                            
                        @endif
                    </div>
                </div>

                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Remark</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <textarea rows="8" cols="50" class="form-control" name="remark" id="remark" placeholder="Enter Expense Type Detail Information" readonly>{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                        @else
                            <textarea rows="10" cols="50" class="form-control" name="remark" id="remark" placeholder="Enter Expense Type Detail Information">{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                            <p class="text-danger">{{$errors->first('remark')}}</p>
                        @endif
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
                    
                    @if($action_type == 'edit' )
                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                    @elseif($action_type == 'show' )
                        <a href="/backend_app/expense_type/{{$obj->id}}/edit" class="btn btn-primary btn-md">Edit</a>
                    @else
                        <button type="submit" class="btn btn-primary btn-md">Save</button>
                    @endif                    

                    <button onclick="cancel_setup('expense_type')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>
    
    @include('backend.modals.image_upload_expense_type')
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
        $('#expense_type').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Expense Type Name is required',
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
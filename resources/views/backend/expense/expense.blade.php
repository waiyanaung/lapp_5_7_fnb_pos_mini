@extends('layouts.master')
@section('title','Expense')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-expenses-center">
            <h4 class="page-title">
                Expense - 
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
                        <li class="breadcrumb-Expense"><a href="/backend_app">Home</a></li>
                    <li class="breadcrumb-expense active" aria-current="page">Expense</li>
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
        {!! Form::open(array('url' => '/backend_app/expense/update','id'=>'expense', 'class'=> 'form-horizontal
    user-form-border','files' => true)) !!}
    @elseif($action_type == 'create' )
        {!! Form::open(array('url' => '/backend_app/expense/store','id'=>'expense', 'class'=> 'form-horizontal
    user-form-border','files' => true)) !!}
    @else
        <form>
    @endif

    <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}" />

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    
                        @if($action_type == 'edit' )
                            <button type="submit" class="btn btn-primary btn-md">Update</button>
                        @elseif($action_type == 'show' )
                            <a href="/backend_app/expense/{{$obj->id}}/edit" class="btn btn-primary btn-md">Edit</a>
                        @else
                            <button type="submit" class="btn btn-primary btn-md">Save</button>
                        @endif
                    
                    <button onclick="cancel_setup('expense')" type="button"
                        class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <!-- Start class='row' One -->
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Name</h5>
                    <div class="form-group m-t-20">

                        @if($action_type == 'show' )
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Expense Name"
                                value="{{ isset($obj)? $obj->name:Request::old('name') }}" readonly>
                        @else
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Expense Name"
                                value="{{ isset($obj)? $obj->name:Request::old('name') }}" required>
                            <p class="text-danger">{{$errors->first('name')}}</p>
                        @endif

                    </div>
                </div>

                 <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Expense Date</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <input type="date" class="form-control" id="date" name="date" placeholder="Expense Date" value="{{ isset($obj)? $obj->date:Request::old('date') }}" readonly />
                        @else
                            <input type="date" class="form-control" id="date" name="date" placeholder="Expense Date" value="{{ isset($obj)? $obj->date:Request::old('date') }}" required/>
                            <p class="text-danger">{{$errors->first('date')}}</p>
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

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

            <!-- Start class='row' Two -->
            <div class="row">

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Type</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <input type="text" class="form-control" id="expense_type_id" name="expense_type_id" value="{{$obj->type->name}}" readonly>
                        @else
                            <select class="form-control" name="expense_type_id" id="expense_type_id" required>
                                @if(isset($obj))
                                    @foreach($expense_types as $expense_type)
                                    @if($expense_type->id == $obj->expense_type_id)
                                    <option value="{{$expense_type->id}}" selected>{{$expense_type->name}}</option>
                                    @else
                                    <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                                    @endif
                                    @endforeach
                                @else                                
                                    @foreach($expense_types as $expense_type)
                                    <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p class="text-danger">{{$errors->first('expense_type_id')}}
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Currency Type</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <input type="text" class="form-control" id="currency_id" name="currency_id" value="{{$currency_types[$obj->currency_id]->code}}" readonly>
                        @else
                            <select class="form-control" name="currency_id" id="currency_id" required>
                                @if(isset($obj))
                                    @foreach($currency_types as $currency_type)
                                    @if($currency_type->value == $obj->currency_id)
                                    <option value="{{$currency_type->code}}" selected>{{$currency_type->code}}</option>
                                    @else
                                    <option value="{{$currency_type->code}}">{{$currency_type->code}}</option>
                                    @endif
                                    @endforeach
                                @else
                                {{-- <option value="" disabled selected>Select One Category</option> --}}
                                @foreach($currency_types as $currency_type)
                                <option value="{{$currency_type->code}}">{{$currency_type->code}}</option>
                                @endforeach
                                @endif
                            </select>
                            <p class="text-danger">{{$errors->first('currency_id')}}
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Amount</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <input type="number" min="1" class="form-control" name="amount" id="amount" value="{{ isset($obj)? $obj->amount:Request::old('amount') }}" readonly>
                        @else
                            <input type="number" min="1" class="form-control" name="amount" id="amount"
                                value="{{ isset($obj)? $obj->amount:Request::old('amount') }}" placeholder="Please Enter Expense" required>
                            <p class="text-danger">{{$errors->first('amount')}}</p>
                        @endif
                    </div>
                </div>

            </div>
            <!-- End class='row' Two -->

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

            <!-- Start class='row' One -->
            <div class="row">

                <div class="col-md-12">
                    <h5 class="card-title m-b-0">Description </h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <textarea rows="2" cols="50" class="form-control" name="description" id="description" readonly>{{ isset($obj)? $obj->description:Request::old('description') }}</textarea>
                        @else
                            <textarea rows="2" cols="50" class="form-control" name="description" id="description"
                                placeholder="Enter Expense Description">{{ isset($obj)? $obj->description:Request::old('description') }}</textarea>
                            <p class="text-danger">{{$errors->first('description')}}</p>
                        @endif
                    </div>
                </div>

            </div>
            <!-- End class='row' One -->
        

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

            <!-- Start class='row' One -->
            <div class="row">

                <div class="col-md-12">
                    <h5 class="card-title m-b-0">Remark</h5>
                    <div class="form-group m-t-20">
                        @if($action_type == 'show' )
                            <textarea rows="7" cols="50" class="text-area form-control" name="remark"
                                id="remark" readonly>{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                        @else
                            <textarea rows="7" cols="50" class="text-area form-control" name="remark"
                                id="remark"
                                placeholder="Enter Expense Rmark">{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                            <p class="text-danger">{{$errors->first('remark')}}</p>
                        @endif
                    </div>
                </div>

            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Three -->
            <div class="row">

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Image 1</h5>
                    <div class="form-group m-t-20">
                        <div class="add_image_div add_image_div_red"
                            style="background-image: url({{ isset($obj)? $obj->image_url:Request::old('image_url') }});">
                        </div>
                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                        <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage"
                            name="removeImage">
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Expense Image 2</h5>
                    <div class="form-group m-t-20">
                        <div class="add_image_div1 add_image_div_red1"
                            style="background-image: url({{ isset($obj)? $obj->image_url1:Request::old('image_url1') }});">
                        </div>
                        <input type="hidden" id="removeImageFlag1" value="0" name="removeImageFlag1">
                        <input type="button" class="form-control image_remove_btn" value="Remove Image"
                            id="removeImage1" name="removeImage1">
                    </div>
                </div>

            </div>
            <!-- End class='row' Three -->

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    
                    @if($action_type == 'edit' )
                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                    @elseif($action_type == 'show' )
                        <a href="/backend_app/expense/{{$obj->id}}/edit" class="btn btn-primary btn-md">Edit</a>
                    @else
                        <button type="submit" class="btn btn-primary btn-md">Save</button>
                    @endif

                    <button onclick="cancel_setup('expense')" type="button"
                        class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @include('backend.modals.image_upload_expense')
    @include('backend.modals.image_upload_expense1')
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
        $('#expense').validate({
            rules: {
                name                  : 'required',
                date                  : 'required',
                amount                  : 'required',
            },
            messages: {
                name                  : 'Expense Name is required',
                date                  : 'Expense Date is required',
                amount                  : 'Expense Amount is required',
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
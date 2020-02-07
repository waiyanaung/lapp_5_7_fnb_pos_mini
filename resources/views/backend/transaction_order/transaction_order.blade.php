@extends('layouts.master')
@section('title','Transaction Order')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))`
                    Transaction Order - Edit

                @else
                    Transaction Order - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction Order</li>
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
        {!! Form::open(array('url' => '/backend_app/transaction_order/update','id'=>'transaction_order', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/transaction_order/store','id'=>'transaction_order', 'class'=> 'form-horizontal user-form-border')) !!}
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
                    <button onclick="cancel_setup('transaction_order')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>  

    <div class="card">
        <div class="card-body">
            
            <!-- Start class='row' One -->
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Customer Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Transaction Order Name"  value="{{ isset($obj)? $obj->name:Request::old('name') }}" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>

                {{-- <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Country Name</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="township_id" id="township_id">
                        @if(isset($obj))
                            @foreach($townships as $township)
                                @if($township->id == $obj->township_id)
                                    <option value="{{$township->id}}" selected>{{$township->name}}</option>
                                @else
                                    <option value="{{$township->id}}">{{$township->name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="" disabled selected>{{trans('setup_product.select-township')}}</option>
                            @foreach($townships as $township)
                                <option value="{{$township->id}}">{{$township->name}}</option>
                            @endforeach
                        @endif
                    </select>
                        <p class="text-danger">{{$errors->first('township_id')}}</p>
                    </div>
                </div> --}}

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Phone</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="{{trans('setup_product.place-phone')}}" value="{{ isset($obj)? $obj->phone:Request::old('phone') }}"/>
                <p class="text-danger">{{$errors->first('phone')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Item Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" readonly id="item_id" name="item_id" placeholder="{{trans('setup_product.place-item_id')}}" value="{{ isset($obj)? $obj->item->name:Request::old('item_id') }}"/>
                <p class="text-danger">{{$errors->first('item_id')}}</p>
                    </div>
                </div>
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Two -->
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Installation</h5>
                    <div class="form-group m-t-20">
                        <select class="form-control" name="add_installation" id="add_installation">
                            @if(isset($obj))
                            @if($obj->add_installation == 1)
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                            @else
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                            @endif
                            @else
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                            @endif

                        </select>
                        <p class="text-danger">{{$errors->first('status')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Quantity</h5>
                    <div class="form-group m-t-20">
                        <input type="number" class="form-control" name="total_item_qty" id="total_item_qty" placeholder="Enter Transaction Order Name"  value="{{ isset($obj)? $obj->total_item_qty:Request::old('total_item_qty') }}" required>
                        <p class="text-danger">{{$errors->first('total_item_qty')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Status</h5>
                    <div class="form-group m-t-20">
                        <select class="form-control" name="status" id="status">
                            @if(isset($obj))
                            @if($obj->status == 1)
                                <option value="1" selected>Pending</option>
                                <option value="2">Confirmed</option>
                                <option value="0">Void</option>
                            @elseif($obj->status == 2)
                                <option value="1">Pending</option>
                                <option value="2" selected>Confirmed</option>
                                <option value="0">Void</option>
                            @else
                                <option value="1">Pending</option>
                                <option value="2">Confirmed</option>
                                <option value="0" selected>Void</option>
                            @endif

                            @else
                                <option value="1" selected>Pending</option>
                                <option value="2">Confirmed</option>
                                <option value="0">Void</option>
                            @endif

                        </select>
                        <p class="text-danger">{{$errors->first('status')}}</p>
                    </div>
                </div>
                
            </div>
            <!-- End class='row' Two -->

             <!-- Start class='row' Three -->
             <div class="row">

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Township Name</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="township_id" id="township_id">
                        @if(isset($obj))
                            @foreach($townships as $township)
                                @if($township->id == $obj->township_id)
                                    <option value="{{$township->id}}" selected>{{$township->name}}</option>
                                @else
                                    <option value="{{$township->id}}">{{$township->name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="" disabled selected>{{trans('setup_product.select-township')}}</option>
                            @foreach($townships as $township)
                                <option value="{{$township->id}}">{{$township->name}}</option>
                            @endforeach
                        @endif
                    </select>
                        <p class="text-danger">{{$errors->first('township_id')}}</p>
                    </div>
                </div>

                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Customer Address</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address"  value="{{ isset($obj)? $obj->address:Request::old('address') }}" required>
                        <p class="text-danger">{{$errors->first('address')}}</p>
                    </div>
                </div>

            </div>
            <!-- End class='row' Three -->

             <!-- Start class='row' Four -->
             <div class="row">                

                <div class="col-md-12">  
                    <h5 class="card-title m-b-0">Remark</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter Address"  value="{{ isset($obj)? $obj->remark:Request::old('remark') }}">
                        <p class="text-danger">{{$errors->first('remark')}}</p>
                    </div>
                </div>

            </div>
            <!-- End class='row' Four -->
            
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
                    <button onclick="cancel_setup('transaction_order')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
        $('#product').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Transaction Order Name is required',
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
@extends('layouts.master_transaction')
@section('title','Transaction')
@section('content')

<style>
    .width-200 {
        width: 150px;
    }

    .width-150 {
        width: 150px;
    }

    .width-100 {
        width: 100px;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))
                Transaction - Edit

                @else
                Transaction - Create
                @endif
            </h4>
            <div class="ml-auto text-right">
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                    </ol>
                </nav> --}}

                @if(isset($obj) && $obj->due_amt > 0)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal" data-whatever="@mdo">Add New Payment</button>
                        @endif
                        
                        @if(!isset($obj))
                        <button type="button" class="btn btn-primary btn-md btn_submit">
                            @if(isset($obj))
                            Update

                            @else
                            Create
                            @endif
                        </button>
                        @endif

                        <button onclick="cancel_setup('transaction')" type="button"
                            class="btn btn-secondary btn-md">Cancel</button>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($obj))
    {!! Form::open(array('url' => '/backend_app/transaction/update','id'=>'frm_transaction', 'class'=> 'frm_transaction
    form-horizontal user-form-border','onsubmit' => 'return validateForm()' )) !!}

    @else
    {{-- {!! Form::open(array('url' => '/backend_app/transaction/store','id'=>'frm_transaction', 'class'=> 'frm_transaction
    form-horizontal user-form-border','onsubmit' => 'return validateForm()')) !!} --}}

    <form method="post" id="frm_transaction">
        @csrf
        @endif
        <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}" />


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class=" print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="print-success-msg" style="display:none">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="">
                    <span class="" id="result"></span>
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
                            @if(isset($obj))
                                <input type"text" class="form-control" id="customer_id" name="customer_id" value="{{$obj->customer->first_name}} {{$obj->customer->last_name}}" readonly>
                            @else
                                <select class="form-control customer_id" name="customer_id" id="customer_id">
                                    @if(isset($obj))
                                    @foreach($customers as $customer)
                                    @if($customer->id == $obj->customer_id)
                                    <option value="{{$customer->id}}" selected>{{$customer->first_name}}
                                        {{$customer->last_name}}</option>
                                    @else
                                    <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}
                                    </option>
                                    @endif
                                    @endforeach
                                    @else                                    
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            @endif
                            <p id="customer_id_error" class="text-danger">{{$errors->first('customer_id')}}</p>
                        </div>
                    </div>

                    @if(isset($obj))
                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Transaction Status</h5>
                            <div class="form-group m-t-20">
                                <input type"text" class="form-control" id="status" name="status" value="{{Status::TRANSACTION[$obj->status]}}" " readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Payment Status</h5>
                            <div class="form-group m-t-20">
                                <input type"text" class="form-control" id="status_payment" name="status_payment" value="{{Status::TRANSACTION_PAYMENT[$obj->status_payment]}}" " readonly>
                            </div>
                        </div>

                        

                    @endif

                </div>
                <!-- End class='row' One -->

                <!-- Start class='row' One -->
                @if(isset($obj))
                    <div class="row">

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Transaction Created at</h5>
                            <div class="form-group m-t-20">
                                <input type"text" class="form-control" id="status" name="status" value="{{ date_format($obj->created_at,"d-M-Y H:i:s") }}" " readonly>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h5 class="card-title m-b-0">Transaction Remark</h5>
                            <div class="form-group m-t-20">
                                <input type"text" class="form-control" value="{{ $obj->remark }}" " readonly>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- End class='row' One -->

            </div>
        </div>

        {{-- payment - for edit case - start --}}
        @if(isset($obj))
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Receipt Summary</h5><br>
                        </div>
                    </div>

                    <!-- Start class='row' Three -->
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="text-right table table-bordered table-striped">
                                <thead>
                                    <td class="bg_n_fontcolor2">Sub Total</td>
                                    <td class="bg_n_fontcolor2">Service Charges</td>
                                    <td class="bg_n_fontcolor2">Tax Amount</td>
                                    <td class="bg_n_fontcolor2">Discount Type</td>
                                    <td class="bg_n_fontcolor2">Discount Amount</td>
                                    <td class="bg_n_fontcolor2">Total Payable Amount</td>
                                    <td class="bg_n_fontcolor2">Paid Amount</td>
                                    <td class="bg_n_fontcolor2">Due Amount</td>
                                    
                                </thead>
                                
                                <tr>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->sub_total }}</label></td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->service_charges }}</label></td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->tax_amt }}</label></td>
                                    <td class="bg_n_fontcolor">
                                        <label>
                                            @if($obj->main_discount_type == 1)
                                                {{$obj->main_discount_percent}} {{ '%' }}
                                            @elseif($obj->main_discount_type == 2)
                                                {{ 'Amount' }}
                                            @else
                                                {{ 'No Discount' }}
                                            @endif
                                        </label>     
                                    </td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->main_discount_amt }}</label></td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->grand_total }}</label></td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->paid_amt }}</label></td>
                                    <td class="bg_n_fontcolor"><label>{{ $obj->due_amt }}</label></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <!-- End class='row' Three -->

                </div>
            </div>
        @endif
        
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <h5 class="card-title m-b-0">Items</h5><br>
                    </div>
                </div>

                <!-- Start class='row' Two -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dynamic_field">
                                <thead>
                                    <tr>
                                        <th class="bg_n_fontcolor2">Category Name</th>
                                        <th class="bg_n_fontcolor2">Brand Name</th>
                                        <th class="bg_n_fontcolor2">Item Name</th>
                                        <th class="bg_n_fontcolor2">Item Price</th>
                                        <th class="bg_n_fontcolor2">Item Quantity</th>
                                        <th class="bg_n_fontcolor2">Item Amount</th>
                                        @if(!isset($obj))
                                            <th class="bg_n_fontcolor2">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>

                                    {{-- for edit case - start --}}
                                    @if(isset($obj))

                                        @if($obj->children()->exists())
                                            @foreach ($obj->children as $item_counter => $transaction_item)

                                            <tr id="row{{$item_counter}}" class="dynamic-added">
                                                <td>
                                                    <label>{{$transaction_item->category->name}}</label>
                                                    <p id="0_error" class="text-danger">{{$errors->first('category_id0')}}</p>
                                                </td>

                                                <td>
                                                    <label>{{$transaction_item->brand->name}}</label>
                                                    <p id="brand0_error" class="text-danger">{{$errors->first('brand_id0')}}
                                                    </p>

                                                </td>

                                                <td>
                                                    <label>{{$transaction_item->item->name}}</label>
                                                    <p id="item_id0_error" class="text-danger">{{$errors->first('item_id0')}}
                                                    </p>

                                                </td>

                                                <td>
                                                    <input readonly type="text" name="price[]" id="price0"
                                                        class="form-control text-right name_list item_price"
                                                        value="{{ isset($transaction_item)? $transaction_item->item_price:Request::old('item_price') }}" />
                                                </td>

                                                <td>
                                                    <input readonly type="number" min="1" step="1" name="item_qty[]" id="item_qty0"
                                                        placeholder="Enter your Quantity"
                                                        class="form-control name_list item_qty text-right"
                                                        value="{{ isset($transaction_item)? $transaction_item->item_qty:Request::old('item_qty0') }}"
                                                        onchange="updateAmount(this.id)" />
                                                    <p id="item_qty0_error" class="text-danger">{{$errors->first('item_qty0')}}
                                                    </p>
                                                </td>

                                                <td>
                                                    <input readonly type="text" name="item_amount[]" id="item_amount0"
                                                        class="form-control text-right name_list item_amt"
                                                        value="{{ isset($transaction_item)? $transaction_item->item_amt:Request::old('item_amt') }}" />
                                                </td>

                                                @if(isset($obj))
                                                    
                                                @else
                                                    @if($item_counter == 0)
                                                    <td>
                                                        <button type="button" name="add" id="add"
                                                            class="btn btn-success form-control">Add Item</button></td>
                                                    @else
                                                        <?php echo '<td><button type="button" name="remove" id="'.$item_counter.'" class="btn btn-danger btn_remove form-control">Remove Item</button></td></tr>'; ?>
                                                    @endif
                                                @endif
                                            </tr>

                                            @endforeach

                                            <tr>
                                                <td class="bg_n_fontcolor text-right" colspan="4">Total</td>
                                                <td class="bg_n_fontcolor text-right">{{ $obj->total_item_qty }}</td>
                                                <td class="bg_n_fontcolor text-right">{{ $obj->sub_total }}</td>
                                            </tr>
                                        @endif
                                    {{-- for edit case - end --}}
                                    
                                    @else
                                    {{-- for create case - start --}}
                                    <tr>
                                        <td>
                                            <select class="form-control width-150 category_id" name="category_id[]"
                                                id="0" onchange="getBrandsByCategory(this.id)">
                                                @if(isset($obj))
                                                @foreach($categories as $category)
                                                @if($category->id == $obj->category_id)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endif
                                                @endforeach
                                                @else
                                                <option value="" selected>Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <p id="0_error" class="text-danger">{{$errors->first('category_id0')}}</p>

                                        </td>

                                        <td>
                                            <select class="form-control width-150 brand_id" name="brand_id[]"
                                                id="brand_id0" onchange="getItemsByBrand(this.id)">
                                                <option value="">Select Brand</option>
                                            </select>
                                            <p id="brand_id0_error" class="text-danger">{{$errors->first('brand_id0')}}</p>

                                        </td>

                                        <td>
                                            <select class="form-control width-150 item_id" name="item_id[]"
                                                id="item_id0" onchange="getItem(this.id)">
                                                <option value="" selected>Select Item</option>
                                            </select>
                                            <p id="item_id0_error" class="text-danger">{{$errors->first('item_id0')}}
                                            </p>

                                        </td>

                                        <td><input readonly type="text" name="price[]" id="price0"
                                                class="form-control width-100 name_list item_price" /></td>

                                        <td>
                                            <input type="number" min="1" step="1" name="item_qty[]" id="item_qty0"
                                                placeholder="Enter your Quantity"
                                                class="form-control width-100 name_list item_qty"
                                                value="{{ old('item_qty')[0] }}" onchange="updateAmount(this.id)" />
                                            <p id="item_qty0_error" class="text-danger">{{$errors->first('item_qty0')}}
                                            </p>
                                        </td>

                                        <td><input readonly type="text" name="item_amount[]" id="item_amount0"
                                                class="form-control width-100 name_list item_amt" /></td>

                                        <td><button type="button" name="add" id="add"
                                                class="btn btn-success form-control">Add Item</button></td>
                                    </tr>
                                    @endif
                                    {{-- for create case - end --}}

                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <!-- End class='row' Two -->

            </div>
    </div>

        {{-- payment - for edit case - start --}}
        @if(isset($obj))

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Payment History</h5><br>
                        </div>
                    </div>
                    
                    <!-- Start class='row' Three -->
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="text-right table table-bordered table-striped">
                                <thead>
                                    <td class="bg_n_fontcolor2">Payment No.</td>
                                    <td class="bg_n_fontcolor2">Total Payable Amount</td>
                                    <td class="bg_n_fontcolor2">Paid Amount</td>
                                    <td class="bg_n_fontcolor2">Changed Amount</td>
                                    <td class="bg_n_fontcolor2">Payment Type</td>
                                    <td class="bg_n_fontcolor2">Bank Reference</td>
                                    <td class="bg_n_fontcolor2">Paid at</td>
                                    <td class="bg_n_fontcolor2">Payment Remark</td>
                                </thead>
                                @if($obj->payments()->exists())
                                    @foreach ($obj->payments as $key_payment => $tran_payment)
                                        <tr>

                                            <td class="font-weight-bold">
                                                <label>{{ $key_payment + 1 }}</label>
                                            </td>
                                            
                                            <td>
                                                <label>{{ $obj->grand_total }}</label>
                                            </td>
                                            
                                            <td>
                                                <label>{{ $tran_payment->paid_amt }}</label>
                                            </td>

                                            <td class="font-weight-bold">
                                                <label>{{ $tran_payment->change_amt }}</label>
                                            </td>
                                            
                                            <td>
                                                <label>
                                                    @if($tran_payment->payment_type == 1)
                                                        {{ 'Cash' }}
                                                    @elseif($tran_payment->payment_type == 2)
                                                        {{ 'Bank Transfer' }}
                                                    @else
                                                        {{ '' }}
                                                    @endif
                                                </label>                                       
                                            </td>

                                            <td class="font-weight-bold">
                                                <label>{{ $tran_payment->bank_reference }}</label>
                                            </td>

                                            <td class="font-weight-bold">
                                                <label>{{ date_format($tran_payment->created_at,"d-M-Y H:i:s") }}</label>
                                            </td>

                                            <td class="font-weight-bold">
                                                <label>{{ $tran_payment->remark }}</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="8" class="bg_n_fontcolor">
                                        <p class="text-center">There is no paymet yet !!!! </p>
                                        </td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <!-- End class='row' Three -->

                </div>
            </div>
                    

            @if($obj->due_amt > 0)

                <div class="card">
                    <div class="card-body">
    
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title m-b-0">New Payment</h5>
                                <hr>
                            </div>
                        </div>

                        @include('backend.transaction.transaction_payment')

                    </div>
                </div>

            @endif

        {{-- payment - for edit case - end --}}
                
        @else
        
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title m-b-0">New Payment</h5>
                            <hr>
                        </div>
                    </div>

                    {{-- payment - for create case - end --}}

                        @include('backend.transaction.transaction_payment')

                    {{-- for create case - end --}}

                </div>
            </div>
        @endif

            

        <div class="row">
            <div class="col-md-12 text-right">
                <div class="card">
                    <div class="card-body border-top">

                        @if(isset($obj) && $obj->due_amt > 0)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal" data-whatever="@mdo">Add New Payment</button>
                        @endif

                        @if(!isset($obj))
                        <button type="button" class="btn btn-primary btn-md btn_submit ">
                            @if(isset($obj))
                                Update

                            @else
                                Create
                            @endif
                        </button>
                        @endif
                        <button onclick="cancel_setup('transaction')" type="button"
                            class="btn btn-secondary btn-md">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        @include('backend.transaction.transaction_payment_new')
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer')
<script type="text/javascript">
    $(document).ready(function() {

        $( "#main_discount_percent" ).hide();
        $( "#main_discount_value" ).hide();

        $('.btn_submit').on('click', function(event){            
            
            // form validation with javascript for the transaction 
            let form_validated_result = validateForm();
            if(form_validated_result == false){
                return false;
            }

            // checking pay amount case 
            let paid_amt = $("#paid_amt").val();
            if(paid_amt == ""){
                alert_msg = "There is no ' Pay Amount ' !!! . \n Will you create New Transaction ?";
            }
            else{
                alert_msg = "Create New Transaction !";
            }


            swal({
                title: "Are you sure ?",
                text: alert_msg,
                icon: "warning",
                buttons: true,
                closeOnClickOutside: false,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    formSubmitting();
                } else {
                    
                }
            });
            
                
        });

    //   counter for the dynamic row adding
      let i = 1;  

    //   $('#add').click(function(){  
    $("#add").click(function (e) {
          
           e.preventDefault();

            let new_row = '<tr id="row'+i+'" class="dynamic-added">';
            new_row += '<td>';
            new_row += '    <select class="form-control width-150 category_id" name="category_id[]" id="'+i+'" onchange="getBrandsByCategory(this.id)">';
            new_row += '        <option value="" selected>Select Category</option>';
            new_row += '<?php foreach($categories as $category){ echo '<option value="'. $category->id . '">'. $category->name .'</option>';}?>';
            new_row += '    </select>';
            new_row += '<p id="'+i+'_error" class="text-danger">{{$errors->first("category_id' + i + '")}}</p>';
            new_row += '</td>';

            new_row += '<td>';
            new_row += '   <select class="form-control width-150 brand_id" name="brand_id[]" id="brand_id'+i+'"  onchange="getItemsByBrand(this.id)">';
            new_row += '       <option value="" selected>Select Brand</option>';
            new_row += '   </select>';
            new_row += '<p id="brand_id'+i+'_error" class="text-danger">{{$errors->first("brand_id' +i+ '")}}</p>';
            new_row += '</td>';

            new_row += '<td>';
            new_row += '   <select class="form-control width-150 item_id" name="item_id[]" id="item_id'+i+'"  onchange="getItem(this.id)">';
            new_row += '       <option value="" selected>Select Item</option>';
            new_row += '   </select>';
            new_row += '<p id="item_id'+i+'_error" class="text-danger">{{$errors->first("item_id' +i+ '")}}</p>';
            new_row += '</td>';
            
            new_row += '<td><input readonly type="text" name="price[]" id="price'+i+'" class="form-control name_list item_price" /></td>';

            new_row += '<td><input type="number" min="1" step="1" name="item_qty[]" id="item_qty'+i+'" placeholder="Enter your Quantity" class="form-control name_list item_qty" value="1" onchange="updateAmount(this.id)"/>';
            new_row += '<p id="item_qty'+i+'_error" class="text-danger">{{$errors->first("item_qty' +i+ '")}}</p>';
            new_row += '</td>';

            new_row += ' <td><input readonly type="text" name="item_amount[]" id="item_amount'+i+'" class="form-control name_list item_amt" /></td>';
           
            new_row += '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove form-control">Remove Item</button></td></tr>';
            $('#dynamic_field').append(new_row);

            i++;  

      });  
      
      $(document).on('click', '.btn_remove', function(){  
           let button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
            calculateTotalPrice();
      });  
      
    });

    function validateForm() {
        
        let validation_result = 0;

        // clear previous error text
        $('#customer_id_error').text('');
        let cat_counter = 0;        
        $('.category_id').each(function() {
            let id = $(this).attr("id");
            $('#'+ cat_counter + "_error").text('');
            cat_counter++;
        });

        let b_counter = 0;        
        $('.brand_id').each(function() {
            let id = $(this).attr("id");
            $('#brand_id'+ b_counter + "_error").text('');
            b_counter++;
        });

        let i_counter = 0;
        $('.item_id').each(function() {
            let id = $(this).attr("id");
            $('#item_id' + i_counter + "_error").text('');
            i_counter++;
        });

        let i_qty_counter = 0;
        $('.item_id').each(function() {
            let id = $(this).attr("id");
            $('#item_qty' + i_qty_counter + "_error").text('');
            i_qty_counter++;
        });

        let customer_id = $( "#customer_id" ).val();        
        if (customer_id == "") {
            $('#customer_id_error').text('Customer Name is Required !');
            validation_result++;
        }

        let category_counter = 0;
        $('.category_id').each(function() {
            let id = $(this).attr("id");
            let category_id = $( "#"+id).val();
            
            if (category_id == "") {
                $('#'+ category_counter + "_error").text('Category is Required !');
                validation_result++;                
            }

            category_counter++;
        });

        let brand_counter = 0;
        $('.brand_id').each(function() {
            let id = $(this).attr("id");
            let brand_id = $( "#"+id).val();
            
            if (brand_id == "") {
                $('#brand_id'+ brand_counter + "_error").text('Brand is Required !');
                validation_result++;                
            }

            brand_counter++;
        });

        let item_counter = 0;
        $('.item_id').each(function() {
            let id = $(this).attr("id");
            let item_id = $( "#"+id).val();

            if (item_id == "") {
                $('#item_id'+ item_counter + "_error").text('Item is Required !');
                validation_result++;
            }

            item_counter++;
        });

        let item_qty_counter = 0;
        $('.item_qty').each(function() {
            let id = $(this).attr("id");
            let item_qty = $( "#"+id).val();
            
            if (item_qty == "") {
                $('#item_qty'+ item_qty_counter + "_error").text('Quantity is Required !');
                validation_result++;
            }

            item_qty_counter++;
        });
        
        if(validation_result > 0){
            return false;
        }
        else{
            
            $('input[type="submit"]').attr('disabled','disabled');
            return true;
            // $("#frm_transaction").submit();
        }
    }

    function formSubmitting(){
        event.preventDefault();
        $.ajax({
            url:'/backend_app/transaction/store',
            method:'post',
            data:$("#frm_transaction").serialize(),
            dataType:'json',
            beforeSend:function(){
                // $('.btn_submit').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.fail)
                {                    
                    let error_html = '';
                    for(let count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                    let created_obj = data.obj;
                    let created_obj_id = created_obj['id'];

                    swal({
                    title: "Success",
                    text: "Transaction ID is " + created_obj_id ,
                    icon: "success",
                    dangerMode: false,
                    closeOnClickOutside: false,
                    buttons: [
                        
                        'Check This Transaction',
                        'Go To Tranaction List',
                    ],
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            window.location = "/backend_app/transaction";
                        } else {
                            window.location = "/backend_app/transaction/"+ created_obj_id +"/edit";
                        }
                    });
                    
                }
                $('#save').attr('disabled', false);
            }
        })
    }   

    function getBrandsByCategory(id){
        let category_id = $("#" + id).val();
        $.ajax({
            type:'POST',
            url:'/backend_app/api/brands_by_category',
            data:{ _token: "{{csrf_token()}}",filter : 'category', category_id: category_id },
            dataType: 'json',
            success:function(data){
                let temp_data = data.returnedObj;
                $("#brand_id" + id).html(temp_data.objs);
                getItemsByBrand("brand_id" + id);
                
            }
        }); 
    }

    function getItemsByBrand(id){
        
        let selected_brand_id = $("#" + id).val();
        let brand_id = id.replace("brand_id", "");
        let temp_id = brand_id;
        $.ajax({
            type:'POST',
            url:'/backend_app/api/items',
            data:{ _token: "{{csrf_token()}}",filter: 'brand', brand_id : selected_brand_id },
            dataType: 'json',
            success:function(data){
                let temp_data = data.returnedObj;
                $("#item_id" + brand_id).html(temp_data.objs);
            },
            error:function(data){
                resetItemQty(temp_id);
            }
        });
        calculateTotalPrice();
        getItem("item_id" + temp_id);
    }

    function getItem(id){
        let item_id = $("#" + id).val();
        let temp_id = id.replace("item_id", "");
        let selected_price_id = "price" + temp_id;
        let selected_brand_val = $("#brand_id" + temp_id).val();
        if(selected_brand_val == ""){
            item_id = "";
        }

        $.ajax({
            type:'POST',
            url:'/backend_app/api/item',
            data:{ _token: "{{csrf_token()}}",item_id: item_id },
            dataType: 'json',
            success:function(data){
                if(data.returnedObj.laravelStatus == "500" ){
                    resetItemQty(temp_id);
                }
                else{
                    $("#item_qty" + temp_id).val(1);
                    let temp_data = data.returnedObj.objs;
                    let item_price = temp_data.price;
                    $("#" + selected_price_id).val(item_price);
                    let item_qty = $("#item_qty" + temp_id).val();
                    let temp_item_amount = item_qty * item_price;
                    $("#item_amount" + temp_id).val(temp_item_amount);
                }
                calculateTotalPrice();
            },
            error:function(data){
                resetItemQty(temp_id);
                calculateTotalPrice();
            }
        });
        
        
    }

    function resetItemQty(temp_id){
        $("#item_qty" + temp_id).val(0);
        let selected_price_id = "price" + temp_id; 
        let temp_data = [];
        let item_price = 0;
        $("#" + selected_price_id).val(item_price);
        let item_qty = 0;
        let temp_item_amount = item_qty * item_price;
        $("#item_amount" + temp_id).val(temp_item_amount);         
    }

    function getItemsByCategory(id){
        let category_id = $("#" + id).val();
        $.ajax({
            type:'POST',
            url:'/backend_app/api/items',
            data:{ _token: "{{csrf_token()}}",filter : 'category', category_id: category_id },
            dataType: 'json',
            success:function(data){
                let temp_data = data.returnedObj;
                $("#item_id" + id).html(temp_data.objs);
            }
        });
    }

    function updateAmount(id){
        let item_qty = $("#" + id).val();
        let temp_id = id.replace("item_qty", "");
        let selected_price_id = "price" + temp_id; 
        let temp_item_price =  $("#" + selected_price_id).val();
        let temp_item_amount = item_qty * temp_item_price;
        $("#item_amount" + temp_id).val(temp_item_amount);
        
        calculateTotalPrice();
    }

    function calculateTotalPrice(){

        // Calculating Total Price Case
        let names=document.getElementsByName('price[]');
        let sub_total = 0;
        for(key=0; key < names.length; key++)  {
            if(names[key].value != ""){
                let temp_item_value = names[key].value;
                let temp_item_name = names[key].id;
                let temp_price_id = names[key].id;
                let temp_price_counter = temp_item_name.replace("price", "");
                let item_qty2 = $("#item_qty" + temp_price_counter).val();
                let temp_total_price = item_qty2 * temp_item_value;
                sub_total = sub_total + temp_total_price;
            }            
        }
        sub_total = sub_total.toFixed(2)
        $("#show_sub_total").text(sub_total);
        $("#sub_total").val(sub_total);

        // for calculating main discount case
        let main_discount_type = $("#main_discount_type").val();
        let main_discount_percent = $("#main_discount_percent").val();
        let main_discount_value = $("#main_discount_value").val();
        let main_discount_amt = 0.00 ;
        
        // discouont type is percent case
        if(main_discount_type == 1){
            let temp_percent = main_discount_percent / 100;
            main_discount_amt = temp_percent * sub_total;
            $("#main_discount_value").val(0.00);
            main_discount_amt = main_discount_amt.toFixed(2);
        }
        // discount type is amount / value case
        else if(main_discount_type == 2){
            main_discount_amt = parseFloat(main_discount_value);
            $("#main_discount_percent").val(0.00);
            main_discount_amt = main_discount_amt.toFixed(2);
        }
        // NO discount type case
        else{
            main_discount_amt = 0.00;
            $("#main_discount_percent").val(0.00);
            $("#main_discount_value").val(0);
            main_discount_amt = main_discount_amt.toFixed(2);
        }
        
        $("#main_discount_amt").val(main_discount_amt);
        $("#show_main_discount_amt").text(main_discount_amt);

        total_price = sub_total - main_discount_amt;
        total_price = total_price.toFixed(2);

        // showing Net Payble Amt
        $("#show_grand_total").text(total_price);
        $("#grand_total").val(total_price);

        // calculating due amount
        let change_amt = 0;
        let due_amt = 0;
        let paid_amt_raw = $("#paid_amt").val();
        let paid_amt = parseFloat(paid_amt_raw);
        if(paid_amt >= total_price){
            change_amt = paid_amt - total_price;
            due_amt = 0;
        }
        else{
            due_amt = total_price - paid_amt;
            change_amt = 0;            
        }        
        change_amt = change_amt.toFixed(2);
        $("#show_change_amt").text(change_amt);
        $("#change_amt").val(change_amt);

        due_amt = due_amt.toFixed(2);
        $("#show_due_amt").text(due_amt);
        $("#due_amt").val(due_amt);

    }

    function changePaymentType(id){
        let payment_type = $("#" + id).val();
        if(payment_type == 1){
            $( "#bank_reference" ).prop( "readonly", true );
            $( "#bank_reference" ).val("");
        }
        else{
            $( "#bank_reference" ).prop( "readonly", false );
        }
    }
    
    function changeMainDiscountType(id){
        let main_dis_type = $("#" + id).val();
        $( "#main_discount_percent" ).val(0.00);
        $( "#main_discount_value" ).val(0.00);
        
        $( "#show_main_discount_amt").text(0.00);
        $( "#main_discount_amt" ).val(0.00);

        // selecting percent case
        if(main_dis_type == 1){
            $( "#main_discount_percent" ).show();
            $( "#main_discount_value" ).hide();
            $( "#no_discount" ).hide();
        }
        // selecting value / amount case 
        else if(main_dis_type == 2){
            $( "#main_discount_percent" ).hide();
            $( "#main_discount_value" ).show();
            $( "#no_discount" ).hide();
        }
        // selecting no discount case 
        else{
            $( "#main_discount_percent" ).hide();
            $( "#main_discount_value" ).hide();
            $( "#no_discount" ).show();
        }
        
        calculateTotalPrice();
    }
</script>
@stop
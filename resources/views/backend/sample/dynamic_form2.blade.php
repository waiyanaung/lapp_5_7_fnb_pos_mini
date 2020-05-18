@extends('layouts.master')
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
               Sample Transaction - Edit

                @else
                Sample Transaction - Create
                @endif
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($obj))
    {!! Form::open(array('url' => '/backend_app/sample/dynamic_form2/update','id'=>'frm_transaction', 'class'=> 'frm_transaction
    form-horizontal user-form-border','onsubmit' => 'return validateForm()' )) !!}

    @else
    {{-- {!! Form::open(array('url' => '/backend_app/sample/dynamic_form2/store','id'=>'frm_transaction', 'class'=> 'frm_transaction
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

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md btn_submit">
                        @if(isset($obj))
                        Update

                        @else
                        Create
                        @endif
                    </button>
                    <button onclick="cancel_setup('transaction')" type="button"
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
                    <h5 class="card-title m-b-0">Customer Name</h5>
                    <div class="form-group m-t-20">
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
                            <option value="" selected>Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                        <p id="customer_id_error" class="text-danger">{{$errors->first('customer_id')}}</p>
                    </div>
                </div>



            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Two -->
            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dynamic_field">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor">Category Name</th>
                                    <th class="bg_n_fontcolor">Item Name</th>
                                    <th class="bg_n_fontcolor">Item Price</th>
                                    <th class="bg_n_fontcolor">Item Quantity</th>
                                    <th class="bg_n_fontcolor">Item Amount</th>
                                    <th class="bg_n_fontcolor">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- for edit case  --}}
                                @if(isset($obj))
                                @foreach ($obj->childs as $item_counter => $transaction_item)

                                <tr id="row{{$item_counter}}" class="dynamic-added">
                                    <td>
                                        <select class="form-control width-150 category_id" name="category_id[]" id="0"
                                            onchange="getItems(this.id)">
                                            @if(isset($obj))
                                            @foreach($categories as $category)
                                            @if($category->id == $transaction_item->category_id)
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
                                        <select class="form-control width-150 item_id" name="item_id[]" id="item_id0"
                                            onchange="getItem(this.id)">
                                            <option value="" selected>Select Item</option>
                                            @if(isset($obj))
                                            @foreach($items as $item)
                                            @if($item->id == $transaction_item->item_id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                            @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                            @endforeach
                                            @else
                                            <option value="" selected>Select Item</option>
                                            @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <p id="item_id0_error" class="text-danger">{{$errors->first('item_id0')}}</p>

                                    </td>

                                    <td><input readonly type="text" name="price[]" id="price0"
                                            class="form-control width-100 name_list item_price"
                                            value="{{ isset($transaction_item)? $transaction_item->item_price:Request::old('item_price') }}" />
                                    </td>

                                    <td>
                                        <input type="number" min="1" step="1" name="item_qty[]" id="item_qty0"
                                            placeholder="Enter your Quantity"
                                            class="form-control width-100 name_list item_qty"
                                            value="{{ isset($transaction_item)? $transaction_item->item_qty:Request::old('item_qty0') }}"
                                            onchange="updateAmount(this.id)" />
                                        <p id="item_qty0_error" class="text-danger">{{$errors->first('item_qty0')}}</p>
                                    </td>

                                    <td><input readonly type="text" name="item_amount[]" id="item_amount0"
                                            class="form-control width-100 name_list item_amt"
                                            value="{{ isset($transaction_item)? $transaction_item->item_amt:Request::old('item_amt') }}" />
                                    </td>

                                    @if($item_counter == 0)
                                    <td><button type="button" name="add" id="add"
                                            class="btn btn-success form-control">Add Item</button></td>
                                    @else
                                    <?php echo '<td><button type="button" name="remove" id="'.$item_counter.'" class="btn btn-danger btn_remove form-control">Remove Item</button></td></tr>'; ?>
                                    @endif
                                </tr>

                                @endforeach

                                {{-- for create case --}}
                                @else
                                <tr>
                                    <td>
                                        <select class="form-control width-150 category_id" name="category_id[]" id="0"
                                            onchange="getItems(this.id)">
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
                                        <select class="form-control width-150 item_id" name="item_id[]" id="item_id0"
                                            onchange="getItem(this.id)">
                                            <option value="" selected>Select Item</option>
                                            {{-- @if(isset($obj))
                                                    @foreach($items as $item)
                                                        @if($item->id == $obj->item_id)
                                                            <option value="{{$item->id}}" selected>{{$item->name}}
                                            </option>
                                            @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                            @endforeach
                                            @else
                                            <option value="" selected>Select Item</option>
                                            @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                            @endif --}}
                                        </select>
                                        <p id="item_id0_error" class="text-danger">{{$errors->first('item_id0')}}</p>

                                    </td>

                                    <td><input readonly type="text" name="price[]" id="price0"
                                            class="form-control width-100 name_list item_price" /></td>

                                    <td>
                                        <input type="number" min="1" step="1" name="item_qty[]" id="item_qty0"
                                            placeholder="Enter your Quantity"
                                            class="form-control width-100 name_list item_qty" value="{{ old('item_qty')[0] }}" 
                                            onchange="updateAmount(this.id)" />
                                        <p id="item_qty0_error" class="text-danger">{{$errors->first('item_qty0')}}</p>
                                    </td>

                                    <td><input readonly type="text" name="item_amount[]" id="item_amount0"
                                            class="form-control width-100 name_list item_amt" /></td>

                                    <td><button type="button" name="add" id="add"
                                            class="btn btn-success form-control">Add Item</button></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit btn" />   --}}
                    </div>
                </div>
            </div>
            <!-- End class='row' Two -->

            <!-- Start class='row' Three -->
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 table-responsive">
                    <table class="text-right table table-bordered table-striped" id="dynamic_field">
                        <tr>
                            <td class="font-weight-bold">Total Price :</td>
                            <td>
                                <label id="show_totoal_price">{{ isset($obj)? $obj->sub_total:'Total Price' }}</label>
                                <input type="hidden" id="total_price" name="total_price"
                                    value="{{ isset($obj)? $obj->sub_total:Request::old('sub_total') }}">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Total Discount :</td>
                            <td>
                                <label id="show_discount_amt">Coming Soon</label>
                                <input type="hidden" id="discount_amt" name="discount_amt"
                                    value="{{ isset($obj)? $obj->discount_amt:Request::old('discount_amt') }}">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Net Payable Amount :</td>
                            <td>
                                <label
                                    id="show_net_payable_amt">{{ isset($obj)? $obj->grand_total:'Net Payable Amount'}}</label>
                                <input type="hidden" id="net_payable_amt" name="net_payable_amt"
                                    value="{{ isset($obj)? $obj->grand_total:Request::old('grand_total') }}">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Pay Now Amount :</td>
                            <td class="font-weight-bold">
                                <input class="form-control" type="number" min="0" id="pay_amt" name="pay_amt"
                                    onchange="calculateTotalPrice()">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Pay By :</td>
                            <td>
                                <select id="payment_type" name="payment_type" class="form-control"
                                    onchange="changePaymentType(this.id)">
                                    <option value="1" selected>Cash</option>
                                    <option value="2">Bank Transfer</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Payment By Info :</td>
                            <td>
                                <input type="text" id="payment_bank_transfer_info" name="payment_bank_transfer_info"
                                    class="form-control" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Change Amount :</td>
                            <td class="font-weight-bold">
                                <label id="show_change_amt">0</label>
                                <input type="hidden" id="change_amt" name="change_amt" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Due Amount :</td>
                            <td class="font-weight-bold">
                                <label id="show_due_amt">0</label>
                                <input type="hidden" id="due_amt" name="due_amt" value="0">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- End class='row' Three -->

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="button" class="btn btn-primary btn-md btn_submit ">
                        @if(isset($obj))
                        Update

                        @else
                        Create
                        @endif
                    </button>
                    <button onclick="cancel_setup('transaction')" type="button"
                        class="btn btn-secondary btn-md">Cancel</button>
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

        var customer_id = $( "#customer_id" ).val();        
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
            url:'/backend_app/sample/dynamic_form2/store',
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
                    
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                    swal({
                    title: "Success",
                    text: "Transaction submitted successfully!",
                    icon: "success",
                    dangerMode: false,
                    closeOnClickOutside: false,
                    buttons: [
                        
                        'Check This Transaction',
                        'Go To Tranaction List',
                    ],
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            window.location = "/backend_app/sample/dynamic_form2";
                        } else {
                            window.location = "/backend_app/sample/dynamic_form2/2020-05-16-000040/edit";
                        }
                    });
                    
                }
                $('#save').attr('disabled', false);
            }
        })
    }   

    $(document).ready(function() {

        $('.btn_submit').on('click', function(event){
            // form validation with javascript for the frontend 
                let form_validated_result = validateForm();
                if(form_validated_result == false){
                    return false;
                }

                swal({
                title: "Are you sure ?",
                text: "Create New Transaction !",
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
        
        //Start Validation for Entry and Edit Form
        $('#frm_transaction1').validate({
            rules: {
                customer_id                  : 'required',
                'category_id[]'                  : 'required',
            },
            messages: {
                customer_id                  : 'Customer Name is required',
                'category_id[]'                  : 'Customer Name is required',
            },
            submitHandler: function(form) {
                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }
        });
        //End Validation for Entry and Edit Form

        $('form#frm_transaction1').on('submit', function(event) {

            event.preventDefault();
            //Add validation rule for dynamically generated name fields
            $('.customer_id').each(function() {
                
                $(this).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Customer Name is required !",
                        }
                    });
            });
            
            //Add validation rule for dynamically generated email fields
            $('.category_id').each(function() {
                let id = $(this).attr("id");

                $("#"+id).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Category is required !",
                        }
                    });
            });

            //Add validation rule for dynamically generated email fields
            $('.item_id').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Item is required !",
                        }
                    });
            });



            //Add validation rule for dynamically generated email fields
            $('.item_qty').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Item Qty is required !",
                        }
                    });
            });



            //Add validation rule for dynamically generated email fields
            $('.item_price').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Item Price is required !",
                        }
                    });
            });



            //Add validation rule for dynamically generated email fields
            $('.item_amt').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
                        messages: {
                            required: "Item Amount is required !",
                        }
                    });
            });
        });
        $("#frm_transaction1").validate();

    });

    $(document).ready(function(){      
      var postURL = "<?php echo url('/backend_app/sample/dynamic_form2/store'); ?>";
      var i=1;  


    //   $('#add').click(function(){  
    $("#add").click(function (e) {
          
           e.preventDefault();

            var new_row = '<tr id="row'+i+'" class="dynamic-added">';
            new_row += '<td>';
            new_row += '    <select class="form-control width-150 category_id" name="category_id[]" id="'+i+'" onchange="getItems(this.id)">';
            new_row += '        <option value="" selected>Select Category</option>';
            new_row += '<?php foreach($categories as $category){ echo '<option value="'. $category->id . '">'. $category->name .'</option>';}?>';
            new_row += '    </select>';
            new_row += '<p id="'+i+'_error" class="text-danger">{{$errors->first("category_id' + i + '")}}</p>';
            new_row += '</td>';

            new_row += '<td>';
            new_row += '   <select class="form-control width-150 item_id" name="item_id[]" id="item_id'+i+'"  onchange="getItem(this.id)">';
            new_row += '       <option value="" selected>Select Item</option>';
            //new_row += '<?php foreach($items as $item){ echo '<option value="'. $item->id . '">'. $item->name .'</option>';}?>';
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


           // add the rules to your new item
            // $('#1').rules('add', {
            //     // declare your rules here
            //     required: true
            // });
            i++;  

      });  
      


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
            calculateTotalPrice();
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){       
          
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#transaction').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#transaction')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }

      
    });  

    function getItems(id){
        var category_id = $("#" + id).val();
        $.ajax({
            type:'POST',
            url:'/backend_app/api/items',
            data:{ _token: "{{csrf_token()}}",category_id: category_id },
            dataType: 'json',
            success:function(data){
                var temp_data = data.returnedObj;
                $("#item_id" + id).html(temp_data.objs);
            }
        });
    }

    function getItem(id){
        var item_id = $("#" + id).val();
        var temp_id = id.replace("item_id", "");
        var selected_price_id = "price" + temp_id; 
        $.ajax({
            type:'POST',
            url:'/backend_app/api/item',
            data:{ _token: "{{csrf_token()}}",item_id: item_id },
            dataType: 'json',
            success:function(data){
                $("#item_qty" + temp_id).val(1);
                var temp_data = data.returnedObj.objs;
                var item_price = temp_data.price;
                $("#" + selected_price_id).val(item_price);

                var item_qty = $("#item_qty" + temp_id).val();;
                var temp_item_amount = item_qty * item_price;
                $("#item_amount" + temp_id).val(temp_item_amount);

                calculateTotalPrice();
        
            }
        });
    }

    function updateAmount(id){
        var item_qty = $("#" + id).val();
        var temp_id = id.replace("item_qty", "");
        var selected_price_id = "price" + temp_id; 
        var temp_item_price =  $("#" + selected_price_id).val();
        var temp_item_amount = item_qty * temp_item_price;
        $("#item_amount" + temp_id).val(temp_item_amount);
        calculateTotalPrice();
    }

    function calculateTotalPrice(){

        // Calculating Total Price Case
        var names=document.getElementsByName('price[]');
        var total_price = 0;
        for(key=0; key < names.length; key++)  {
            if(names[key].value != ""){
                var temp_item_value = names[key].value;
                var temp_item_name = names[key].id;
                var temp_price_id = names[key].id;
                var temp_price_counter = temp_item_name.replace("price", "");
                var item_qty2 = $("#item_qty" + temp_price_counter).val();
                var temp_total_price = item_qty2 * temp_item_value;
                total_price = total_price + temp_total_price;
            }            
        }
        $("#show_totoal_price").text(total_price);
        $("#total_price").val(total_price);
        
        // Calculating discount case


        // showing Net Payble Amt
        $("#show_net_payable_amt").text(total_price);
        $("#net_payable_amt").val(total_price);

        // calculating due amount
        var change_amt = 0;
        var due_amt = 0;
        var pay_amt = $("#pay_amt").val();
        if(pay_amt > total_price){
            change_amt = pay_amt - total_price;
            due_amt = 0;
        }
        else{
            due_amt = total_price - pay_amt;
            change_amt = 0;
        }
        

        $("#show_change_amt").text(change_amt);
        $("#change_amt").val(change_amt);

        $("#show_due_amt").text(due_amt);
        $("#due_amt").val(due_amt);

    }

    function changePaymentType(id){
        var payment_type = $("#" + id).val();
        if(payment_type == 1){
            $( "#payment_bank_transfer_info" ).prop( "readonly", true );
        }
        else{
            $( "#payment_bank_transfer_info" ).prop( "readonly", false );
        }
    }
</script>
@stop
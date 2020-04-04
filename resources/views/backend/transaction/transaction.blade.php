@extends('layouts.master')
@section('title','Transaction')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))`
                    Transaction - Edit

                @else
                    Transaction - Create
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
        {!! Form::open(array('url' => '/backend_app/transaction/update','id'=>'transaction', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/transaction/store','id'=>'transaction', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}"/>
    

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
                    <button onclick="cancel_setup('transaction')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
                    <select class="form-control" name="customer_id" id="customer_id">
                        @if(isset($obj))
                            @foreach($customers as $customer)
                                @if($customer->id == $obj->customer_id)
                                    <option value="{{$customer->id}}" selected>{{$customer->first_name}} {{$customer->last_name}}</option>
                                @else
                                    <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="" disabled selected>Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                            @endforeach
                        @endif
                    </select>
                        <p class="text-danger">{{$errors->first('customer_id')}}</p>
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
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Category</th>
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Item</th>
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Price</th>
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Qty</th>
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Amount</th>
                                    <th class="font-weight-bold text-white text-center bg-secondary" width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>  
                                    <td>
                                        <select class="form-control" name="category_id[]" id="0" onchange="getItems(this.id)">
                                            @if(isset($obj))
                                                @foreach($categories as $category)
                                                    @if($category->id == $obj->category_id)
                                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </td>

                                    <td>
                                        <select class="form-control" name="item_id[]" id="item_id0" onchange="getItem(this.id)">
                                            <option value="" disabled selected>Select Item</option>
                                            {{-- @if(isset($obj))
                                                @foreach($items as $item)
                                                    @if($item->id == $obj->item_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" disabled selected>Select Item</option>
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif --}}
                                        </select>

                                    </td>
                                    
                                    <td><input disabled type="text" name="price[]" id="price0" class="form-control name_list" /></td>

                                    <td><input type="number" min="1" step="1" name="qty[]" id="qty0" placeholder="Enter your Quantity" class="form-control name_list" value="1"  onchange="updateAmount(this.id)"/></td>

                                    <td><input disabled type="text" name="item_amount[]" id="item_amount0" class="form-control name_list" /></td>

                                    <td><button type="button" name="add" id="add" class="btn btn-success form-control">Add Item</button></td>  
                                </tr>
                            </tbody>
                        </table>  
                        <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit btn" />  
                    </div>
                </div>
            </div>
            <!-- End class='row' Two -->

            <!-- Start class='row' Three -->
            <div class="row">
                <div class="col-md-8"></div>
                    <div class="col-md-4 table-responsive">  
                        <table class="text-right table table-bordered table-striped" id="dynamic_field">
                            <tr>
                                <td class="font-weight-bold">Total Price :</td>
                                <td>
                                    <label id="show_totoal_price">Total Price</label>
                                    <input type="hidden" id="total_price" name="total_price">
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Total Discount :</td>
                                <td>
                                    <label id="show_discount_amt" >Coming Soon</label>
                                    <input type="hidden" id="discount_amt" name="discount_amt">
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Net Payable Amount :</td>
                                <td>
                                    <label id="show_net_payable_amt" >Net Payable Amount</label>
                                    <input type="hidden" id="net_payable_amt" name="net_payable_amt">
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Pay Now Amount :</td>
                                <td class="font-weight-bold">
                                    <input type="number" min="0" id="pay_amt" name="pay_amt" onchange="calculateTotalPrice()">
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Pay By :</td>
                                <td>
                                    <select id="payment_type" name="payment_type" class="form-control" onchange="changePaymentType(this.id)">
                                        <option value="1" selected>Cash</option>
                                        <option value="2">Bank Transfer</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Payment By Info :</td>
                                <td>
                                    <input type="text" id="payment_bank_transfer_info" name="payment_bank_transfer_info" class="form-control" disabled>
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Change Amount :</td>
                                <td class="font-weight-bold">
                                    <label id="show_change_amt" >0</label>
                                    <input type="hidden" id="change_amt" name="change_amt" value="0">
                                </td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Due Amount :</td>
                                <td class="font-weight-bold">
                                    <label id="show_due_amt" >0</label>
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
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($obj))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('transaction')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
                name                  : 'Transaction Name is required',
            },
            submitHandler: function(form) {
                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }
        });
        //End Validation for Entry and Edit Form

    });

    $(document).ready(function(){      
      var postURL = "<?php echo url('/backend_app/transaction/store'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
            var new_row = '<tr id="row'+i+'" class="dynamic-added">';
            new_row += '<td>';
            new_row += '    <select class="form-control" name="category_id[]" id="'+i+'" onchange="getItems(this.id)">';
            new_row += '        <option value="" disabled selected>Select Category</option>';
            new_row += '<?php foreach($categories as $category){ echo '<option value="'. $category->id . '">'. $category->name .'</option>';}?>';
            new_row += '    </select>';
            new_row += '</td>';

            new_row += '<td>';
            new_row += '   <select class="form-control" name="item_id[]" id="item_id'+i+'"  onchange="getItem(this.id)">';
            new_row += '       <option value="" disabled selected>Select Item</option>';
            //new_row += '<?php foreach($items as $item){ echo '<option value="'. $item->id . '">'. $item->name .'</option>';}?>';
            new_row += '   </select>';
            new_row += '</td>';
            
            new_row += '<td><input disabled type="text" name="price[]" id="price'+i+'" class="form-control name_list" /></td>';

            new_row += '<td><input type="number" min="1" step="1" name="qty[]" id="qty'+i+'" placeholder="Enter your Quantity" class="form-control name_list" value="1" onchange="updateAmount(this.id)"/></td>';

            new_row += ' <td><input disabled type="text" name="item_amount[]" id="item_amount'+i+'" class="form-control name_list" /></td>';
           
            new_row += '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove form-control">Remove Item</button></td></tr>';
           $('#dynamic_field').append(new_row);
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
                var temp_data = data.returnedObj.objs;
                var item_price = temp_data.price;
                $("#" + selected_price_id).val(item_price);

                var item_qty = $("#qty" + temp_id).val();;
                var temp_item_amount = item_qty * item_price;
                $("#item_amount" + temp_id).val(temp_item_amount);

                calculateTotalPrice();
        
            }
        });
    }

    function updateAmount(id){
        var item_qty = $("#" + id).val();
        var temp_id = id.replace("qty", "");
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
                var item_qty2 = $("#qty" + temp_price_counter).val();
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
            $( "#payment_bank_transfer_info" ).prop( "disabled", true );
        }
        else{
            $( "#payment_bank_transfer_info" ).prop( "disabled", false );
        }
    }
</script>
@stop
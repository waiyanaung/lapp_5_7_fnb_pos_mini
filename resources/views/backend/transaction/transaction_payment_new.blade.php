
{{-- start - showing new payemnt for the payment uncomplete receipts --}}
@if(isset($obj) && $obj->due_amt > 0)
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">                    

                    <form method="post" id="frm_transaction_payment">
                        @csrf
                        <input type="hidden" id="transaction_id" name="transaction_id" value="{{ $obj->id }}">

                        <div class="form-group">
                            <div class="">
                                <span class="result_payment" id="result_payment"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Total Payable :</label>
                                    <input readonly class="form-control" type="text" value="{{ $obj->grand_total }}">
                                </div>

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Total Paid :</label>
                                    <input readonly class="form-control" type="text" value="{{ $obj->paid_amt }}">
                                </div>

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Existing Due :</label>
                                    <input id="due_amt_payment" name="due_amt_payment" readonly class="form-control" type="text" value="{{ $obj->due_amt }}">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">New Due Amount:</label>
                                    <input id="due_amt_payment_new" name="due_amt_payment_new" readonly class="form-control" type="text" value="{{ $obj->due_amt }}">
                                </div>

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">New Change Amount :</label>
                                    <input id="change_amt_payment" name="change_amt_payment" readonly class="form-control" type="text" value="">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pay Amount:</label>
                            <input class="form-control" type="number" min="0" id="paid_amt_payment" name="paid_amt_payment">
                            <p id="paid_amt_error" class="text-danger">{{$errors->first('paid_amt_payment')}}</p>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Payment Type:</label>
                            <select id="payment_type" name="payment_type" class="form-control" onchange="changePaymentType(this.id)">
                                <option value="1" selected>Cash</option>
                                <option value="2">Bank Transfer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Bank Reference:</label>
                            <textarea rows="2" cols="50" rows="10" class="form-control" name="bank_reference" id="bank_reference" placeholder="Enter Bank Reference" readonly></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Payment Remark:</label>
                            <textarea rows="2" cols="50" rows="10" class="form-control" name="payment_remark" id="payment_remark" placeholder="Enter Payment Remark"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <div class="">
                                <span class="result_payment"></span>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-md btn_submit_payment">Add Payment</button>
                </div>

                </form>
            </div>
        </div>
    </div>

{{-- end - showing new payemnt for the payment uncomplete receipts --}}


<script type="text/javascript">
    $(document).ready(function() {

        $("#paid_amt_payment").on('change',function(){
            calculateTotalPricePayment();
        });

        $('#paymentModal').on('hidden.bs.modal', function (e) {
            let transaction_id = $("#transaction_id").val();
            window.location = "/backend_app/transaction/"+ transaction_id +"/edit";
        });

        $('.btn_submit_payment').on('click', function(event){ 
            $('#paid_amt_error').text('');
           
            // form validation with javascript for the transaction 
            let paid_amt_for_payment = $("#paid_amt_payment").val();
            if(paid_amt_for_payment == "" || paid_amt_for_payment == null || paid_amt_for_payment == 0){
                $("#paid_amt_error").text('Invalid Pay Amount !!!! ');
                return false;
            }
            
            $.ajax({
                url:'/backend_app/transaction/payment/store',
                method:'post',
                data:$("#frm_transaction_payment").serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('.btn_submit_payment').attr('disabled','disabled');
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
                        $('.result_payment').html('<div class="alert alert-danger">'+error_html+'</div>');
                    }
                    else
                    {
                        $('.result_payment').html('<div class="alert alert-success">'+data.success+'</div>');
                        
                    }
                    // $('#save').attr('disabled', false);
                }
            })
            
                
        });

        function calculateTotalPricePayment(){
            let paid_amt_payment = parseFloat($("#paid_amt_payment").val());
            let due_amt_payment = parseFloat($("#due_amt_payment").val());
            
            // calculating due amount
            let change_amt_payment = 0;
            let due_amt_payment_new = 0;

            let paid_amt = $("#paid_amt").val();
            if(paid_amt_payment >= due_amt_payment){
                change_amt_payment = paid_amt_payment - due_amt_payment;
                due_amt_payment_new = 0;
            }
            else{
                due_amt_payment_new = due_amt_payment - paid_amt_payment;
                change_amt_payment = 0;
            }        

            change_amt_payment = change_amt_payment.toFixed(2);
            due_amt_payment_new = due_amt_payment_new.toFixed(2);

            $("#change_amt_payment").val(change_amt_payment);
            $("#due_amt_payment_new").val(due_amt_payment_new);

        }
    });

    
</script>
@endif
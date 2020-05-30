<!-- Start class='row' Three -->
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8 table-responsive">
            <table class="text-right table table-bordered table-striped" id="dynamic_field">

                <?php
                $readonly = "";
                if(isset($obj)){
                    $readonly = "readonly";
                }
                ?>

                <tr>
                    <td colspan="2" class="bg_n_fontcolor">
                        <p class="text-center">Receipt Information</p>
                    </td>
                </tr>

                <tr>
                    <td class="font-weight-bold">Sub Total Price :</td>
                    <td>
                        <label
                            id="show_sub_total">{{ isset($obj)? $obj->sub_total:'Total Price' }}</label>
                        <input type="hidden" id="sub_total" name="sub_total"
                            value="{{ isset($obj)? $obj->sub_total:Request::old('sub_total') }}">
                    </td>
                </tr>

                <tr>
                    <td class="font-weight-bold">Receipt Discount Type :</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                @if(isset($obj))
                                   <label>
                                        @if($obj->main_discount_type == 1)
                                            {{ 'Percent -' }}
                                        @elseif($obj->main_discount_type == 2)
                                            {{ 'Amount - ' }}
                                        @else
                                            {{ 'No Discount' }}
                                        @endif
                                    </label>
                                @else
                                    <select id="main_discount_type" name="main_discount_type" class="form-control"
                                    onchange="changeMainDiscountType(this.id)">
                                        <option value="0" selected>No Discount</option>
                                        <option value="1">Percent %</option>
                                        <option value="2">Amount</option>
                                    </select>
                                @endif
                            </div>

                            <div class="col-md-6">

                                @if(isset($obj))
                                    <label>
                                        @if($obj->main_discount_type == 1)
                                            {{ $obj->main_discount_percent }} %
                                        @elseif($obj->main_discount_type == 2)
                                            {{ $obj->main_discount_value }}
                                        @else
                                            {{ ' 0.00 ' }}
                                        @endif
                                    </label>
                                
                                @else
                                    <input type="number" min="0" max="100" step="1" class="form-control" id="no_discount" name="no_discount" value="0" disabled>

                                    <input type="number" min="0" max="100" step="any" class="form-control" id="main_discount_percent" name="main_discount_percent" value="{{ isset($obj)? $obj->main_discount_percent:Request::old('main_discount_percent') }}" onchange="calculateTotalPrice()">
                            
                                    <input type="number" min="0" step="any" class="form-control" id="main_discount_value" name="main_discount_value" value="{{ isset($obj)? $obj->main_discount_value:Request::old('main_discount_value') }}"  onchange="calculateTotalPrice()">
                                
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="font-weight-bold">Receipt Discount Amount :</td>
                    <td>
                        <label
                            id="show_main_discount_amt">{{ isset($obj)? $obj->main_discount_amt:'Receipt Discount Amount'}}</label>
                        <input type="hidden" id="main_discount_amt" name="main_discount_amt"
                            value="{{ isset($obj)? $obj->main_discount_amt:Request::old('main_discount_amt') }}">
                    </td>
                </tr>

                <tr>
                    <td class="font-weight-bold">Net Payable Amount :</td>
                    <td>
                        <label
                            id="show_grand_total">{{ isset($obj)? $obj->grand_total:'Net Payable Amount'}}</label>
                        <input type="hidden" id="grand_total" name="grand_total"
                            value="{{ isset($obj)? $obj->grand_total:Request::old('grand_total') }}">
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
                        <label id="show_due_amt">{{ isset($obj)? $obj->due_amt:0 }}</label>
                        <input type="hidden" id="due_amt" name="due_amt" value="{{ isset($obj)? $obj->due_amt:0 }}">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="font-weight-bold">
                        <textarea {{ $readonly }} rows="2" cols="50" rows="10" class="form-control" name="remark" id="remark"
                placeholder="Enter Receipt Remark">{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                    </td>
                </tr>


                @if(!(isset($obj)))
                
                    <tr>
                        <td colspan="2" class="bg_n_fontcolor">
                            <p class="text-center">Payment</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Pay Amount :</td>
                        <td class="font-weight-bold">
                            <input class="form-control" type="number" min="0" id="paid_amt" name="paid_amt"
                                onchange="calculateTotalPrice()" value="0.00">
                        </td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Payment Type :</td>
                        <td>
                            <select id="payment_type" name="payment_type" class="form-control"
                                onchange="changePaymentType(this.id)">

                                @if(isset($obj))
                                    <option value="1" selected>Cash</option>
                                    <option value="2">Bank Transfer</option>
                                @else
                                    <option value="1" selected>Cash</option>
                                    <option value="2">Bank Transfer</option>
                                @endif

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="font-weight-bold">
                            <input type="text" class="form-control" name="bank_reference" id="bank_reference"
                    placeholder="Enter Bank Reference" readonly value="{{ isset($obj)? $obj->bank_reference:Request::old('bank_reference') }}">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="font-weight-bold">
                            <textarea rows="2" cols="50" rows="10" class="form-control" name="payment_remark" id="payment_remark"
                    placeholder="Enter Payment Remark" >{{ isset($obj)? $obj->payment_remark:Request::old('payment_remark') }}</textarea>
                        </td>
                    </tr>
                    
                @endif

            </table>
        </div>
    </div>
    <!-- End class='row' Three -->
{!! Form::open(array('url' => '/cart', 'class'=> 'form-horizontal', 'id'=>'registration', 'class' =>'frm_wrap'))
!!}

<div class="row rounded_div_with_shadow">

    <div class="col-md-12">
        <b>Order This Item</b></br>
        <hr><br>
    </div>
    
    <div class="col-md-4">
        Air-Con Quantity</br>
        <input required type="number" min="1" step="1" class="form-control" id="qty" name="qty" placeholder="1"
            value="1">
        <input type="hidden" id="item_id" name="item_id" value="{{$obj->id}}">
        <label class="text-danger">{{$errors->first('qty')}}</label>
    </div>

    <div class="col-md-4">
        Add Installation</br>
        <select class="form-control" id="add_installation" name="add_installation">
            <option value="0" selected>Do not add installation</option>
            <option value="1" selected>Add installation</option>
        </select>
    </div>

    <div class="col-md-4">
        <br>
        <button type="button" id="btn_submit" class="btn btn-secondary form-control">Add to
            Cart</button>
    </div>
</div>
{!! Form::close() !!}
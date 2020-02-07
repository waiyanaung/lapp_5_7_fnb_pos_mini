@extends('layouts_frontend.master_frontend')
@section('title','Item')
@section('content')

<style>
    #myModal {
        z-index: 1500;
    }

    .modal-dialog {
        top: calc(10% - 200px);
    }
</style>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                
                <h6 class="modal-title">Horse Power Calculation</h6>
                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                @include('frontend.check_hp')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


    <div class="container">
        <div class="row rounded_div_with_shadow">

            <div class="col-md-8">
                <p><span><b>Items</b></span></p>
            </div>

            <div class="col-md-4">
                <button type="button" class="form-control btn link_button4" data-toggle="modal"
                    data-target="#myModal">Check HP For Your Room</button>
            </div>

            <div class="col-md-12">
                <hr><br>
            </div>
        
            <div class="col-md-4">
            <form method="POST" action="/item" accept-charset="UTF-8" id="frm_item">
                @csrf
                <input type="hidden" name="id" value="" />
                    
                    <label>Filter By Brand</label>
                        <select class="form-control" name="brand_id" id="brand_id" onchange="myFunction()">
                            @if(isset($objs))
                            <option value="0">All Brands</option>
                            @foreach($brands as $brand)
                            @if($brand->id == $brand_id)
                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                            @else
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endif
                            @endforeach
                            @else
                            <option value="0" selected>All Brands</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        <p class="text-danger">{{$errors->first('brand_id')}}</p>
                    
                </div>
                
            </form>
        </div>
        <br />

        <?php $foundCount = 0; ?>
        <div class="row">
            @foreach($objs as $obj)
            <?php $foundCount++; ?>
            <div class="col-md-4">
                <div class="card rounded_div_with_shadow2">
                    <?php 
                    if(strcmp($obj['image_url'],"/images/item/")){
                        $img_src = $obj['image_url'];
                    }
                    else if(strcmp($obj['image_url1'],"/images/item/")){
                        $img_src = $obj['image_url1'];
                    }
                    else{
                        $img_src = '/images/default/ac.jpg';
                    }
                    ?>
                    <img class="card-img-top image" src="{{ $img_src }}" alt="Item Image">
                    <div class="card-body">
                        <h6 class="card-title">
                            <a class="link_button" href="/brand_detail/{{$obj['id']}}">
                            </a>
                        </h6>
                        <p class="card-text">
                            <p><b>{{$obj['name']}}</b></h4>
                            </p>
                            <p>{{$brands[$obj['brand_id']]->name}}</p>
                            <p>{{$categories[$obj['category_id']]->name}}</p>                            
                            <p>Made in {{$countries[$obj['country_id']]->name}}</p>
                            <p>Price : {{$obj['price']}} ( MMK )</p>
                        </p>
                        <a class="form-control btn link_button2" href="/item_detail/{{$obj['id']}}">view Item Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--End dynamic objs content-->
        </div>

        @if($foundCount == 0)
        <div class="row rounded_div_with_shadow">
            <div div class="col-md-12">
                <span><b>Sorry, no item found.</b></span>
            </div>
        </div>
        @endif


@stop

@section('page_script')
<script>
    function myFunction() {
        $("#frm_item").submit();
    }

    function checkHP() {
        var length = $('#length').val();
        var breadth = $('#breadth').val();
        var height = $('#height').val();
        var result = length * breadth * height;
        var show_result = "";

        if(result >=1 && result <= 800){
            show_result = "0.75 HP";
        }
        else if(result >= 801 && result <= 1080){
            show_result = "1.00 HP";
        }
        else if(result >= 1081 && result <= 2160){
            show_result = "2.00 HP";
        }
        else if(result >= 2161  && result <= 3229){
            show_result = "2.50 HP";
        }
        else if(result >= 2161  && result <= 3239){
            show_result = "2.50 HP";
        }
        else if(result >= 3240  && result <= 4318){
            show_result = "3.00 HP";
        }
        else if(result >= 4319){
            show_result = "orver 3.00 HP";
        }
        else{
            show_result = "Plese check your inputs ( length, Breadth and Height ).";
        }

        $('#check_result').val(show_result);
    }
    
</script>
@stop
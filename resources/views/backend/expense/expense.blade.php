@extends('layouts.master')
@section('title','Item')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))
                Item - Edit

                @else
                Item - Create
                @endif
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-Item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Item</li>
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
    {!! Form::open(array('url' => '/backend_app/item/update','id'=>'item', 'class'=> 'form-horizontal
    user-form-border','files' => true)) !!}

    @else
    {!! Form::open(array('url' => '/backend_app/item/store','id'=>'item', 'class'=> 'form-horizontal
    user-form-border','files' => true)) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($obj)? $obj->id:''}}" />

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
                    <button onclick="cancel_setup('item')" type="button"
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
                    <h5 class="card-title m-b-0">Item Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Item Name"
                            value="{{ isset($obj)? $obj->name:Request::old('name') }}" required>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                </div>

                <!-- <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Item Code</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Item Code" value="{{ isset($obj)? $obj->code:Request::old('code') }}"/>
                <p class="text-danger">{{$errors->first('code')}}</p>
                    </div>
                </div> -->

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Item Model</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="model" id="model" placeholder="Enter Item Model"
                            value="{{ isset($obj)? $obj->model:Request::old('model') }}" required>
                        <p class="text-danger">{{$errors->first('model')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Status</h5>
                    <div class="form-group m-t-20">
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
                    <h5 class="card-title m-b-0">Brand</h5>
                    <div class="form-group m-t-20">
                        <select class="form-control" name="brand_id" id="brand_id">
                            @if(isset($obj))
                            @foreach($brands as $brand)
                            @if($brand->id == $obj->brand_id)
                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                            @else
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endif
                            @endforeach
                            @else
                            {{-- <option value="" disabled selected>Select One Brand</option> --}}
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        <p class="text-danger">{{$errors->first('brand_id')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Category Name</h5>
                    <div class="form-group m-t-20">
                        <select class="form-control" name="category_id" id="category_id">
                            @if(isset($obj))
                            @foreach($categories as $category)
                            @if($category->id == $obj->category_id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                            @else
                            {{-- <option value="" disabled selected>Select One Category</option> --}}
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        <p class="text-danger">{{$errors->first('category_id')}}
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Made In</h5>
                    <div class="form-group m-t-20">
                        <select class="form-control" name="country_id" id="country_id">
                            @if(isset($obj))
                            @foreach($countries as $country)
                            @if($country->id == $obj->country_id)
                            <option value="{{$country->id}}" selected>{{$country->name}}</option>
                            @else
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endif
                            @endforeach
                            @else
                            {{-- <option value="" disabled selected>{{trans('setup_city.select-country')}}</option> --}}
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        <p class="text-danger">{{$errors->first('country_id')}}</p>
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

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Item Price (MMK)</h5>
                    <div class="form-group m-t-20">
                        <input type="number" min="1" class="form-control" name="price" id="price"
                            value="{{ isset($obj)? $obj->price:Request::old('price') }}" placeholder="10" required>
                        <p class="text-danger">{{$errors->first('price')}}</p>
                    </div>
                </div>

                <div class="col-md-8">
                    <h5 class="card-title m-b-0">Description </h5>
                    <div class="form-group m-t-20">
                        <textarea rows="2" cols="50" class="form-control" name="description" id="description"
                            placeholder="Enter Item Custom Features">{{ isset($obj)? $obj->description:Request::old('description') }}</textarea>
                        <p class="text-danger">{{$errors->first('description')}}</p>
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

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

            <!-- Start class='row' Br -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
            </div>

            <!-- Start class='row' One -->
            <div class="row">

                <div class="col-md-12">
                    <h5 class="card-title m-b-0">Custom Features </h5>
                    <div class="form-group m-t-20">
                        <textarea rows="7" cols="50" class="text-area form-control" name="custom_features"
                            id="custom_features"
                            placeholder="Enter Item Custom Features">{{ isset($obj)? $obj->custom_features:Request::old('custom_features') }}</textarea>
                        <p class="text-danger">{{$errors->first('custom_features')}}</p>
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

            <!-- Start class='row' Three -->
            <div class="row">

                <div class="col-md-12">
                    <h5 class="card-title m-b-0">Detail Information</h5>
                    <div class="form-group m-t-20">
                        <textarea rows="7" cols="50" class="form-control text-area" name="detail_info" id="detail_info"
                            placeholder="Enter Item Detail Information">{{ isset($obj)? $obj->detail_info:Request::old('detail_info') }}</textarea>
                        <p class="text-danger">{{$errors->first('detail_info')}}</p>
                    </div>
                </div>

            </div>
            <!-- End class='row' Three -->

            <!-- Start class='row' Three -->
            <div class="row">

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Item Image 1</h5>
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
                    <h5 class="card-title m-b-0">Item Image 2</h5>
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
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($obj))
                        Update

                        @else
                        Create
                        @endif
                    </button>
                    <button onclick="cancel_setup('item')" type="button"
                        class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @include('backend.modals.image_upload_item')
    @include('backend.modals.image_upload_item1')
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
        $('#item').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Item Name is required',
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
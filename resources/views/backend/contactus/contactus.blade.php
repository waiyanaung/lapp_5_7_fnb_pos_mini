@extends('layouts.master')
@section('title','Contact Us')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($obj))
                    Contact Us - Edit

                @else
                    Contact Us - Create
                @endif
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
        {!! Form::open(array('url' => '/backend_app/contact_us/update','id'=>'contact_us', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/contact_us/store','id'=>'contact_us', 'class'=> 'form-horizontal user-form-border','files' => true)) !!}
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
                    <button onclick="cancel_setup('contact_us')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <!-- Start class='row' One -->
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title m-b-0">First Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Contact First Name"  value="{{ isset($obj)? $obj->first_name:Request::old('first_name') }}" required readonly>
                        <p class="text-danger">{{$errors->first('first_name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Last Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Contact Us Last Name" value="{{ isset($obj)? $obj->last_name:Request::old('last_name') }}" readonly/>
                <p class="text-danger">{{$errors->first('last_name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Message sent Date</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Contact Us Message Sent Date" value="{{ isset($obj)? $obj->created_at:Request::old('created_at') }}" readonly/>
                <p class="text-danger">{{$errors->first('created_at')}}</p>
                    </div>
                </div>

                
            </div>
            <!-- End class='row' One -->

            <!-- Start class='row' Three -->
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Email</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Contact Email"  value="{{ isset($obj)? $obj->email:Request::old('first_name') }}" required readonly>
                        <p class="text-danger">{{$errors->first('email')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Phone</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact Us Phone" value="{{ isset($obj)? $obj->phone:Request::old('phone') }}" readonly/>
                <p class="text-danger">{{$errors->first('phone')}}</p>
                    </div>
                </div>               

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Status</h5>
                    <div class="form-group m-t-20">
                    <select class="form-control" name="status" id="status">
                        @if(isset($obj))
                            @if($obj->status == 1)                                
                                <option value="0"> Spam</option>
                                <option value="1" selected>Replied</option>
                                <option value="2"> Not Reply Yet</option>
                            @elseif($obj->status == 2)
                                <option value="0"> Spam</option>
                                <option value="1">Replied</option>
                                <option value="2" selected> Not Reply Yet</option>
                            @else
                                <option value="0" selected> Spam</option>
                                <option value="1" selected>Replied</option>
                                <option value="2"> Not Reply Yet</option>
                            @endif
                        @else
                            <option value="0"> Spam</option>
                            <option value="1">Replied</option>
                            <option value="2" selected> Not Reply Yet</option>
                        @endif

                    </select>
                        <p class="text-danger">{{$errors->first('status')}}</p>
                    </div>
                </div>
            </div>
            <!-- Start class='row' Two -->

            <!-- Start class='row' Three -->
            <div class="row">

                <div class="col-md-8">
                    <h5 class="card-title m-b-0">Message</h5>
                    <div class="form-group m-t-20">
                        <textarea rows="10" cols="50" class="form-control" name="detail_info" id="detail_info" placeholder="Enter Contact Us Detail Information" readonly>{{ isset($obj)? $obj->detail_info:Request::old('detail_info') }}</textarea>
                        <p class="text-danger">{{$errors->first('detail_info')}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title m-b-0">Remark</h5>
                    <div class="form-group m-t-20">
                        <textarea rows="10" cols="50" class="form-control" name="remark" id="remark" placeholder="Enter Contact Us Detail Information">{{ isset($obj)? $obj->remark:Request::old('remark') }}</textarea>
                        <p class="text-danger">{{$errors->first('remark')}}</p>
                    </div>
                </div>

            </div>
            <!-- End class='row' Two -->

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
                    <button onclick="cancel_setup('contact_us')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
        $('#contact_us').validate({
            rules: {
                name                  : 'required',
            },
            messages: {
                name                  : 'Contact Us Name is required',
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

@extends('layouts.master')
@section('title','User')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($user))
                    Password Change

                @else
                    User - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
    @if(isset($user))
        {!! Form::open(array('url' => '/backend_app/user/password/' . $user->id ,'id'=>'user', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '#','id'=>'user', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($user)? $user->id:''}}"/>

    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($user))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('user')" type="button" class="btn btn-secondary btn-md">Cancel</button>
                </div>
            </div>                     
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            
            @if(isset($user))

                <div class="row">
                    <div class="col-md-4">  
                        <h5 class="card-title m-b-0">Current Password *</h5>
                        <div class="form-group m-t-20">
                            <input type="password" autocomplete="off" class="form-control" name="current_password" id="current_password" placeholder="Enter Current Password"  value="">
                            <p class="text-danger">{{$errors->first('current_password')}}</p>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4">  
                        <h5 class="card-title m-b-0">New Password *</h5>
                        <div class="form-group m-t-20">
                            <input type="password" autocomplete="off" class="form-control" name="password" id="password" placeholder="Enter New Password"  value="">
                            <p class="text-danger">{{$errors->first('password')}}</p>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4">  
                        <h5 class="card-title m-b-0">Confirm Password *</h5>
                        <div class="form-group m-t-20">
                            <input type="password" autocomplete="off" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password"  value="">
                            <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                        </div>
                    </div>
                </div>

            @else
                <div class="row">
                    <div class="col-md-12">  
                        <h5 class="card-title m-b-0">Invalid Request for the Password Change !!!!</h5>
                    </div>  
                </div>                            
                
            @endif

            <div class="row"> 
                                               
                <div class="col-md-12"> 
                    <div class="form-group m-t-20">
                    <!-- To Insert NRIC For the User Process -->
                    <!-- @include('layouts.input_nrc') -->
                    </div>
                </div>
            </div>
            
            
        </div>        
    </div>
    
    <div class="row">                
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary btn-md">
                        @if(isset($user))
                            Update

                        @else
                            Create
                        @endif 
                    </button>
                    <button onclick="cancel_setup('user')" type="button" class="btn btn-secondary btn-md">Cancel</button>
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
        $('#user').validate({
            rules: {
                current_password                    : 'required',
                passowrd                            : 'required',
                password_confirmation                    : 'required',
            },
            messages: {
                current_password                    : 'Current Password is required',
                passowrd                            : 'New Password required',
                password_confirmation                    : 'Confirm Password is required',
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
@extends('layouts.master')
@section('title','User')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                @if(isset($user))
                    User - Edit

                @else
                    User - Create
                @endif                        
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
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
        {!! Form::open(array('url' => '/backend_app/user/update','id'=>'user', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/user/store','id'=>'user', 'class'=> 'form-horizontal user-form-border')) !!}
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
            
            <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">User Login Name *</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter User Name"  value="{{ isset($user)? $user->user_name:Request::old('user_name') }}" required>
                        <p class="text-danger">{{$errors->first('user_name')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Email *</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter User Name"  value="{{ isset($user)? $user->email:Request::old('email') }}" required>
                        <p class="text-danger">{{$errors->first('email')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">User Display Name</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Enter User Display Name"  value="{{ isset($user)? $user->display_name:Request::old('display_name') }}">
                        <p class="text-danger">{{$errors->first('display_name')}}</p>
                    </div>
                </div>
            </div>

             <div class="row">                        
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">User Role *</h5>
                    <div class="form-group m-t-20">
                        @if(isset($user))
                            <select class="form-control" name="role_id" id="role_id">
                                @foreach($roles as $role)
                                    @if($role->id == $user->role_id)
                                        <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                                    @else
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="" selected disabled>Select User Role</option>

                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        @endif
                        <p class="text-danger">{{$errors->first('role_id')}}</p>
                    </div>
                </div>

                <div class="col-md-8">  
                    <h5 class="card-title m-b-0">Address</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter User Address"  value="{{ isset($user)? $user->address:Request::old('address') }}">
                        <p class="text-danger">{{$errors->first('address')}}</p>
                    </div>
                </div>
            </div>

            <div class="row"> 
                @if(!isset($user))                                   
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">User Password *</h5>
                    <div class="form-group m-t-20">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter User Password"  value="{{ isset($user)? $user->password:Request::old('password') }}" required>
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    </div>
                </div>

                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">Confirm Password *</h5>
                    <div class="form-group m-t-20">
                        <input type="password" class="form-control" name="conpassword" id="conpassword" placeholder="Enter Confirm Password"  value="{{ isset($user)? $user->conpassword:Request::old('econpasswordmail') }}" required>
                        <p class="text-danger">{{$errors->first('conpassword')}}</p>
                    </div>
                </div>            
                @endif

                @if(isset($profile_bk))                                 
                <div class="col-md-4">  
                    <h5 class="card-title m-b-0">User Password *</h5>
                    <div class="form-group m-t-20">
                        <input type="text" class="form-control" name="password" id="password" placeholder="Enter User Password"  value="{{ isset($user)? $user->password:Request::old('password') }}" required>
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    </div>
                </div>
                @endif
            </div>

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
                name                  : 'required',
            },
            messages: {
                name                  : 'User Name is required',
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
@extends('layouts_frontend.master_frontend')
@section('title','Sign Up')

<style>

.modal.fade {
  z-index: 10000000 !important;
}

.modal-dialog {
  top: calc(10% - 200px); 
}

</style>

@section('content')
           
        </div>
    </section>

    <section>
        
        <div class="container"  style="margin-top: 8rem;"><!-- container start -->
            
        {!! Form::open(array('url' => '/register', 'class'=> 'form-horizontal', 'id'=>'registration', 'class' =>'frm_wrap')) !!}

            <div class="row rounded_div_with_shadow"><!-- row start -->

                <div div class="col-md-12">
                    <p class="text-center"><b>Sign Up</b></p>                    
                </div>
            </div><!-- row end -->

            <?php $counter = 0; ?>
            <div class="rounded_div_with_shadow">

                <div class="row">

                    <div class="col-md-4">
                        
                            <label for="user_name">User Login Name *</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter User Name for login"   autocomplete="off" value="{{ isset($user)? $user->user_name:Request::old('user_name') }}">
                            <label class="text-danger">{{$errors->first('user_name')}}</label>
                        
                    </div>
                
                    <div class="col-md-4">
                        
                            <label for="first_name">First Name *</label>
                            <input type="text" class="form-control" id="first_name" placeholder="{{trans('frontend_header.first_name')}}" name="first_name"  autocomplete="off" value="{{ isset($user)? $user->first_name:Request::old('first_name') }}">
                            <label class="text-danger">{{$errors->first('first_name')}}</label>
                        
                    </div>

                    <div class="col-md-4 pd_lf_5">
                        
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="{{trans('frontend_header.last_name')}}" name="last_name"  autocomplete="off" value="{{ isset($user)? $user->last_name:Request::old('last_name') }}">
                            <label class="text-danger">{{$errors->first('last_name')}}</label>
                        
                    </div>
                    
                </div>

               <br>

                <div class="row">

                    <div class="col-md-4">
                        
                            <label for="email">User Email *</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"  autocomplete="off" value="{{ isset($user)? $user->email:Request::old('email') }}">
                            <label class="text-danger">{{$errors->first('email')}}</label>
                        
                    </div>

                    <div class="col-md-4">
                        
                            <label for="phone">Phone *</label>
                            <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone"  autocomplete="off" value="{{ isset($user)? $user->phone:Request::old('phone') }}">
                            <label class="text-danger">{{$errors->first('phone')}}</label>
                        
                    </div>
                   
                   <div class="col-md-4 pd_lf_5">
                        
                            <label for="dob">Date of Birth *</label>
                            <input type="date" class="form-control" id="dob" ame="dob"  autocomplete="off" value="{{ isset($user)? $user->dob:Request::old('dob') }}">
                            <label class="text-danger">{{$errors->first('dob')}}</label>
                        
                   </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password"  autocomplete="off" value="{{ isset($user)? $user->password:Request::old('password') }}">
                        <label class="text-danger">{{$errors->first('password')}}</label>

                    </div>

                    <div class="col-md-4">
                        <label for="confirm_password">Confirm Password *</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password"  autocomplete="off" value="{{ isset($user)? $user->confirm_password:Request::old('confirm_password') }}">
                        <label class="text-danger">{{$errors->first('confirm_password')}}</label>
                    </div>

                    <div class="col-md-4">
                        <label for="gender">Gender *</label>
                        <br>
                        <div class="col-sm-6 gender-radio">
                            <input type="radio" id="male" class="" name="gender" value="1" checked />
                            <label for="male">Male</label>
                        </div>
                        <div class="col-sm-6 gender-radio">
                            <input type="radio" id="female" class="" name="gender"  value="2" />
                            <label for="female">Female</label>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4">
                        <label for="password">Township *</label>
                        <select class="form-control" name="township_id" id="township_id">
                            @if(isset($obj))
                                @foreach($townships as $township)
                                    @if($township->id == $obj->township_id)
                                        <option value="{{$township->id}}" selected>{{$township->name}}</option>
                                    @else
                                        <option value="{{$township->id}}">{{$township->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="" disabled>Select One Township</option>
                                @foreach($townships as $township)
                                    <option value="{{$township->id}}" 
                                            @if (old('township_id') == $township->id) selected="selected" @endif>{{$township->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label class="text-danger">{{$errors->first('township_id')}}</label>

                    </div>

                    <div class="col-md-8">
                        <label for="password">Detail Address / Shipping Address *</label>
                        <textarea rows="5" cols="45" class="form-control" name="address" id="address" placeholder="Enter  Detail Address Information">{{ isset($user)? $user->address:Request::old('address') }}</textarea>
                        <label class="text-danger">{{$errors->first('address')}}</label>
                    </div>
                </div>
                <br>

                


            <div class="row">                        
                <div class="col-md-4">  
                </div>

                <div class="col-md-4">                     
                    <button type="button" class="btn btn-default form-control register-btn" id="btn_submit">Register </button>
                </div>  

                <div class="col-md-4"> 
                </div> 
            </div>          

                <div class="formgroup">
                    <div class="col-md-12 control">
                        <div class="form_text text-center">
                            <span>{{trans('frontend_header.by_creating_an_account')}}, </span>
                            <a href="#"> Terms </a>
                        </div>
                    </div>
                </div>
                <div class="formgroup text-center">
                    <div class="col-md-12 control">
                        <div class="form_textone">
                            <span>{{trans('frontend_header.already_a_member')}}</span>
                            <a href="login" id="sign_in"> {{trans('frontend_header.login_here')}} </a>
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}


            </div>
            
        </div><!-- container end -->

    </section><!-- /.section -->
@stop

@section('page_script')

<script>

    $(document).ready(function(){
        $("#btn_submit").on("click", function (){ 

            swal({
                title: "Are you sure?",
                text: "Are you sure want to register as new user ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // swal("Poof! Your imaginary file has been deleted!", {
                    // icon: "success",
                    // });
                    $('#registration').submit();
                } else {
                    return 0;
                }
                });


        });
    });

    
</script>


@stop
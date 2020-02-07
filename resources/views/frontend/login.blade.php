<div class="modal fade myModal" id="loginModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div class="modalbody">
            <div class="col-md-12">
            <div class="imgcontainer">
                {{-- <img src="{{$companyLogo}}" width="100px"> --}}
                <button type="button" class="close" data-dimdiss="modal">⨂</button>
            </div>
            <h2 style="text-align:center;">{{trans('frontend_header.login')}}</h2>
            <div id="show-error" class="col-md-12"></div>
            <!-- <form class="form-horizontal"> -->
            {!! Form::open(array('url' => '/login', 'class'=> 'form-horizontal', 'id'=>'login')) !!}
                <div class="formgroup">
                    <div class="col-md-12 pd_lf_5">
                        <input type="email" class="formcontrols" id="login_email" placeholder="{{trans('frontend_header.email_address')}}" name="email">
                    </div>
                </div>
                <div class="formgroup">
                    <div class="col-md-12 pd_lf_5">
                        <input type="password" class="formcontrols" id="login_password" placeholder="{{trans('frontend_header.password')}}" name="password">
                    </div>
                </div>
                <div class="col-md-12 pd_lf_5">
                   <!-- <button type="submit" class="btn btn-default formcontrolnew">Login</button> -->
                   <button type="button" class="btn btn-default formcontrols login-btn">{{trans('frontend_header.login')}}</button>
                </div>
                {{--  <div class="col-md-12 pd_lf_5 form_text">
                    <span class="psw"><a href="#">{{trans('frontend_header.forget_password')}}</a></span>
                </div>  --}}
                <div class="formgroup text-center">
                    <div class="col-md-12 control">
                        <div class="form_textone">
                            <a href="/register" style="text-decoration:underline;" id="sign_up"> {{trans('frontend_header.not_a_member')}} {{trans('frontend_header.create_account')}} </a>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
            {!! Form::close() !!}
        </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
</div>
<!-- start login ajax-->
<script>
    $(document).ready(function(){
        function showRegister(){
            $("#loginModal").removeClass("fade").modal("hide");
            $("#registerModal").modal("show").addClass("fade");
        }
        $('#sign_up').click(function(){
            showRegister();
        });

    });
</script>
<script>
    $(document).ready(function(){
        $('.login-btn').click(function(){
            var serializedData = $('#login').serialize();
            // console.log('serialll-login '+serializedData);
            $.ajax({
                url: '/login',
                type: 'POST',
                data: serializedData,
                success: function(data){
                    if(data.laravelStatusCode == '200'){
                        location.reload(true);
                    }
                    else if(data.laravelStatusCode == '401'){
                        $('.alert').remove();
                        var showError    = '<p class="alert alert-danger">';
                        showError       += 'Email or password is incorrect!';
                        showError       += '</p>';
                        $('#show-error').append(showError);
                        return;
                    }
                    else{
                        swal({title: "Fail", text: "Login Fail!Please Try Again!", type: "error"},
                                function(){
                                    location.reload();
                                }
                        );
                        return;
                    }

                },
                error: function(data){
                    swal({title: "Opps", text: "Sorry, Please Try Again!", type: "error"},
                            function(){
                                location.reload();
                            }
                    );
                    return;
                }
            });
        });
    });
</script>
<!-- end login ajax-->

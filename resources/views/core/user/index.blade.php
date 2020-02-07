@extends('layouts.master')
@section('title','User')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">User Module</h4>
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

    <div class="row">
        <div class="col-12">
            <div class="text-right">
                <div class="card">
                    <div class="card-body">
                    <button type="button" onclick='create_setup("user");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("user");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="multiple_activate_setup('user');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_multiple_setup('user');"  class="btn btn-danger btn-md">Delete</button>
                    </div>                           
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_user' ,'url' => 'backend_app/user/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}
        <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor"><input type='checkbox' name='check' id='check_all' class="custom_checkbox"/></th>
                                    <th class="bg_n_fontcolor">Login User Name</th>
                                    <th class="bg_n_fontcolor">Display Name</th>
                                    <th class="bg_n_fontcolor">Email</th>
                                    <th class="bg_n_fontcolor">Role</th>
                                    <th class="bg_n_fontcolor">NRIC</th>
                                    <th class="bg_n_fontcolor">Status</th>
                                    <th class="bg_n_fontcolor">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><input type="checkbox" class="check_source custom_checkbox" name="edit_check[]" value="{{ $user->id }}" id="all"></td>
                                        <td><a href="/backend_app/user/edit/{{$user->id}}">{{$user->user_name}}</a></td>
                                        <td>{{$user->display_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name}}</td>

                                        @if(isset($user->nrc_division))
                                        <td>{{$user->nrc_division}}/{{$user->nrc_township1}}{{$user->nrc_township2}}{{$user->nrc_township3}}({{$user->nrc_national}}){{$user->nrc_number}}</td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if($user->status == 2)
                                        <td><strong><p class="text-danger text-uppercase">Deleted</p></strong></td>
                                        @elseif($user->status == 1)
                                        <td><strong><p class="text-primary">Active</p></strong></td>
                                        @else
                                        <td><strong><p class="text-secondary text-uppercase">In-Active</p></strong></td>
                                        @endif
                                
                                        @if($user->status == 1)

                                        <td>
                                        {!! Form::open(array('id'=> 'frm_' . $user->id ,'url' => '/backend_app/user/disable')) !!}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{isset($user)? $user->id:''}}"/>
                                            <!-- <a href="/backend_app/user/disable/{{$user->id}}" class="btn btn-danger">Deactive</a> -->
                                            <!-- <button type="submit" class="btn btn-secondary btn-md">Deactivate</button> -->
                                            <button type="button" id="{{isset($user)? $user->id:''}}" onclick="disable(this.id)" class="btn btn-secondary btn-md">Deactivate</button>
                                        {!! Form::close() !!}
                                        </td>
                                        @else
                                        <td>
                                            {!! Form::open(array('id'=> 'frm_' . $user->id ,'url' => '/backend_app/user/enable')) !!}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{isset($user)? $user->id:''}}"/>
                                            <!-- <a href="/backend_app/user/enable/{{$user->id}}" class="btn btn-success">Active</a> -->
                                            <!-- <button type="submit" class="btn btn-info btn-md">Activate</button> -->
                                            <button type="button" id="{{isset($user)? $user->id:''}}" onclick="enable(this.id)" class="btn btn-info btn-md">Activate</button>
                                            {!! Form::close() !!}
                                        </td>
                                        @endif
                                        </tr>

                                    </tr>
                                @endforeach                    
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>        
        {!! Form::close() !!}   
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="text-right">
                <div class="card">
                    <div class="card-body">
                    <button type="button" onclick='create_setup("user");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("user");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="activate_setup('user');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_multiple_setup('user');"  class="btn btn-danger btn-md">Delete</button>
                    </div>                           
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer') 
<script type="text/javascript">
    $(document).ready(function(){
        $('#zero_config').DataTable({
            "pagingType": "full_numbers",
            "language": {
                "paginate": {
                "first": "|<",
                "previous": "<<",
                "next": ">>",
                "last": ">|"
                }
            }
        });
    });
    

    function enable(id) {
        swal({
            title: "Are you sure?",
            text: "To proceed the Re-Activation .",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                // $("#frm_" + type).attr('action', type + "/multipleenable");
                // $("#frm_" + type).attr('method', "POST");
                // $("#selected_checkboxes").val(data);
                $("#frm_" + id).submit();
            } else {
                return;
            }
        });
    }

    function disable(id) {
        swal({
            title: "Are you sure?",
            text: "To proceed the Deactivation !!!!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                // $("#frm_" + type).attr('action', type + "/multipleenable");
                // $("#frm_" + type).attr('method', "POST");
                // $("#selected_checkboxes").val(data);
                $("#frm_" + id).submit();
            } else {
                return;
            }
        });
    }
</script>
@stop

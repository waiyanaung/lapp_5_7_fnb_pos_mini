@extends('layouts.master')
@section('title','Contact  Us')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Contact  Us Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact  Us</li>
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
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body">
                    <button type="button"  onclick='edit_setup("contactus");' class="btn btn-primary btn-md">Edit</button>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_contact_us' ,'url' => 'backend_app/contact_us/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}
        <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contact  Us List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor"><input type='checkbox' name='check' id='check_all' class="custom_checkbox"/></th>
                                    <th class="bg_n_fontcolor">First Name</th>
                                    <th class="bg_n_fontcolor">Last Name</th>
                                    <th class="bg_n_fontcolor">Phone</th>
                                    <th class="bg_n_fontcolor">Email</th>
                                    <th class="bg_n_fontcolor">Status</th>
                                    <th class="bg_n_fontcolor">Remark</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($objs as $boj)
                                    <tr>
                                        <td><input type="checkbox" class="custom_checkbox check_source" name="edit_check[]" value="{{ $boj->id }}" id="all"></td>

                                        
                                        <td><a href="/backend_app/contact_us/edit/{{$boj->id}}">{{$boj->first_name}}</a></td>
                                        <td><a href="/backend_app/contact_us/edit/{{$boj->id}}">{{$boj->last_name}}</a></td>
                                        <td><a href="/backend_app/contact_us/edit/{{$boj->id}}">{{$boj->phone}}</a></td>
                                        <td><a href="/backend_app/contact_us/edit/{{$boj->id}}">{{$boj->email}}</a></td>
                                        @if($boj->status == 1)
                                        <td><strong><p class="text-primary">Replied</p></strong></td>
                                        @elseif($boj->status == 2)
                                        <td><strong><p class="text-danger">Not Reply Yet</p></strong></td>
                                        @else
                                        <td><strong><p class="text-second">Spam</p></strong></td>
                                        @endif

                                        <td>{{$boj->remark}}</td>
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
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body">
                    <button type="button"  onclick='edit_setup("contact_us");' class="btn btn-primary btn-md">Edit</button>
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
</script>
@stop

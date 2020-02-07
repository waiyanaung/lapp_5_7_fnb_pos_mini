@extends('layouts.master')
@section('title','Township')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Township Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Township</li>
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
                    <button type="button" onclick='create_setup("township");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("township");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="activate_setup('township');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_setup('township');"  class="btn btn-danger btn-md">Deactivate</button>
                </div>                           
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_township' ,'url' => 'backend_app/township/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}
        <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Township List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor"><input type='checkbox' name='check' id='check_all' class="custom_checkbox"/></th>
                                    <th class="bg_n_fontcolor">Code</th>                                    
                                    <th class="bg_n_fontcolor">Name</th>
                                    <th class="bg_n_fontcolor">Status</th>
                                    <th class="bg_n_fontcolor">City</th>
                                    <th class="bg_n_fontcolor">Description</th>
                                    <th class="bg_n_fontcolor">Remark</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($townships as $township)
                                    <tr>
                                        <td><input type="checkbox" class="custom_checkbox check_source" name="edit_check[]" value="{{ $township->id }}" id="all"></td>

                                        <td>{{$township->code}}</td>
                                        <td><a href="/backend_app/township/edit/{{$township->id}}">{{$township->name}}</a></td>
                                        @if($township->status == 1)
                                        <td><strong><p class="text-primary">Active</p></strong></td>
                                        @else
                                        <td><strong><p class="text-danger">In-Active</p></strong></td>
                                        @endif
                                        
                                        <td>{{$township->city->name}}</td>
                                        <td>{{$township->description}}</td>
                                        <td>{{$township->remark}}</td>
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
                    <button type="button" onclick='create_setup("township");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("township");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="activate_setup('township');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_setup('township');"  class="btn btn-danger btn-md">Deactivate</button>
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

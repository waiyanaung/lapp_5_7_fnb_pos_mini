@extends('layouts.master')
@section('title','Permission')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Permission Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permission</li>
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
        {!! Form::open(array('id'=> 'frm_permission' ,'url' => 'backend_app/permission/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Permission List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor">Module</th>
                                    <th class="bg_n_fontcolor">name / action</th>
                                    <th class="bg_n_fontcolor">url</th>
                                    <th class="bg_n_fontcolor">descriptionrl</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->module}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->url}}</td>
                                        <td>{{$permission->description}}</td>
                                    </tr>
                                @endforeach                    
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>        
        {!! Form::close() !!}   
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

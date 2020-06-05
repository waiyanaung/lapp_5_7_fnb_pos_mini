@extends('layouts.master')
@section('title','Document')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Document Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Document</li>
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
                    <button type="button" onclick='create_setup("document");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("document");' class="btn btn-warning btn-md">Edit</button>
                    <button type="button" onclick="delete_setup('document');"  class="btn btn-danger btn-md">Delete</button>
                </div>                           
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_document' ,'url' => 'backend_app/document/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Document List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor"><input type='checkbox' name='check' id='check_all' class="custom_checkbox"/></th>
                                    <th class="bg_n_fontcolor">Name</th>
                                    <th class="bg_n_fontcolor">Code</th>
                                    <th class="bg_n_fontcolor">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $document['id'] }}" id="all"></td>
                                        <td><a href="">{{$document['name'] }}</a></td>
                                        <td>{{$document['code']}}</td>
                                        <td>{{$document['description']}}</td>
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
                    <button type="button" onclick='create_setup("document");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("document");' class="btn btn-warning btn-md">Edit</button>
                    <button type="button" onclick="delete_setup('document');"  class="btn btn-danger btn-md">Delete</button>
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

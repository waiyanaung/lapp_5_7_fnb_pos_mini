<?php
$user_info      = \App\Core\Check::getInfo();
$user_roleId = $user_info['userRoleId'];
?>

@extends('layouts.master')
@section('title','Checklist upload')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Checklist upload Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checklist upload</li>
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
                    <button type="button" style="min-width: 150px;" onclick='create_setup("checklistupload");' class="btn btn-primary btn-md">New</button>
                    <!-- <button type="button"  onclick='edit_setup("checklistupload");' class="btn btn-warning btn-md">Edit</button>
                    <button type="button" onclick="delete_setup('checklistupload');"  class="btn btn-danger btn-md">Delete</button> -->
                </div>                           
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_checklistupload' ,'url' => 'backend_app/checklistupload/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
        {{ csrf_field() }}

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Checklist upload List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">

                        
                            <thead>
                                <tr id="">
                                    <th class="bg_n_fontcolor">Document Code</th>
                                    <th class="bg_n_fontcolor">Project Name</th>
                                    <th class="bg_n_fontcolor">Status</th>
                                    <th class="bg_n_fontcolor">Submitted By</th>
                                    <th class="bg_n_fontcolor">Inspected By</th>
                                    <th class="bg_n_fontcolor">Verified By</th>

                                    @if($user_roleId == 1 || $user_roleId == 2 || $user_roleId == 3 || $user_roleId == 4)
                                        <th class="bg_n_fontcolor">Action</th>
                                    @endif
                                </tr>

                                <tr id="filters">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    @if($user_roleId == 1 || $user_roleId == 2 || $user_roleId == 3 || $user_roleId == 4)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($checklistuploads as $checklistupload)
                                    <tr>
                                        <td><a href="/backend_app/checklistupload/edit/{{$checklistupload['id']}}">{{$checklistupload['document_code']}}</a></td>
                                        <td>{{$checklistupload['project_name']}}</td>
                                        <td>{{$checklistupload['status_string']}}</td>
                                        <td>{{$checklistupload['submitted_by']}}</td>
                                        <td>{{$checklistupload['inspected_by']}}</td>
                                        <td>{{$checklistupload['verified_by']}}</td>

                                        @if($user_roleId == 1 || $user_roleId == 2 || $user_roleId == 3 || $user_roleId == 4)
                                            <td>
                                            @if($checklistupload['status'] == 1)
                                            <a href="/backend_app/checklistupload/edit/{{$checklistupload['id']}}" class="btn btn-danger btn-md">To Inspect</a>
                                            @endif
                                            @if($checklistupload['status'] == 3)
                                            <a href="/backend_app/checklistupload/edit/{{$checklistupload['id']}}" class="btn btn-danger btn-md">To Verify</a>
                                            @endif
                                            </td>
                                        @endif
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
                    <button type="button" style="min-width: 150px;" onclick='create_setup("checklistupload");' class="btn btn-primary btn-md">New</button>
                    <!-- <button type="button"  onclick='edit_setup("checklistupload");' class="btn btn-warning btn-md">Edit</button>
                    <button type="button" onclick="delete_setup('checklistupload');"  class="btn btn-danger btn-md">Delete</button> -->
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
    // $(document).ready(function(){
    //     $('#zero_config').DataTable({
    //         "pagingType": "full_numbers",
    //         "language": {
    //             "paginate": {
    //             "first": "|<",
    //             "previous": "<<",
    //             "next": ">>",
    //             "last": ">|"
    //             }
    //         }
    //     });
    // });

    // $(document).ready(function() {
    //     $('#zero_config').DataTable( {
    //         initComplete: function () {
    //             this.api().columns().every( function () {
    //                 var column = this;
    //                 var select = $('<select><option value=""></option></select>')
    //                     .appendTo( $(column.thead()).empty() )
    //                     .on( 'change', function () {
    //                         var val = $.fn.dataTable.util.escapeRegex(
    //                             $(this).val()
    //                         );
    
    //                         column
    //                             .search( val ? '^'+val+'$' : '', true, false )
    //                             .draw();
    //                     } );
    
    //                 column.data().unique().sort().each( function ( d, j ) {
    //                     select.append( '<option value="'+d+'">'+d+'</option>' )
    //                 } );
    //             } );
    //         }
    //     } );
    // });
    

        $(document).ready(function(){ 
        $('#zero_config').DataTable({
            responsive: true,
            ordering: false,
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;

                    var select = $('<select style="min-width: 150px;"><option value=""></option></select>')
                        .appendTo($("#filters").find("th").eq(column.index()))
                        .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val());                                     

                        column.search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                    console.log(select);

                    column.data().unique().sort().each(function (d, j) {
                        $(select).append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        });
</script>
@stop

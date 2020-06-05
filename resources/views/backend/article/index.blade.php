@extends('layouts.master')
@section('title','Article')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Article Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Article</li>
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
                    <button type="button" onclick='create_setup("article");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("article");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="activate_setup('article');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_setup('article');"  class="btn btn-danger btn-md">Deactivate</button>
                </div>                           
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        {!! Form::open(array('id'=> 'frm_article' ,'url' => 'backend_app/article/destroy', 'class'=> 'form-horizontal article-form-border')) !!}
        {{ csrf_field() }}
        <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Article List</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor"><input type='checkbox' name='check' id='check_all' class="custom_checkbox"/></th>
                                    <th class="bg_n_fontcolor">Code</th>
                                    <th class="bg_n_fontcolor">status</th>
                                    <th class="bg_n_fontcolor">Name</th>
                                    <th class="bg_n_fontcolor">Detail Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td><input type="checkbox" class="check_source custom_checkbox" name="edit_check[]" value="{{ $article->id }}" id="all"></td>
                                        <td><a href="/backend_app/article/edit/{{$article->id}}">{{$article->code}}</a></td>

                                        @if($article->status == 1)
                                        <td><strong><p class="text-primary">Active</p></strong></td>
                                        @else
                                        <td><strong><p class="text-danger">In-Active</p></strong></td>
                                        @endif

                                        <td><a href="/backend_app/article/edit/{{$article->id}}">{{$article->name}}</a></td>
                                        <td>{!! $article->detail_info !!}</td>
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
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body">
                    <button type="button" onclick='create_setup("article");' class="btn btn-primary btn-md">New</button>
                    <button type="button"  onclick='edit_setup("article");' class="btn btn-primary btn-md">Edit</button>
                    <button type="button" onclick="activate_setup('article');"  class="btn btn-primary btn-md">Activate</button>
                    <button type="button" onclick="delete_setup('article');"  class="btn btn-danger btn-md">Deactivate</button>
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

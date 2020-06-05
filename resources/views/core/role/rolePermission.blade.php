@extends('layouts.master')
@section('title','Role Permissions')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Role's Permissions Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role's Permissions</li>
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
                <div class="card-body border-top">
                    <a href="/backend_app/role" class="btn btn-primary btn-md">
                       Back to Role List
                    </a>
                </div>
            </div>                     
        </div>
    </div>

    <div class="row">
        <div class="col-12">     

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Role's detail information</h5>
                    <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><b>Role Name</b></th>
                        <th><b>Role Description</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                    </tr>         
                </tbody>                            
            </table>                    
                </div>
            </div>          

        </div>
    </div>

    
<div class="row">
        <div class="col-12">
     

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Role's Permissions</h5> 

                     <div id="accordion">
               @foreach ($features_permissions as $feature_permission)
                <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#{{$feature_permission['feature']['module']}}">
                    <b>{{$feature_permission['feature']['module']}}</b>
                    </a>
                </div>
                <div id="{{$feature_permission['feature']['module']}}" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    
                                </thead>

                                {!! Form::open(array('url' => 'backend_app/rolePermissionAssign/'.$role->id, 'method'=>'POST','class'=> 'form-horizontal user-form-border', 'data-parsley-validate'=>'true')) !!}
                                <tbody>
                                @foreach($feature_permission['permissions'] as $permission)
                                <tr>
                                    @if($permission['checked'])
                                    <td>{{$permission['name']}} - {{$permission['descr']}}</td>
                                    <td>
                                        <input type="hidden" name="permission_{{$permission['id']}}" value="off">
                                        <input name="permission_{{$permission['id']}}" type="checkbox" class="custom_checkbox" data-render="switchery" data-theme="default" checked /></td>
                                        @else
                                        <td>{{$permission['name']}} - {{$permission['descr']}}</td>
                                        <td>
                                            <input type="hidden" name="permission_{{$permission['id']}}" value="off">
                                            <input name="permission_{{$permission['id']}}" type="checkbox" class="custom_checkbox" data-render="switchery" data-theme="default" /></td>
                                            @endif
                                            <input type="hidden" name="module" id="module" value="{{$feature_permission['feature']['module']}}">

                                        </tr>
                                        @endforeach
                                    </tbody>                                                           
                            </table>
                            <div class="text-right">
                                <button type="submit" onclick=""  class="btn btn-danger btn-md">Apply the Changes</button>
                            </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                @endforeach
                </div>

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
        
    });
</script>
@stop

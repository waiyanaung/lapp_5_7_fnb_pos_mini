@extends('layouts.master')
@section('title','Dashboard')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        <div class="col-md-4 text-right">
            <a href="/backend_app/item">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">{{ $itemCount }} - Items</h6>
                            </div>
                        </div>
                    </div>
                </div>                           
            </div>
            </a>
        </div>

        <div class="col-md-4 text-right">
            <a href="/backend_app/category">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">{{ $categoryCount }} - Categories</h6>
                            </div>
                        </div>
                    </div>
                </div>                           
            </div>
            </a>
        </div>

        <div class="col-md-4 text-right">
            <a href="/backend_app/brand">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">{{ $brandCount }} - Brands</h6>
                            </div>
                        </div>
                    </div>
                </div>                           
            </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 text-right">
            <a href="/backend_app/user">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">{{ $userCount }} - Users</h6>
                            </div>
                        </div>
                    </div>
                </div>                           
            </div>
            </a>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

@stop
@section('page_script_footer') 
@stop

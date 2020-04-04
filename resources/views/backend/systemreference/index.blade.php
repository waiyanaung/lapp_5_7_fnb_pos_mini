@extends('layouts.master')
@section('title','Site Reference')
@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
                Site Reference - Module
            </h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Site Reference</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<br>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<div class="container-fluid">

    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">Investment</a></li>
        <li><a data-toggle="pill" href="#menu1">Loan Request</a></li>
        <li><a data-toggle="pill" href="#menu2">Loan Return</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h4>Investment Statuses</h4>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Value</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Rejected</td>
                        <td>0</td>
                        <td>Reject action is only for Admin</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Confirm</td>
                        <td>1</td>
                        <td>Confirm by the investor</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Pending</td>
                        <td>2</td>
                        <td>First stage by the investor</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h4>Client Loan Statuses</h4>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Value</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Rejected</td>
                        <td>0</td>
                        <td>Reject action is only for Admin</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Confirm</td>
                        <td>1</td>
                        <td>Confirm by the investor</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Pending</td>
                        <td>2</td>
                        <td>First stage by the client - client apply stage</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Approved</td>
                        <td>3</td>
                        <td>Approved by Admin</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h4>Client Loan Return Statuses</h4>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Value</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Rejected</td>
                        <td>0</td>
                        <td>Reject action is only for Admin</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Confirm</td>
                        <td>1</td>
                        <td>Confirm by the investor</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Pending</td>
                        <td>2</td>
                        <td>First stage by the investor</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
@section('page_script_footer')

@stop
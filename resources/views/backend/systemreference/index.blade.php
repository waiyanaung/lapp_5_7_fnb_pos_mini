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
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
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
        <li class="active"><a data-toggle="pill" href="#home">Transaction</a></li>
        <li><a data-toggle="pill" href="#menu1">Transaction Item</a></li>
        <li><a data-toggle="pill" href="#menu2">Transaction Payment Header</a></li>
        <li><a data-toggle="pill" href="#menu3">Transaction Payment Detail</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <br>
            <h6>Transaction Statuses</h6>
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
                        <td class="bg_n_fontcolor">1</th>
                        <td class="bg_n_fontcolor">Cancel   /  Void</td>
                        <td class="bg_n_fontcolor">0</td>
                        <td class="bg_n_fontcolor">Cancel or Void this Transaction</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                        <td class="bg_n_fontcolor">Pending</td>
                        <td class="bg_n_fontcolor">1</td>
                        <td class="bg_n_fontcolor">Transaction is Pending stage</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                       <td  class="bg_n_fontcolor">Confirm</td>
                       <td  class="bg_n_fontcolor">2</td>
                       <td  class="bg_n_fontcolor">Confirmed Transaction</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="menu1" class="tab-pane fade">
            <br>
            <h6>Transaction Item Statuses</h6>
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
                        <td class="bg_n_fontcolor">1</th>
                        <td class="bg_n_fontcolor">Cancel   /  Void</td>
                        <td class="bg_n_fontcolor">0</td>
                        <td class="bg_n_fontcolor">Cancel or Void this Transaction</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                        <td class="bg_n_fontcolor">Pending</td>
                        <td class="bg_n_fontcolor">1</td>
                        <td class="bg_n_fontcolor">Transaction is Pending stage</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                       <td  class="bg_n_fontcolor">Confirm</td>
                       <td  class="bg_n_fontcolor">2</td>
                       <td  class="bg_n_fontcolor">Confirmed Transaction</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="menu2" class="tab-pane fade">
            <br>
            <h6>Transaction Payment Header Statuses</h6>
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
                        <td class="bg_n_fontcolor">1</th>
                        <td class="bg_n_fontcolor">Cancel   /  Void</td>
                        <td class="bg_n_fontcolor">0</td>
                        <td class="bg_n_fontcolor">Cancel or Void this Transaction</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                        <td class="bg_n_fontcolor">Pending</td>
                        <td class="bg_n_fontcolor">1</td>
                        <td class="bg_n_fontcolor">Transaction is Pending stage</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                       <td  class="bg_n_fontcolor">Confirm</td>
                       <td  class="bg_n_fontcolor">2</td>
                       <td  class="bg_n_fontcolor">Confirmed Transaction</td>
                    </tr>

                    <tr>
                        <td class="bg_n_fontcolor">3</th>
                       <td  class="bg_n_fontcolor">Not Started Yet</td>
                       <td  class="bg_n_fontcolor">3</td>
                       <td  class="bg_n_fontcolor">There is no payemnt stage</td>
                    </tr>

                    <tr>
                        <td class="bg_n_fontcolor">4</th>
                       <td  class="bg_n_fontcolor">In Progress</td>
                       <td  class="bg_n_fontcolor">4</td>
                       <td  class="bg_n_fontcolor">Payment started but not complete</td>
                    </tr>

                    <tr>
                        <td class="bg_n_fontcolor">4</th>
                       <td  class="bg_n_fontcolor">Completed</td>
                       <td  class="bg_n_fontcolor">4</td>
                       <td  class="bg_n_fontcolor">Payment Completed</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="menu3" class="tab-pane fade">
            <br>
            <h6>Transaction Payment Detail Statuses</h6>
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
                        <td class="bg_n_fontcolor">1</th>
                        <td class="bg_n_fontcolor">Cancel   /  Void</td>
                        <td class="bg_n_fontcolor">0</td>
                        <td class="bg_n_fontcolor">Cancel or Void this Transaction</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                        <td class="bg_n_fontcolor">Pending</td>
                        <td class="bg_n_fontcolor">1</td>
                        <td class="bg_n_fontcolor">Transaction is Pending stage</td>
                    </tr>
                    <tr>
                        <td class="bg_n_fontcolor">2</th>
                    <td  class="bg_n_fontcolor">Confirm</td>
                    <td  class="bg_n_fontcolor">2</td>
                    <td  class="bg_n_fontcolor">Confirmed Transaction</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop
@section('page_script_footer')

@stop
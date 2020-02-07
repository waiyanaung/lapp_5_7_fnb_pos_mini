@extends('layouts.master')
@section('title','Activities')
@section('content')
     
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Activity Module</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activity</li>
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
     

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Activity Logs by Dates</h5>                    
                </div>
            </div>          

        </div>
    </div>



    <div class="row">
        <div class="col-12">
     

            <div id="accordion">

@foreach($logArray as $date=>$logs)
<div class="card">
  <div class="card-header">
    <a class="card-link" data-toggle="collapse" href="#{{$date}}">
      {{$date}}
    </a>
  </div>
  <div id="{{$date}}" class="collapse" data-parent="#accordion">
    <div class="card-body">
        <div class="table">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{{$date.' Activities'}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{$log}}</td>
                    </tr>
                    @endforeach           
                </tbody>                            
            </table>
        </div>
    </div>
  </div>
  @endforeach
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

@extends('layouts.master')
@section('title','Expense')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Expense Report</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/backend_app">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expense</li>
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


    {!! Form::open(array('url' => '/backend_app/report/expense','id'=>'frm_expense',)) !!}

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-body">
                    <button type="button" onclick='form_submit("view");' class="btn btn-primary btn-md">View</button>
                    <button type="button" onclick='create_setup("expense");' class="btn btn-primary btn-md">Export
                        Excel</button>
                    <button type="button" onclick='create_setup("expense");' class="btn btn-primary btn-md">Export
                        PDF</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <!-- Start class='row' One -->
                    <div class="row">

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">From Date</h5>
                            <div class="form-group m-t-20">
                                @if($from_date == null )
                                    <input class="form-control" type="text" id="from_date" name="from_date" autocomplete="off">
                                @else
                                    <input class="form-control" type="text" id="from_date" name="from_date" autocomplete="off" value="{{$from_date}}">                                    
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">To Date</h5>
                            <div class="form-group m-t-20">
                                @if($to_date == null )
                                    <input class="form-control" type="text" id="to_date" name="to_date" autocomplete="off">
                                @else
                                    <input class="form-control" type="text" id="to_date" name="to_date" autocomplete="off" value="{{$to_date}}">                                    
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- End class='row' One -->

                    <!-- Start class='row' Br -->
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>

                    <!-- Start class='row' Two -->
                    <div class="row">

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Expense Type</h5>
                            <div class="form-group m-t-20">

                                <select name="expense_type_id[]" id="expense_type_id"
                                    data-placeholder="Choose a Expense Type ..." class="chosen-select form-control"
                                    multiple tabindex="3">

                                    @if($selected_expense_type_ids == null )
                                        @foreach($expense_types as $expense_type)
                                            <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($expense_types as $expense_type)
                                            @if (in_array($expense_type->id, $selected_expense_type_ids))
                                            <option value="{{$expense_type->id}}" selected>{{$expense_type->name}}</option>
                                            @else
                                            <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h5 class="card-title m-b-0">Expense Currency Type</h5>
                            <div class="form-group m-t-20">
                                <select name="currency_id[]" id="currency_id"
                                    data-placeholder="Choose a Currency Type ..." class="chosen-select form-control"
                                    multiple tabindex="3">

                                    @if($selected_currency_ids == null )
                                        @foreach($currency_types as $currency_type)
                                            <option value="{{$currency_type->code}}">{{$currency_type->code}}</option>
                                        @endforeach
                                    @else
                                        @foreach($currency_types as $currency_type)
                                            @if (in_array($currency_type->code, $selected_currency_ids))
                                            <option value="{{$currency_type->code}}" selected>{{$currency_type->code}}</option>
                                            @else
                                            <option value="{{$currency_type->code}}">{{$currency_type->code}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- End class='row' Two -->


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {!! Form::open(array('id'=> 'frm_expense' ,'url' => 'backend_app/expense/destroy', 'class'=>
            'form-horizontal obj-form-border')) !!}
            {{ csrf_field() }}

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Expense List</h5>
                    <div class="table-responsive">
                        <table id="zero_configs" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor">No.</th>
                                    <th class="bg_n_fontcolor">Name</th>
                                    <th class="bg_n_fontcolor">Type</th>
                                    <th class="bg_n_fontcolor">Date</th>

                                    <?php $col_count = 4; ?>

                                    <?php $currency_amounts = array(); ?>
                                    @foreach ($currency_types as $key => $currency_type)
                                    <th class="bg_n_fontcolor">{{ $currency_type->code}}</th>
                                    <?php 
                                            $currency_amounts[$key] = 0; 
                                            $col_count++;
                                        ?>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($objs) && count($objs)>0)

                                <?php 
                                $counter = 1;
                                $total = 0;
                                ?>
                                @foreach($objs as $key => $obj)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td><a href="/backend_app/expense/{{$obj->id}}">{{$obj->name}}</a></td>

                                    <td>
                                        <a
                                            href="/backend_app/expense/{{$obj->id}}">{{ $expense_types[$obj->expense_type_id]->name }}</a>
                                    </td>

                                    <td>
                                        <a href="/backend_app/expense/{{$obj->id}}">{{$obj->date}}</a>
                                    </td>

                                    @foreach ($currency_types as $key2 => $currency_type2)
                                    <td>
                                        @if($obj->currency_id == $currency_type2->code)
                                        <a href="/backend_app/expense/{{$obj->id}}">{{$obj->amount}}</a>
                                        <?php $currency_amounts[$key2] = $currency_amounts[$key2] + $obj->amount; ?>
                                        @endif
                                    </td>
                                    @endforeach

                                </tr>
                                <?php $counter++; 
                                    $total = $total + $obj->amount; 
                                    ?>
                                @endforeach

                                {{-- for grand total - start --}}
                                <tr>
                                    <td colspan="4
                                    " class="text-right"><b>Grand Total</b></td>

                                    @foreach ($currency_types as $key3 => $currency_type3)
                                    <td class="text-right">
                                        {{ $currency_type3->code }}
                                        <?php echo number_format( (float) $currency_amounts[$key3], 2, '.', ''); ?>
                                    </td>
                                    @endforeach

                                </tr>
                                {{-- for grand total - end --}}
                                @else
                                <td colspan="{{$col_count}}" class="text-center">
                                    <b>There is no records about your searching filters !!! </b>
                    </div>

                    @endif

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
                <button type="button" onclick='form_submit("view");' class="btn btn-primary btn-md">View</button>
                <button type="button" onclick='create_setup("expense");' class="btn btn-primary btn-md">Export
                    Excel</button>
                <button type="button" onclick='create_setup("expense");' class="btn btn-primary btn-md">Export
                    PDF</button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
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


        $(".chosen-select").chosen();
        
        var dateFormat = "yy-mm-dd",
        from_date = $( "#from_date" )
            .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 3
            })
            .on( "change", function() {
            to_date.datepicker( "option", "minDate", getDate( this ) );
            }),
        to_date = $( "#to_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 3
        })
        .on( "change", function() {
            from_date.datepicker( "option", "maxDate", getDate( this ) );
        });
    
        function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }
    
        return date;
        }

    });

    function form_submit(type) {
        $("#frm_expense").submit();
    }

</script>
@stop
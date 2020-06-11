<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Expense Summary Report/title>
</head>

<body>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="table_responsive" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th colspan=2>Expense Summary Report</th>
                            </tr>
                            <tr>
                                <th class="font_size_10" colspan=2>Generated at {{ date('D-M-Y H:i:s') }}</th>
                            </tr>
                        </thead>

                        <tr>
                            <td>
                                <b> From Date</b>
                            </td>

                            <td>
                                <b> To Date</b>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input class="form-control" type="text" id="from_date" name="from_date" autocomplete="off" value="{{$from_date}}">                                    
                                
                            </td>

                            <td>
                                <input class="form-control" type="text" id="to_date" name="to_date" autocomplete="off" value="{{$to_date}}">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <b> Expense Type</b>
                            </td>

                            <td>
                                <b> Currency Type</b>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                @if($selected_expense_type_ids == null )
                                    <input class="form-control" type="text" id="expense_type_id" name="expense_type_id" autocomplete="off" value="All Expense Types">
                                @else
                                    <ul>
                                    @foreach($expense_types as $expense_type)
                                        @if (in_array($expense_type->id, $selected_expense_type_ids))
                                            <li>{{$expense_type->name}}</li>
                                        @endif
                                    @endforeach
                                    </ul>
                                @endif
                            </td>

                            <td>
                                @if($selected_currency_ids == null )
                                    <input class="form-control" type="text" id="currency_id" name="currency_id" autocomplete="off" value="All Currency Types">
                                @else
                                    <ul>
                                    @foreach($currency_types as $currency_type)
                                        @if (in_array($currency_type->code, $selected_currency_ids))
                                        <li>{{$currency_type->code}}</li>
                                        @endif
                                    @endforeach
                                    </ul>
                                @endif
                            
                            </td>
                        </tr>


                
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <br><br>

                        <table id="table_responsive" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg_n_fontcolor">No.</th>
                                    <th class="bg_n_fontcolor">Name</th>
                                    <th class="bg_n_fontcolor">Type</th>
                                    <th class="bg_n_fontcolor">Date</th>

                                    <?php $col_count = 4; ?>

                                    <?php $currency_amounts = array(); ?>
                                    @if($selected_currency_ids == null )
                                    @foreach ($currency_types as $key => $currency_type)
                                    <th class="bg_n_fontcolor">{{ $currency_type->code}}</th>
                                    <?php 
                                                $currency_amounts[$key] = 0; 
                                                $col_count++;
                                        ?>
                                    @endforeach
                                    @else
                                    @foreach ($currency_types as $key => $currency_type)
                                    @if (in_array($currency_type->code, $selected_currency_ids))
                                    <th class="bg_n_fontcolor">{{ $currency_type->code}}</th>
                                    <?php 
                                                    $currency_amounts[$key] = 0; 
                                                    $col_count++;
                                            ?>
                                    @endif
                                    @endforeach
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($objs) && count($objs)>0)

                                    <?php 
                                    $counter = 1;
                                    $total = 0;
                                    ?>

                                    @if($selected_currency_ids == null )
                                        @foreach($objs as $key => $obj)


                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>  {{$obj->name}}</td>
                                            <td>{{ $expense_types[$obj->expense_type_id]->name }}</td>
                                            <td>{{$obj->date}}</td>

                                            @foreach ($currency_types as $key2 => $currency_type2)
                                            <td>
                                                @if($obj->currency_id == $currency_type2->code)
                                                {{$obj->amount}}</a>
                                                <?php $currency_amounts[$key2] = $currency_amounts[$key2] + $obj->amount; ?>
                                                @endif
                                            </td>
                                            @endforeach

                                        </tr>
                                        
                                        <?php 
                                        $counter++; 
                                        $total = $total + $obj->amount; 
                                        ?>

                                        @endforeach

                                    @else

                                        @foreach($objs as $key => $obj)
                                            @if (in_array($obj->currency_id, $selected_currency_ids))
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>  {{$obj->name}}</a></td>
                                                <td>{{ $expense_types[$obj->expense_type_id]->name }}</td>
                                                <td>{{$obj->date}}</td>

                                                @foreach ($currency_types as $key2 => $currency_type2)
                                                    @if (in_array($currency_type2->code, $selected_currency_ids))
                                                        <td class="text-right">
                                                            @if($obj->currency_id == $currency_type2->code)
                                                                {{$obj->amount}}
                                                                <?php $currency_amounts[$key2] = $currency_amounts[$key2] + $obj->amount; ?>
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach

                                            </tr>

                                            <?php 
                                                $counter++; 
                                                $total = $total + $obj->amount; 
                                            ?>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- for grand total - start --}}
                                    <tr>
                                        <td colspan="4" class="td_total"><b>Grand Total</b></td>

                                        @if($selected_currency_ids == null )
                                            @foreach ($currency_types as $key3 => $currency_type3)
                                            <td class="td_total">
                                                {{ $currency_type3->code }}
                                                <?php echo number_format( (float) $currency_amounts[$key3], 2, '.', ''); ?>
                                            </td>
                                            @endforeach
                                        @else
                                            @foreach ($currency_types as $key3 => $currency_type3)
                                                @if (in_array($currency_type3->code, $selected_currency_ids))
                                                <td class="td_total">
                                                    {{ $currency_type3->code }}
                                                    <?php echo number_format( (float) $currency_amounts[$key3], 2, '.', ''); ?>
                                                </td>
                                                @endif
                                            @endforeach
                                        @endif

                                    </tr>
                                    {{-- for grand total - end --}}
                                @else

                                    <td colspan="{{$col_count}}" class="text-center">
                                        <b>There is no records about your searching filters !!! </b>
                                    </td>

                                @endif

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

</body>
</body>

</html>


<style>
    #table_responsive {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table_responsive td,
    #table_responsive th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #table_responsive tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table_responsive tr td {
        font-size: 12px;
    }

    #table_responsive tr:hover {
        background-color: #ddd;
    }

    #table_responsive th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
    }

    .text-right {
        text-align: right;
    }

    .font_size_10 {
        font-size: 10px;
    }

    .td_total {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: right;
        font-weight: bold;
        background-color: #4CAF50;
        color: white;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        color: #4F5467;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e9ecef;
        border-radius: 2px;
        -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
</style>
</style>
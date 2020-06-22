<table>

    <tr></tr>

    <tr>
        <td colspan="6" style="background-color: #4CAF50;color: #FFFFFF;"><b>Expense Summary Report</b></td>
    </tr>

    <tr>
        <td colspan="3">Generated at </td>
        <td colspan="3">{{ date('D-M-Y H:i:s') }}</td>
    </tr>
    
    <tr></tr>

    <tr>
        <td colspan="3" style="background-color: #4CAF50;color: #FFFFFF;">From Date</td>
        <td colspan="3" style="background-color: #4CAF50;color: #FFFFFF;">To Date</td>
    </tr>

    <tr>
        <td colspan="3"></td>
        <td colspan="3">{{$to_date}}</td>
    </tr>

    <tr></tr>

    <tr>
        <td colspan="3" style="background-color: #4CAF50;color: #FFFFFF;">Expense Type</td>
        <td colspan="3" style="background-color: #4CAF50;color: #FFFFFF;">Currency Type</td>
    </tr>

    <tr>
        <td colspan="3">
            @if($selected_expense_type_ids == null )
                All Expense Types
            @else
                @foreach($expense_types as $expense_type)
                    @if (in_array($expense_type->id, $selected_expense_type_ids))
                    {{$expense_type->name}} 
                    @endif
                @endforeach
            @endif
        </td>

        <td colspan="3">
            @if($selected_currency_ids == null )
                All Currency Types
            @else
                @foreach($currency_types as $currency_type)
                    @if (in_array($currency_type->code, $selected_currency_ids))
                        {{$currency_type->code}} - 
                    @endif
                @endforeach
            @endif

        </td>
    </tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <th style="background-color: #4CAF50;color: #FFFFFF;">No.</th>
        <th style="background-color: #4CAF50;color: #FFFFFF;">Name</th>
        <th style="background-color: #4CAF50;color: #FFFFFF;">Type</th>
        <th style="background-color: #4CAF50;color: #FFFFFF; width: 12px;">Date</th>

        <?php $col_count = 4; ?>

        <?php $currency_amounts = array(); ?>
        @if($selected_currency_ids == null )
            @foreach ($currency_types as $key => $currency_type)
                <th style="background-color: #4CAF50;color: #FFFFFF;width: 10px;">{{ $currency_type->code}}</th>
                <?php 
                    $currency_amounts[$key] = 0; 
                    $col_count++;
                ?>
            @endforeach
        @else
            @foreach ($currency_types as $key => $currency_type)
                @if (in_array($currency_type->code, $selected_currency_ids))
                    <th style="background-color: #4CAF50;color: #FFFFFF;width: 10px;">{{ $currency_type->code}}</th>
                    <?php 
                        $currency_amounts[$key] = 0; 
                        $col_count++;
                    ?>
                @endif
            @endforeach
        @endif

    </tr>

    @if(isset($objs) && count($objs)>0)

        <?php 
            $counter = 1;
            $total = 0;
        ?>

        @if($selected_currency_ids == null )
            @foreach($objs as $key => $obj)

                <tr>
                    <td>{{ $counter }}</td>
                    <td> {{$obj->name}}</td>
                    <td>{{ $expense_types[$obj->expense_type_id]->name }}</td>
                    <td>{{$obj->date}}</td>

                    @foreach ($currency_types as $key2 => $currency_type2)
                    <td>
                        @if($obj->currency_id == $currency_type2->code)
                        {{$obj->amount}}
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
                        <td> {{$obj->name}}</td>
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
            <td colspan="4" style="background-color: #4CAF50;color: #FFFFFF; text-align:right; vertical-align: middle;"><b>Grand Total</b></td>

            @if($selected_currency_ids == null )
                @foreach ($currency_types as $key3 => $currency_type3)
                <td style="background-color: #4CAF50;color: #FFFFFF;">
                    {{-- {{ $currency_type3->code }} --}}
                    <?php echo number_format( (float) $currency_amounts[$key3], 2, '.', ''); ?>
                </td>
                @endforeach
            @else

                @foreach ($currency_types as $key3 => $currency_type3)
                    @if (in_array($currency_type3->code, $selected_currency_ids))
                    <td style="background-color: #4CAF50;color: #FFFFFF;">
                        {{-- {{ $currency_type3->code }} --}}
                        <?php echo number_format( (float) $currency_amounts[$key3], 2, '.', ''); ?>
                    </td>
                    @endif
                @endforeach
            @endif

        </tr>
    
    {{-- for grand total - end --}}
    @else
        <tr>
            <td colspan="{{$col_count}}" class="text-center">
                <b>There is no records about your searching filters !!! </b>
            </td>
        </tr>
    @endif



</table>
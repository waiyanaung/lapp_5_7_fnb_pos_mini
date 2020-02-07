Dear Admin,
<br><br>
There is one new order and the following is detail info<br><br>

<table border="1">

    <tr>
        <td><b>Order ID</b></td>
        <td>{{ $order_obj['id'] }}</td>
    </tr>

    <tr>
        <td><b>Customer Name</b></td>
        <td>{{ $order_obj['name'] }}</td>
    </tr>

    <tr>
        <td><b>Customer Phone</b></td>
        <td>{{ $order_obj['phone'] }}</td>
    </tr>

    <tr>
        <td><b>Item Name</b></td>
        <td>{{ $item['name'] }}</td>
    </tr>

    <tr>
        <td><b>Item Quantity</b></td>
        <td>{{ $order_obj['total_item_qty'] }}</td>
    </tr>

    <tr>
        <td><b>With Installation</b></td>
        <td>
            <?php 
                if($order_obj['add_installation'] == 1){
                    echo 'Yes';
                }
                else{
                    echo 'No';
                }
            ?>
        </td>
    </tr>

    <tr>
        <td><b>Order at</b></td>
        <td>{{ $order_obj['created_at'] }}</td>
    </tr>

</table>
<br>
Have a nice day
<br><br>

Thanks and regards<br>
Digital Order System
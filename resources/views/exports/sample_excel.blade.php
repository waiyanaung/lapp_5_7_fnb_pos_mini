
<table id="table_responsive">
    <thead>
        <tr>
            <th  style="background-color: #4CAF50;color: #FFFFFF;">ID</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;width: 15px;">Name</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;">Description</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;">Status</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;width: 15px;">Create At</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;width: 15px;">Updated At</th>
            <th style="background-color: #4CAF50;color: #FFFFFF;width: 15px;">Deleted At</th>

        </tr>
    </thead>
    <tbody>
        @foreach($objs as $obj)
        <tr>
            <td>{{ $obj->id }}</td>
            <td>{{ $obj->name }}</td>
            <td>{{ $obj->description }}</td>
            <td>{{ $obj->status }}</td>
            <td>{{ $obj->created_at }}</td>
            <td>{{ $obj->updated_at }}</td>
            <td>{{ $obj->deleted_at }}</td>

        </tr>
        @endforeach


        <tr>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>
            <td style="background-color: #4CAF50;color: #FFFFFF;"></td>

        </tr>
    </tbody>
</table>
$(document).ready(function() {

    $('#list-table tfoot th.search-col').each( function () {
        var title = $('#list-table thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    var table = $('#list-table').DataTable({
        aLengthMenu: [
        [5,25, 50, 100, 200, -1],
        [5,25, 50, 100, 200, "All"]
        ],
        iDisplayLength: 5,
        "order": [[ 2, "desc" ]],
        stateSave: false,
        "pagingType": "full",
        "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

    });
    //  new $.fn.dataTable.FixedHeader( table, {

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
            .column( colIdx )
            .search( this.value )
            .draw();
        } );

    });
});

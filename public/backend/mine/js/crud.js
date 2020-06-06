function create_setup(type){
    window.location ='/backend_app/' + type + '/create';
}

function edit_setup(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);

    if (data[0] == null) {

        swal("Oops...", "Please select at least one item to edit !", "error");
    }
    else if (data[1] != null) {

        swal("Oops...", "Please select only one item to edit !", "error");
    }
    else {
        window.location ='/backend_app/' + type + "/edit/" + data;
    }
}

function edit_setup_v2(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);

    if (data[0] == null) {

        swal("Oops...", "Please select at least one item to edit !", "error");
    }
    else if (data[1] != null) {

        swal("Oops...", "Please select only one item to edit !", "error");
    }
    else {
        window.location ='/backend_app/' + type + "/" + data + "/edit/";
    }
}

function delete_setup(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);
    if (data[0] == null) {
        swal("Oops...", "Please select at least one item to delete !", "error");
    }
    //else if (data[1] != null) {
    //    sweetAlert("Oops...", "Please select only one item to delete !", "error");
    //
    //}
    else {
        swal({
                title: "Are you sure?",
                text: "To proceed the Deactivation .",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller

                    $("#selected_checkboxes").val(data);
                    $("#frm_" + type).submit();
                } else {
                    return;
                }
            });
    }
}

function delete_multiple_setup(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);
    if (data[0] == null) {
        swal("Oops...", "Please select at least one item to delete !", "error");
    }
    //else if (data[1] != null) {
    //    sweetAlert("Oops...", "Please select only one item to delete !", "error");
    //
    //}
    else {
        swal({
                title: "Are you sure?",
                text: "To proceed the delete process !!!!!!! .",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller

                    $("#selected_checkboxes").val(data);
                    $("#frm_" + type).submit();
                } else {
                    return;
                }
            });
    }
}

function activate_setup(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);
    if (data[0] == null) {
        swal("Oops...", "Please select at least one item to activate !", "error");
    }
    //else if (data[1] != null) {
    //    sweetAlert("Oops...", "Please select only one item to delete !", "error");
    //
    //}
    else {
        
        swal({
                title: "Are you sure?",
                text: "To proceed the Re-Activation .",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller
                    $("#frm_" + type).attr('action', type + "/enable");
                    $("#frm_" + type).attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_" + type).submit();
                } else {
                    return;
                }
            });
    }
}

function multiple_activate_setup(type) {
    var data = [];
    $("input[name='edit_check[]']:checked").each(function () {
        data.push($(this).val());
    });
    var d = typeof(data);
    if (data[0] == null) {
        swal("Oops...", "Please select at least one item to activate !", "error");
    }
    //else if (data[1] != null) {
    //    sweetAlert("Oops...", "Please select only one item to delete !", "error");
    //
    //}
    else {
        swal({
                title: "Are you sure?",
                text: "To proceed the Re-Activation .",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller
                    $("#frm_" + type).attr('action', type + "/multipleenable");
                    $("#frm_" + type).attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_" + type).submit();
                } else {
                    return;
                }
            });
    }
}

function cancel_setup(type) {
    window.location.href = '/backend_app/' + type;
}

$("#check_all").click(function(event){
    if(this.checked) {
        $('.check_source').each(function() { //loop through each checkbox
            this.checked = true;  //select all checkboxes with class "checkbox1"
        });
    }else{
        $('.check_source').each(function() { //loop through each checkbox
            this.checked = false; //deselect all checkboxes with class "checkbox1"
        });
    }
});

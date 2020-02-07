function filter_by_hotel_id(module) {
    var hotel_id = $("#hotel_id").val();

    var  form_action = "/"+module+"/"+hotel_id;
    window.location = form_action;
}

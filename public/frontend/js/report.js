function check_date(from_date, to_date){

    var dateFirst = from_date.split('-');
    var dateSecond = to_date.split('-');
    var dateFistTemp = new Date(dateFirst[2], dateFirst[1], dateFirst[0]); //Year, Month, Date
    var dateSecondTemp = new Date(dateSecond[2], dateSecond[1], dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function check_month(from_month, to_month){
    var dateFirst = from_month.split('-');
    var dateSecond = to_month.split('-');
    var dateFistTemp = new Date(dateFirst[1], dateFirst[0]); //Year, Month
    var dateSecondTemp = new Date(dateSecond[1], dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function check_year(from_year, to_year){

    var dateFirst = from_year.split('-');
    var dateSecond = to_year.split('-');
    var dateFistTemp = new Date(dateFirst[0]); //Year
    var dateSecondTemp = new Date(dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function report_search_with_type(module){
    var type        = $("#type").val();
    var status      = $('#status').val();
    var form_action = "";

    if(type == "yearly"){           //type is yearly
        var from_year = $("#from_year").val();
        var to_year = $("#to_year").val();

        if(from_year == "" && to_year == ""){
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year == "" && to_year != "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year != "" && to_year == "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else{
            var dateComparison = check_year(from_year, to_year);

            if(dateComparison){
                form_action = "/cl/"+module+"/search/" + type + "/" + from_year + "/" + to_year;

                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid year !");
                return;
            }
        }
    }
    else if(type == "monthly"){         //type is monthly
        var from_month = $("#from_month").val();
        var to_month = $("#to_month").val();

        if(from_month == "" && to_month == ""){
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month == "" && to_month != "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month != "" && to_month == "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else{
            var dateComparison = check_month(from_month, to_month);

            if(dateComparison){
                form_action = "/cl/"+module+"/search/" + type + "/" + from_month + "/" + to_month;

                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid month !");
                return;
            }
        }
    }
    else{       //type is daily
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        if(from_date == "" && to_date == ""){
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date == "" && to_date != "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date != "" && to_date == "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else{

            var dateComparison = check_date(from_date, to_date);

            if(dateComparison){
                form_action = "/cl/"+module+"/search/" + type + "/" + from_date + "/" + to_date;

                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid date !");
                return;
            }
        }
    }

    window.location = form_action;
}

function report_export_with_type(module){
    var type        = $("#type").val();
    var status      = $('#status').val();
    var form_action = "";
    if(type == "yearly"){           //type is yearly
        var from_year = $("#from_year").val();
        var to_year = $("#to_year").val();

        if(from_year == "" && to_year == ""){
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year == "" && to_year != "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year != "" && to_year == "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else{
            var dateComparison = check_year(from_year, to_year);

            if(dateComparison){
                form_action = "/cl/"+module+"/exportexcel/" + type + "/" + from_year + "/" + to_year;
                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid year !");
                return;
            }
        }
    }
    else if(type == "monthly"){         //type is monthly
        var from_month = $("#from_month").val();
        var to_month = $("#to_month").val();

        if(from_month == "" && to_month == ""){
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month == "" && to_month != "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month != "" && to_month == "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else{
            var dateComparison = check_month(from_month, to_month);

            if(dateComparison){
                form_action = "/cl/"+module+"/exportexcel/" + type + "/" + from_month + "/" + to_month;
                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid month !");
                return;
            }
        }
    }
    else{       //type is daily
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        if(from_date == "" && to_date == ""){
            var form_action = "/cl/"+module+"/exportexcel";
        }
        else if(from_date == "" && to_date != "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date != "" && to_date == "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else{
            var dateComparison = check_date(from_date, to_date);

            if(dateComparison){
                form_action = "/cl/"+module+"/exportexcel/" + type + "/" + from_date + "/" + to_date;
                if(status != undefined){
                    form_action += "/"+status;
                }
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid date !");
                return;
            }
        }
    }

    window.location = form_action;
}

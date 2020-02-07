<div class="row rounded_div_with_shadow7"> <!-- /. start 3rd row -->
    <div class="col-md-12">
        <span>Checking Air Con Horse Power with Formula</span>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-4">
        Length : <br>
        <input type="number" min="1"  class="form-control" name="length" id="length" value="" placeholder="10">
    </div>

    <div class="col-md-4">
        Width : <br>
        <input type="number" min="1"  class="form-control" name="breadth" id="breadth"  value="" placeholder="10">
    </div>

    <div class="col-md-4">
        Height : <br>
        <input type="number" min="1"  class="form-control" name="height" id="height"  value="" placeholder="10">
    </div>

    <div class="col-md-4">
        No. of people : <br>
        <input type="number" min="1"  class="form-control" name="number_of_people" id="number_of_people"  value="" placeholder="1">
    </div>

    <div class="col-md-4">
        Room Type : <br>
        <select name="room_type" id="room_type" class="form-control">
            <option value="7">Bed Room</option>
            <option value="8">Living Room / Meeting Room</option>
            <option value="9">Resturant / Show-room</option>
        </select>
    </div>

    <div class="col-md-4">
        <br>
        <button  onclick="checkHP()" type="button" class="btn link_button4 form-control">Check</button>
    </div>

    <div class="col-md-8 col-sm-4">
        Result : <br>
        <input type="text" readonly class="form-control" name="check_result" id="check_result"  placeholder="Your result will be here ">
    </div>

    <div class="col-md-4 col-sm-8">
        <br>
        <form method="POST" action="/item">
        <input type="submit" class="btn link_button4 form-control" value="View checked items">
        <input type="hidden" id="item_horse_power_id" name="item_horse_power_id" value="0">
        @csrf
        </form>
    </div>


</div><!-- /. start 3rd row -->

<script>

    // function checkHP() {
    //     var length = $('#length').val();
    //     var breadth = $('#breadth').val();
    //     var height = $('#height').val();
    //     var result = length * breadth * height;
    //     var show_result = "";

    //     if(result >=1 && result <= 800){
    //         show_result = "0.75 HP";
    //     }
    //     else if(result >= 801 && result <= 1080){
    //         show_result = "1.00 HP";
    //     }
    //     else if(result >= 1081 && result <= 1620){
    //         show_result = "1.50 HP";
    //     }
    //     else if(result >= 1621 && result <= 2160){
    //         show_result = "2.00 HP";
    //     }
    //     else if(result >= 2161  && result <= 2700){
    //         show_result = "2.50 HP";
    //     }
    //     else if(result >= 2700  && result <= 3239){
    //         show_result = "3.00 HP";
    //     }
    //     else if(result >= 3240  && result <= 3780){
    //         show_result = "3.50 HP";
    //     }
    //     else if(result >= 3781  && result <= 4320){
    //         show_result = "4.00 HP";
    //     }
    //     else if(result >= 4321  && result <= 5400){
    //         show_result = "5.00 HP";
    //     }
    //     else if(result >= 5401){
    //         show_result = "Over 5.00 HP";
    //     }
    //     else{
    //         show_result = "Plese check your inputs ( length, Breadth and Height ).";
    //     }

    //     $('#check_result').val(show_result);
    // }

    function checkHP() {
        var length = $('#length').val();
        var breadth = $('#breadth').val();
        var height = $('#height').val();
        var result = length * breadth * height;
        var show_result = "";
        var breadth = $('#breadth').val();
        var room_type = $("#room_type").val();
        var number_of_ppl = $("#number_of_people").val();
        var number_of_people = 600 * number_of_ppl;

        var temp_result = length * breadth * height * room_type;
        var result = temp_result + number_of_people;

        var horse_power_value = 0;

        if(result >=1 && result <= 7500){
            show_result = "0.75 HP";
            horse_power_value = 1;
        }
        else if(result >= 7501 && result <= 9000){
            show_result = "1.00 HP";
            horse_power_value = 2;
        }
        else if(result >= 9001 && result <= 12000){
            show_result = "1.50 HP";
            horse_power_value = 3;
        }
        else if(result >= 12001 && result <= 18000){
            show_result = "2.00 HP";
            horse_power_value = 5;
        }
        else if(result >= 18001  && result <= 21000){
            show_result = "2.50 HP";
            horse_power_value = 6;
        }
        else if(result >= 21001  && result <= 24000){
            show_result = "3.00 HP";
            horse_power_value = 7;
        }
        else if(result >= 24001  && result <= 27000){
            show_result = "3.50 HP";
            horse_power_value = 8;
        }
        else if(result >= 27001  && result <= 29000){
            show_result = "4.00 HP";
            horse_power_value = 9;
        }
        else if(result >= 29001  && result <= 36000){
            show_result = "5.00 HP";
            horse_power_value = 10;
        }
        else if(result >= 36001){
            show_result = "Over 5.00 HP";
            horse_power_value = 11;
        }
        else{
            show_result = "Plese check your inputs ( length, Breadth and Height ).";
        }
        
        $('#item_horse_power_id').val(horse_power_value);
        $('#check_result').val(show_result);
    }
</script>
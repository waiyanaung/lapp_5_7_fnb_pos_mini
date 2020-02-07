$(document).ready(function() {
    //Country
    $('#country').validate({
        rules: {
            countries_name  : {
                required	: true,
                //remote		: {
                //    url: "/cl/country/check_country_name",
                //    type: "get",
                //    data:
                //    {
                //        countries_name: function()
                //        {
                //            return $('#countries_name').val();
                //        }
                //    }
                //}
            }
        },
        messages: {
            countries_name: {
                required	: 'Country Name is required',
                //remote		: jQuery.validator.format("{0} is already taken.")
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            form.submit();
        }
    });

    //City
    $('#city').validate({
        rules: {
            country_id      : 'required',
            city_name  : {
                required	: true,
                remote		: {
                    url: "/cl/city/check_city_name",
                    type: "get",
                    data: {
                        city_name: function () {
                            return $('#city_name').val();
                        },
                        country_id : function()
                        {
                            return $('#country_id').val();
                        }
                    }
                }
            }
        },
        messages: {
            country_id    :{
                required  : 'Country is required',
            },
            countries_name: {
                required	: 'City Name is required',
                remote		: jQuery.validator.format("{0} is already taken.")
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            //alert('hi');
            form.submit();
        }
    });

    //Township
    $('#township').validate({
        rules: {
            city_id        : 'required',
            township_name  : 'required',
        },
        messages: {
            city_id        :{
                required   : 'City is required',
            },
            township_name  : {
                required   : 'Township Name is required',
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            //alert('hi');
            form.submit();
        }
    });

    //Feature
    $('#feature').validate({
        rules: {
            feature_name  : 'required',
            feature_icon  : 'required',
        },
        messages: {
            feature_name  : {
                required  : 'Feature Name is required',
            },
            feature_icon  : {
                required  :'Feature Icon is required',
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            //alert('hi');
            form.submit();
        }
    });

    //HotelRestaurantCategory
    $('#hotel_restaurant_category').validate({
        rules: {
            hotel_restaurant_category  : 'required'
        },
        messages: {
            hotel_restaurant_category  : {
                required  : 'Hotel Restaurant Category is required',
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            //alert('hi');
            form.submit();
        }
    });

    //Amenities
    $('#amenities').validate({
        rules: {
            amenities_name  : 'required',
            amenities_icon  : 'required'
        },
        messages: {
            amenities_name  : {
                required     : 'Amenities name is required',
            },
            amenities_icon  :{
                required     : 'Amenities Icon is required',
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            form.submit();
        }
    });

    //Facilities
    $('#facilities').validate({
        rules: {
            facilities_name  : 'required',
            facilities_icon  : 'required'
        },
        messages: {
            facilities_name  : {
                required     : 'Facilities name is required',
            },
            facilities_icon  :{
                required     : 'Facilities Icon is required',
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').attr('disabled','disabled');
            //alert('hi');
            form.submit();
        }
    });

});


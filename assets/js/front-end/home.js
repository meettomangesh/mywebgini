siteObjJs.frontend.homeJs = function () {

    $('body').on("click", ".btn-expand-form", function () {
        if ($('#tab1').hasClass('active')) {
            $('#gmap_geocoding').show();
            mapGeocoding('add');
        }
    });
    $('.togglelable').click(function (e) {
        //if($('#tab1'))
        if ($('#tab1').hasClass('active')) {
            $('#gmap_geocoding').show();
            mapGeocoding('add');
        }
    });

    var initializeListener = function () {

        console.log('home js is initialised');
        /*$('#gmap_geocoding').show();
         
         
         /*        var formId = $('#cat_id').closest('form').attr('id');
         
         $('#' + formId).on('change', '#country_id', function (e) {
         if ($(this).val() != 0)
         {
         $("#state_id").select2("val", '');
         fetchStateList(this);
         $("#city_id").select2("val", '');
         }
         if ($(this).val() == '')
         {
         $("#state_id").select2("val", '');
         $("#city_id").select2("val", '');
         }
         
         });
         
         $('#' + formId).on('change', '#state_id', function (e) {
         
         if ($(this).val() != 0)
         {
         $("#city_id").select2("val", '');
         fetchCityList(this);
         }
         if ($(this).val() == '')
         {
         $("#city_id").select2("val", '');
         }
         
         });
         */

    };

    var fetchStateList = function (elet, content) {
        content = content || '';
        var currentForm = $(elet).closest("form");
        var countryID = $(elet).val();

        var actionUrl = adminUrl + '/merchant/stateData/' + countryID;
        $.ajax({
            url: actionUrl,
            cache: false,
            type: "GET",
            processData: false,
            contentType: false,
            success: function (data)
            {
                var $el = $("#state_id");
                $el.empty(); // remove old options

                $el.append($("<option></option>").attr("value", '').text('Select State'));
                $.each(data, function (value, key) {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            },
            error: function (jqXhr, json, errorThrown)
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                $.each(errors, function (key, value) {
                    errorsHtml += value[0] + '<br />';
                });
                // alert(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                Metronic.alert({
                    type: 'danger',
                    message: errorsHtml,
                    container: $('#ajax-response-text'),
                    place: 'prepend',
                    //closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
                });
            }
        });
    };

    var fetchCityList = function (elet, content) {
        content = content || '';
        var currentForm = $(elet).closest("form");
        var stateID = $(elet).val();

        var actionUrl = adminUrl + '/merchant/cityData/' + stateID;
        $.ajax({
            url: actionUrl,
            cache: false,
            type: "GET",
            processData: false,
            contentType: false,
            success: function (data)
            {
                var $el = $("#city_id");
                $el.empty(); // remove old options

                $el.append($("<option></option>").attr("value", '').text('Select City'));
                $.each(data, function (value, key) {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            },
            error: function (jqXhr, json, errorThrown)
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                $.each(errors, function (key, value) {
                    errorsHtml += value[0] + '<br />';
                });
                // alert(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                Metronic.alert({
                    type: 'danger',
                    message: errorsHtml,
                    container: $('#ajax-response-text'),
                    place: 'prepend',
                    //closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
                });
            }
        });
    };

    // Common method to handle add and edit ajax request and reponse

    var handleAjaxRequest = function () {
        var formElement = $(this.currentForm); // Retrive form from DOM and convert it to jquery object
        var actionUrl = formElement.attr("action");
        var actionType = formElement.attr("method");
        var formData = formElement.serialize();
        var icon = "check";
        var messageType = "success";
        $.ajax(
                {
                    url: actionUrl,
                    cache: false,
                    type: actionType,
                    data: formData,
                    success: function (data)
                    {
                        //console.log(data);
                        //data: return data from server
                        if (data.status === "error")
                        {
                            icon = "times";
                            messageType = "danger";
                        }

                        //Empty the form fields
                        formElement.find("input[type=text], textarea").val("");
                        $("#country_id").select2('val', '');
                        $("#states_id").select2('val', '');

                        //trigger cancel button click event to collapse form and show title of add page
                        $('.btn-collapse').trigger('click');

                        //reload the data in the datatable
                        grid.getDataTable().ajax.reload();

                        Metronic.alert({
                            type: messageType,
                            icon: icon,
                            message: data.message,
                            container: $('#ajax-response-text'),
                            place: 'prepend',
                            closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
                        });
                        $('#gmap_geocoding').hide();
                    },
                    error: function (jqXhr, json, errorThrown)
                    {
                        var errors = jqXhr.responseJSON;
                        var errorsHtml = '';
                        $.each(errors, function (key, value) {
                            errorsHtml += value[0] + '<br />';
                        });
                        // alert(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                        Metronic.alert({
                            type: 'danger',
                            message: errorsHtml,
                            container: $('#ajax-response-text'),
                            place: 'prepend',
                            closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
                        });
                    }
                }
        );
    };

    var markers = [];
    var mapGeocoding = function (type) {
        var lati, longi;

        if (type == 'add') {
            lati = '18.5204303';
            longi = '73.85674369999992';
        } else {
            lati = $('#registration_form').find('input[id="latitude_number"]').val();
            longi = $('#registration_form').find('input[id="longitude_number"]').val();

        }
//12.9715987===77.59456269999998

     /*   var map = new GMaps({
            div: '#gmap_geocoding',
            lat: lati,
            lng: longi,
            height: '275px',
            width: '100%',
        });
        map.setCenter(lati, longi);
        var marker = map.addMarker({
            lat: lati,
            lng: longi,
            draggable: true,

        });*/

        submit_search_form = function () {
            
        var data = $('.chips-autocomplete').material_chip('data');
        var str = '';
        for (var i = 0; i < Object.size(data); i++) {
            if (i == 0) {
                str += data[i].tag;
            } else {
                str += "," + data[i].tag;
            }
        }
        setCookie('searchSkill',str,1);
        $("#skills").val(str);
        $("#search_form").submit();
    
            /*
            var destinationInp = $("#destination-input").val();
            if (destinationInp.length == 0 || destinationInp == translationJS['ENTER_CITY_AIRPORT'] || destinationInp == $("#destination-input").attr('placeholder')) {
                alert(translationJS['EMPTY_DESTINATION_ERROR']);
                if (isDevice == 'mobile' || isDevice == 'tablet') {
                    $('html, body').animate({
                        'scrollTop': 0
                    }, 'fast', '', function () {
                        $('html, body').animate({
                            'scrollTop': $('#destination-input').position().top + 140
                        });
                    });
                }
                $("#destination-input").focus();
                return false
            }
            var checkintxt = $('#date-checkin').val();
            var checkouttxt = $('#date-checkout').val();
            var n = "";
            if ($("#autosuggest-hotel-id").val().length > 0 && $("#autosuggest-original-text").val() == $("#destination-input").val()) {
                n = "/hotels/show/" + String($("#autosuggest-hotel-id").val()) + "/?"
            } else {
                n = "/search/";
                n += "?destination=" + escape($("#destination-input").val());
            }
            if ($("#autosuggest-latitude").val().length > 0 && $("#autosuggest-longitude").val().length > 0 && (($("#autosuggest-original-text").val() == '' && $("#autosuggest-original-text").val() != $("#destination-input").val()) || $("#autosuggest-original-text").val() == $("#destination-input").val())) {
                n += "&latitude=" + escape($("#autosuggest-latitude").val());
                n += "&longitude=" + escape($("#autosuggest-longitude").val());
            }
            if ($("#autosuggest-landmark-id").val().length > 0 && $("#autosuggest-original-text").val() == $("#destination-input,#results-destination-input,#destination-specials").val()) {
                n += "&sort=distance&nearby-landmarks=" + escape($("#autosuggest-landmark-id").val())
            }
            if ($("#autosuggest-address").val().length > 0 && $("#autosuggest-address").val() == "1") {
                n += "&address_search=1";
            }
            var checkindate, checkoutdate;
            checkindate = escape($("#date-checkin").val());
            checkoutdate = escape($("#date-checkout").val());
            n += "&check-in=" + checkindate;
            n += "&check-out=" + checkoutdate;
            n += "&random=" + (100000 + Math.floor(Math.random() * 899999));
            W(n);
        */}

        //$('#registration_form').find('input[id="latitude_number"]').val(lati);
        //$('#registration_form').find('input[id="longitude_number"]').val(longi);
        var handleAction = function (handle_type) {
            //var text = $.trim($('#location').val());
            //obj.length && obj.length
            var text;
            console.log('I am on line 230', handle_type);

            if (type == 'add') {

                var countryName = $("#country_name option:selected").text();
                if (countryName != 'Select Country') {
                    countryName = $("#country_name option:selected").text();
                } else {
                    countryName = '';
                }

                var stateName = $("#state_name option:selected").text();
                if (stateName != 'Select State') {
                    stateName = $("#state_name option:selected").text();
                } else {
                    stateName = '';
                }

                var cityName = $("#city_name option:selected").text();
                if (cityName != 'Select City') {
                    cityName = $("#city_name option:selected").text();
                } else {
                    cityName = '';
                }

                text = $('#registration_form').find('input[name="address_line1"]').val() + ' ' + $('#registration_form').find('input[name="address_line2"]').val() + ' ' + countryName + ' ' + stateName + ' ' + cityName;
                //console.log(text);
            } else {

                var countryName = $('#registration_form').find("#country_name option:selected").text();

                if (countryName != 'Select Country') {
                    countryName = $('#registration_form').find("#country_name option:selected").text();
                } else {
                    countryName = '';
                }

                var stateName = $('#registration_form').find("#state_name option:selected").text();
                if (stateName != 'Select State') {
                    stateName = $('#registration_form').find("#state_name option:selected").text();
                } else {
                    stateName = '';
                }

                var cityName = $('#registration_form').find("#city_name option:selected").text();
                if (cityName != 'Select City') {
                    cityName = $('#registration_form').find("#city_name option:selected").text();
                } else {
                    cityName = '';
                }

                text = $('#registration_form').find('input[name="address_line1"]').val() + ' ' + $('#registration_form').find('input[name="address_line2"]').val() + ' ' + countryName + ' ' + stateName + ' ' + cityName;

            }
            var infoAddress = text;//text + ', ' + $("#city_id option:selected").text() + ',<br /> ' + $("#state_id option:selected").text() + ', ' + $("#country_id option:selected").text();

            GMaps.geocode({
                address: text,
                callback: function (results, status) {
                    if (status == 'OK') {
                        //console.log('Gmap->'+text);
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
                        if (type == 'add') {
                            $('#registration_form').find('input[id="latitude_number"]').val(latlng.lat());
                            $('#registration_form').find('input[id="longitude_number"]').val(latlng.lng());
                        } else {
                            if (handle_type == 2) {

                                $('#registration_form').find('input[id="latitude_number"]').val(lati);
                                $('#registration_form').find('input[name="longitude"]').val(longi);
                                //console.log(lati+'==='+longi);
                            } else if (handle_type == 3) {
                                //console.log(3);
                                $('#registration_form').find('input[id="latitude_number"]').val(latlng.lat());
                                $('#registration_form').find('input[name="longitude"]').val(latlng.lng());
                            }
                        }
                        DeleteMarkers();
                        var marker = map.addMarker({
                            lat: latlng.lat(),
                            lng: latlng.lng(),
                            draggable: true,
                            //title: 'Marker with InfoWindow',
//                            infoWindow: {
//                                content: '<span style="color:#000; text-transform:capitalize;">'+infoAddress+'</span>'
//                            }
                        });

                        marker.addListener('dragend', function (event) {
                            if (type == 'add') {
                                $('#registration_form').find('input[id="latitude_number"]').val(event.latLng.lat());
                                $('#registration_form').find('input[id="longitude_number"]').val(event.latLng.lng());
                            } else {
                                $('#registration_form').find('input[id="latitude_number"]').val(event.latLng.lat());
                                $('#registration_form').find('input[name="longitude"]').val(event.latLng.lng());
                            }

                        });

                        markers.push(marker);
                    }
                }
            });

        }
        if (type == 'edit') {
            handleAction(2);
        }

        //$($('#edit-merchant').find('input[name="address_1"]')).blur(function (e) {
        $($('#registration_form').find('input.gmap-blur')).blur(function (e) {
            /*if ($.trim($('#create-merchant').find('#map_edit_mode').val()).length > 0) {
             e.preventDefault();
             handleAction(3);
             } else {*/
            e.preventDefault();
            handleAction(1);
            // }
        });

        $($('#registration_form').find('select.gmap-blur')).change(function (e) {
            /*if ($.trim($('#create-merchant').find('#map_edit_mode').val()).length > 0) {
             e.preventDefault();
             handleAction(3);
             } else {*/
            e.preventDefault();
            handleAction(1);
            // }
        });

//        //$($('#edit-merchant').find('input[name="address_1"]')).blur(function (e) {
//        $($('#create-merchant').find('input.gmap-blur')).blur(function (e) {
//            if ($.trim($('#create-merchant').find('#map_edit_mode').val()).length > 0) {
//                e.preventDefault();
//                handleAction(3);
//            } else {
//                e.preventDefault();
//                handleAction(1);
//            }
//        });
//
//        $($('#create-merchant').find('select.gmap-blur')).blur(function (e) {
//            if ($.trim($('#create-merchant').find('#map_edit_mode').val()).length > 0) {
//                e.preventDefault();
//                handleAction(3);
//            } else {
//                e.preventDefault();
//                handleAction(1);
//            }
//        });


    };

    function GetAddress(type) {

        var latitude, longitude;
        if (type == 'add') {
            latitude = $('#registration_form').find('input[id="latitude_number"]').val();
            longitude = $('#registration_form').find('input[id="longitude_number"]').val();
        } else {

            latitude = $('#registration_form').find('input[id="latitude_number"]').val();
            longitude = $('#registration_form').find('input[name="longitude"]').val();
        }
        var lat = parseFloat(latitude);
        var lng = parseFloat(longitude);

        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': latlng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    console.log("Location: " + results[1].formatted_address);
                }
            }
        });
    }

    function DeleteMarkers() {

        //Loop through all the markers and remove
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }
    ;
//
//    var handleAutoComplete = function (formId) {
//        $("#" + formId + " #zip_code")
//                // don't navigate away from the field on tab when selecting an item
//                .on("keydown", function (event) {
//                    if (event.keyCode === $.ui.keyCode.TAB &&
//                            $(this).autocomplete("instance").menu.active) {
//                        event.preventDefault();
//                    }
//                })
//                .autocomplete({
//                    focus: function (event, ui) {
//                        $(".ui-helper-hidden-accessible").hide();
//                        event.preventDefault();
//                    },
//                    source: function (request, response) {
//                        var pincode = $("#" + formId + " #zip_code").val();
//                        if ($.isNumeric(pincode)) {
//                            var actionUrl = adminUrl + '/merchant/pincode/' + pincode;
//                            $.ajax({
//                                url: actionUrl,
//                                cache: false,
//                                dataType: "json",
//                                type: "GET",
//                                success: function (availablePincodeId)
//                                {
//                                    var availablePincodes = [];
//                                    $.each(availablePincodeId, function (key, value) {
//                                        availablePincodes.push({
//                                            id: key,
//                                            value: value
//                                        });
//                                    });
//                                    response(availablePincodes);
//                                    $("#" + formId + " #zip_code").attr('zipcode_id', 0);
//                                    if (pincode.length == 6 && availablePincodes.length > 0) {
//                                        $("#" + formId + " #zip_code").attr('zipcode_id', availablePincodes[0].id);
//                                    }
//                                },
//                                error: function (jqXhr, json, errorThrown)
//                                {
//                                    var errors = jqXhr.responseJSON;
//                                    var errorsHtml = '';
//                                    $.each(errors, function (key, value) {
//                                        errorsHtml += value[0] + '<br />';
//                                    });
//                                    console.log(errorsHtml);
//                                }
//                            });
//                        }
//                    },
//                    search: function () {
//                        // custom minLength
//                        var term = extractLast(this.value);
//                        if (term.length < 3) {
//                            return false;
//                        }
//                    },
//                    select: function (event, ui) {
//                        $(this).attr('zipcode_id', ui.item.id);
//                    }
//                });
//    };
//    var split = function (val) {
//        return val.split(/,\s*/);
//    };
//    var extractLast = function (term) {
//        return split(term).pop();
//    };
//
//  
    return {
        //main function to initiate the module
        //main function to initiate the module
        init: function () {
            initializeListener();
            mapGeocoding('add');
        },
        handleAction: function () {
            handleAction(1);
        }
    };
}();
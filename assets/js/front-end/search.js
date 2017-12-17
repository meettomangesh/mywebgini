siteObjJs.frontend.searchJs = function () {



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


    $('.chips').on('chip.add', function (e, chip) {
        getSetChipData(this);

    });

    $('.chips').on('chip.delete', function (e, chip) {
        getSetChipData(this);
    });

    function setFilterCriteria() {

    }
    $('.results-filter-provider-class').click(function (e) {
        if ($(this).is(':checked')) {
            console.log('checked', $(this).val());
            var indexArrLoc = filterProviderClass.indexOf($(this).val());
            console.log('I am on line 36' + indexArrLoc + '-' + $(this).val());
            if (indexArrLoc == -1) {
                filterProviderClass.push($(this).val());
            }
        } else {
            var indexArrLocRemove = filterProviderClass.indexOf($(this).val());
            if (indexArrLocRemove != -1) {
                filterProviderClass.splice(indexArrLocRemove, 1);
            }

        }
        setTimeout(function () {
            execute_filters(false);
        }, 2000)

    });

    var execute_filters = function (is_load_more) {
        var count_valid = 0;
        $('.result-provider').removeClass('valid').addClass('hide');
        $.each(provider_list, function (index, val) {
            var validClass = true;
            var validPrice = true;
            //console.log(val['provider_id']);
            console.log('in array', $.inArray(val['average_rating'], filterProviderClass));

            if (val['average_rating'] && $.inArray(val['average_rating'], filterProviderClass) != -1) {
                console.log('I am on line 70');
                $('#src_provider_id_' + val["provider_id"]).removeClass('hide').addClass('valid');
                validProviderIds.push(val["provider_id"]);
            } else {
                $('#src_provider_id_' + val["provider_id"]).removeClass('valid').addClass('hide');
                //validProviderIds.push(val["provider_id"]);
                var indexArrLocValid = validProviderIds.indexOf(val["provider_id"]);
                if (indexArrLocValid != -1) {
                    validProviderIds.splice(indexArrLocValid, 1);
                }
            }
            /*if (price_length && !(filter_price_arr[0] == min_max_price[0] && filter_price_arr[1] == min_max_price[1])) {
             var manupulatedPrice = val["lowrate"];
             var thousandSeperator = document.getElementById('thousands_separator').value;
             var decimalPoint = document.getElementById('decimal_point').value;
             var maxPriceRange = filter_price_arr[1];
             manupulatedPrice = manupulatedPrice.replace(thousandSeperator, '');
             if (decimalPoint != '.') {
             manupulatedPrice = manupulatedPrice.replace(decimalPoint, '.');
             }
             if (maxPriceRange == '500.00') {
             maxPriceRange = manupulatedPrice;
             }
             if (parseInt(manupulatedPrice) >= parseInt(filter_price_arr[0]) && parseInt(manupulatedPrice) <= parseInt(maxPriceRange)) {
             validPrice = true;
             } else {
             validPrice = false;
             }
             }*/
//            if (validClass && validPrice) {
//                count_valid++;
//
//                $('.src_provider_id_' + val["provider_id"]).addClass('valid');
//
//            }
        });
        if ($('#providerList div.valid').size() < 1) {
            if (!$('.no-providers-found').is(':visible')) {
                $('.no-providers-found').removeClass('hide');
                $('.no-providers-found').show();
            }
        } else {
            $('.no-providers-found').addClass('hide');
            $('.no-providers-found').hide();
        }

        if ($('.result-provider:visible').size() > 0) {
            $('.no-providers-found').addClass('hide');
            $('.no-providers-found').hide();
        }
    };

    var initializefeaturedData = function () {
        var featuredCompanyStr = '';
        var featuredfreelancerStr = '';
        $.each(provider_list, function (index, val) {
            if (val['is_company_individual'] == 1) {
                featuredfreelancerStr += '<div class="item dev-sbox">';
                featuredfreelancerStr += '<div class="dev-ipic"><img src="' + baseUrlImg + ((val['photo']) ? val['photo'] : 'no-pre.png') + '" alt=""></div>';
                featuredfreelancerStr += '<div class="dev-details">';
                featuredfreelancerStr += '<div class="dev-name t-up">' + val['company_name'] + '</div>';
                featuredfreelancerStr += '<div class="dev-des"></div>';
                featuredfreelancerStr += '</div>';
                featuredfreelancerStr += '</div>';
            } else {
                featuredCompanyStr += '<div class="item comp-sbox">';
                featuredCompanyStr += '<div class="comp-ipic"><img src="' + baseUrlImg + ((val['photo']) ? val['photo'] : 'no-pre.png') + '" alt=""></div>';
                featuredCompanyStr += '</div>';
            }

        });
        //$('#featured_companies').html(featuredCompanyStr);
        //$('#featured_freelancer').html(featuredfreelancerStr);
    };
    var InitializeSearchResult = function () {
        $('#search-loader,#search-loader-overlay').show();
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf('MSIE ');
        var mff = ua.indexOf('Firefox');
        if (mff > 0) {
            var cur = $(window).scrollTop();
            var loadI = setInterval(function () {
                cur += 0.2;
                $(window).scrollTop(cur + 0.2);
                $(window).scrollTop(cur - 0.2);
            }, 100);
        }

        var additional_params = '';
        var providerListUrl = baseUrl + "/search/providersList/";
//        var preSelectSkill = getParamFrmCookieGet('skills');
//        //console.log(preSelectSkill);
//        var arrSkill = preSelectSkill.split(",");
//        var finalObj = [];
//        for (i = 0; i < arrSkill.length; i++) {
//            finalObj.push({'tag': arrSkill[i]});
//        }
//        $('.search-chips').material_chip({
//            data: finalObj,
//        });


        /*additional_params += "?skills=" + getParamFrmCookieGet('skills');
         additional_params += "&country=" + ((getParamFrmCookieGet('country') == 'undefined') ? getParamFrmCookieGet('country') : '');
         additional_params += "&city=" + ((getParamFrmCookieGet('city') == 'undefined') ? getParamFrmCookieGet('city') : '');
         additional_params += "&state=" + ((getParamFrmCookieGet('state') == 'undefined') ? getParamFrmCookieGet('state') : '');
         additional_params += "&noofemp=" + ((getParamFrmCookieGet('noofemp') == 'undefined') ? getParamFrmCookieGet('noofemp') : '');
         additional_params += "&noofexp=" + ((getParamFrmCookieGet('noofexp') == 'undefined') ? getParamFrmCookieGet('noofexp') : '');
         additional_params += "&random=" + (100000 + Math.floor(Math.random() * 899999));
         
         console.log(additional_params);
         return false;
         
         additional_params += "&last_cnt=" + $('.result-provider').length;*/

        additional_params = {skills: getParamFrmCookieGet('skills'),
            country: ((getParamFrmCookieGet('country')) ? getParamFrmCookieGet('country') : ''),
            city: ((getParamFrmCookieGet('city')) ? getParamFrmCookieGet('city') : ''),
            state: ((getParamFrmCookieGet('state')) ? getParamFrmCookieGet('state') : ''),
            iscomind: ((getParamFrmCookieGet('iscomind')) ? getParamFrmCookieGet('iscomind') : ''),
            noofemp: ((getParamFrmCookieGet('noofemp')) ? getParamFrmCookieGet('noofemp') : ''),
            noofexp: ((getParamFrmCookieGet('noofexp')) ? getParamFrmCookieGet('noofexp') : ''),
            random: (100000 + Math.floor(Math.random() * 899999)),
            debug: ((getUrlParameter('debug')) ? getUrlParameter('debug') : '')

        };
        $.ajax({
            url: providerListUrl,
            type: 'POST',
            data: additional_params,
            async: true,
            success: function (data) {
                $('#search-loader,#search-overlay-loader').hide();
                if (mff > 0) {
                    clearInterval(loadI);
                }
                $('#providerList').html('<div class="no-providers-found hide" >No providers found.</div>' + data);
                draw_marker();
                initializefeaturedData();
                /*var has_more_results = $("#has_more_results").val();
                 if (has_more_results == 'true') {
                 setTimeout(loadMoreResults, 2000);
                 } else {
                 initialize_sort_feature();
                 }
                 paginate(1);*/

            }
        });
    };

    var initialize_sort_feature = function () {
        $("#select-sort, #select-sort.m").change(function () {
            $('#hotel-results').html('<br /><br /><div class="hotel-list-loader"><img id="bookloadBar" src="/application/themes/reservationcounter_v2/images/loading_circle.gif" width="102px" height="102px"/></div><br /><br />');
            var additional_params = '';
            additional_params = "&webpageObj=" + encodeURIComponent(webpageObj);
            if (from_s1 == "yes") {
                additional_params = "&from-s1=yes&webpageObj=" + encodeURIComponent(webpageObj);
                if (halosearch == 1) {
                    additional_params = additional_params + "&exclusive_page=yes";
                }
            }
            var ttl = parseInt($('.result-hotel').length);
            if ($('#exclusiveHotelCnt').length) {
                var ttl = (parseInt($('.result-hotel').length) + parseInt($('#exclusiveHotelCnt').val().trim()));
            }
            additional_params += '&last_cnt=' + ttl;
            $.ajax({
                url: "/ajax-content/sort-rates-v1/",
                async: false,
                data: "sort-option=" + $(this).val() + "&check-in-date=" + $("#date-checkin").val() + "&check-out-date=" + $("#date-checkout").val() + additional_params,
                type: 'POST',
                dataType: "html",
                success: function (data) {
                    $('#hotel-results').html(data);
                    default_setup_onajax();
                    if ($('#exclusiveHotelCnt').val() != '' && typeof $('#exclusiveHotelCnt').attr('id') != "undefined") {
                        var total = (parseInt($('.result-hotel.pure-g').length) + parseInt($('#exclusiveHotelCnt').val().trim()));
                        $('.tttl_hotels_found').html(total);
                    } else {
                        $('.tttl_hotels_found').html($('.result-hotel.pure-g').length);
                    }
                }
            });
        });
    }

    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;

    function initMap() {
        //var sydney = {lat: -33.863276, lng: 151.107977};
        var Lucknow = {lat: 24.8559743, lng: 77.9075698};
        map = new google.maps.Map(document.getElementById('map'), {
            center: Lucknow,
            zoom: 5,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
        });
        infoWindow = new google.maps.InfoWindow();
        // var json = JSON.parse(provider_list);


        //searchButton = document.getElementById("searchButton").onclick = searchLocations;

        //locationSelect = document.getElementById("locationSelect");
        /*locationSelect.onchange = function() {
         var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
         if (markerNum != "none"){
         google.maps.event.trigger(markers[markerNum], 'click');
         }
         };*/
    }

    function draw_marker() {
        infoWindow = new google.maps.InfoWindow();
        console.log(provider_list);
        for (var o in provider_list) {

            lat = provider_list[ o ].latitude;
            lng = provider_list[ o ].longitude;
            name = provider_list[ o ].company_name;
            for (var i = 1; i <= 5; i++) {
                name += "<span class='star" + ((i <= provider_list[ o ].average_rating) ? ' active' : '') + "'></span>";
            }

            console.log(name);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                name: name,
                map: map
            });
            google.maps.event.addListener(marker, 'click', function (e) {
                infoWindow.setContent(this.name);
                infoWindow.open(map, this);
            }.bind(marker));
        }
        google.maps.event.trigger(map, "resize");
        //if (typeof marker == !undefined)
        if (marker) {

            map.panTo(marker.getPosition());
        }
        map.setZoom(14);
    }
    function draw_provider_marker(provider_data) {
        var theDesktopMapResults = $('.map-results .results-hotels .results-hotel');
        if (hotel_data != null) {
            coordinates.providers = provider_data;
            if (coordinates.providers.length > 0) {
                add_hotel_marker = function (H) {
                    var provider_id = coordinates.providers[H]["provider_id"];
                    var name = coordinates.providers[H]["company_name"];
                    var location = coordinates.providers[H]["city_name"];

                    var blueIcon = provider_marker_blue;
                    var blueDotIcon = provider_marker_blue_dot;
                    var mapPoints = new google.maps.Point(23, 32);
                    if (isDevice == "mobile" || isDevice == "tablet") {
                        var blueIcon = new google.maps.MarkerImage(provider_marker_blue, null, null, null, new google.maps.Size(5, 5));
                        var blueDotIcon = new google.maps.MarkerImage(provider_marker_blue_dot, null, null, null, new google.maps.Size(-5, -5));
                        var mapPoints = new google.maps.Point(26, 27);
                    }
                    var blue_dot = false;
                    if (H % 4 == 0) {
                        var F = new MarkerWithLabel({
                            position: new google.maps.LatLng(coordinates.providers[H]["latitude"], coordinates.providers[H]["longitude"]),
                            map: map,
                            id: provider_id,
                            icon: blueIcon,
                            labelContent: name + '' + location,
                            labelClass: "map-marker-price",
                            labelAnchor: mapPoints,
                            draggable: false,
                            labelInBackground: true,
                            optimized: false,
                            zIndex: 107
                        });
                    } else {
                        blue_dot = true;
                        var F = new MarkerWithLabel({
                            position: new google.maps.LatLng(coordinates.providers[H]["latitude"], coordinates.providers[H]["longitude"]),
                            map: map,
                            id: provider_id,
                            icon: blueDotIcon,
                            optimized: false,
                            zIndex: 107
                        });
                    }
                    options = {
                        "disableAutoPan": true
                    };
                    var infowindow = new google.maps.InfoWindow(options);
                    var windowControl = new Array();
                    google.maps.event.addListener(F, 'mouseover', (function (F) {
                        return function () {
                            markers.providers[provider_id]['oldlabelContent'] = this.get("labelContent");
                            if (blue_dot == true) {
                                this.set("labelContent", price_display);
                                this.set("draggable", false);
                                this.set("labelInBackground", true);
                            }
                            markers.providers[provider_id]['oldicon'] = this.get("icon");
                            this.set("icon", provider_marker_red);
                            markers.providers[provider_id]['oldlabelAnchor'] = this.get("labelAnchor");
                            this.set("labelAnchor", new google.maps.Point(23, 38));
                            markers.providers[provider_id]['oldlabelClass'] = this.get("labelClass");
                            this.set("labelClass", "map-marker-price-red");
                            scrollto_hotel_id = this.get("id");
                            /*theDesktopMapResults.removeClass('item-inactive').removeClass('item-active');
                             theDesktopMapResults.addClass('item-inactive');
                             $('.map-container .item-active').removeClass('item-active').addClass('item-inactive');
                             $(".results-hotel-" + scrollto_hotel_id).removeClass('item-inactive');
                             $(".results-hotel-" + scrollto_hotel_id).addClass('item-active');
                             if (isDevice != "mobile") {
                             if ($('.map-container .map-results').hasClass('mCustomScrollbar')) {
                             $('.map-container .map-results').mCustomScrollbar("scrollTo", ".results-hotel-" + scrollto_hotel_id);
                             } else {
                             scrollCenter();
                             }
                             }*/
                        }
                    })(F));
                    google.maps.event.addListener(F, 'mouseout', (function (F) {
                        return function () {
                            windowControl[H] = false;
                            this.set("icon", markers.providers[provider_id]['oldicon']);
                            this.set("labelClass", markers.providers[provider_id]['oldlabelClass']);
                            this.set("labelAnchor", markers.providers[provider_id]['oldlabelAnchor']);
                            this.set("labelContent", markers.providers[provider_id]['oldlabelContent']);
                        }
                    })(F));
                    google.maps.event.addListener(F, 'click', function (F) {
                        scrollto_hotel_id = this.get("id");
                        theDesktopMapResults.removeClass('item-inactive').removeClass('item-active');
                        theDesktopMapResults.addClass('item-inactive');
                        $(".results-hotel-" + scrollto_hotel_id).removeClass('item-inactive');
                        $(".results-hotel-" + scrollto_hotel_id).addClass('item-active');
                        if (isDevice != "mobile") {
                            if ($('.map-container .map-results').hasClass('mCustomScrollbar')) {
                                $('.map-container .map-results').mCustomScrollbar("scrollTo", ".results-hotel-" + scrollto_hotel_id);
                            } else {
                                scrollCenter();
                            }
                        } else {
                            $("#results-hotels-mob-div .results-hotel").addClass("hidden");
                            $("#results-hotels-mob-div #hotel-img-" + scrollto_hotel_id).removeClass("hidden");
                            theMobileBottomControls.slideUp(500, function () {
                                $("#results-hotels-mob-div").slideDown('slow', function () {});
                            });
                            markers.hotels.forEach(function (markerHotel) {
                                var markerId = markerHotel['id'];
                                var labelClass = markers.hotels[markerId].get("labelClass");
                                if (markerId != hotelid && labelClass == "map-marker-price-red") {
                                    var LastMarkerIconObj = JSON.parse($("#hidLastMarkerIcon").val());
                                    var LastMarkerIconurl = LastMarkerIconObj.url;
                                    var LastMarkerIconheight = LastMarkerIconObj.size.height;
                                    var LastMarkerIconwidth = LastMarkerIconObj.size.width;
                                    var LastMarkerlabelContent = $("#hidLastMarkerlabelContent").val();
                                    var LastMarkerlabelContentX = LastMarkerIconObj.x;
                                    var LastMarkerlabelContentY = LastMarkerIconObj.y;
                                    var LastMarkerlabelAnchorObj = JSON.parse($("#hidLastMarkerlabelAnchor").val());
                                    var LastMarkerlabelClass = $("#hidLastMarkerlabelClass").val();
                                    if (isDevice == "mobile" || isDevice == "tablet") {
                                        var LastMarkerIcon = new google.maps.MarkerImage(LastMarkerIconurl, null, null, null, new google.maps.Size(LastMarkerIconwidth, LastMarkerIconheight));
                                    }
                                    markers.hotels[markerId].set("icon", LastMarkerIcon);
                                    markers.hotels[markerId].set("labelClass", LastMarkerlabelClass);
                                    markers.hotels[markerId].set("labelAnchor", new google.maps.Point(LastMarkerlabelContentX, LastMarkerlabelContentY));
                                    if (LastMarkerIconurl == "/application/themes/twig_theme/default/images/map/hotel-blue-dot.svg") {
                                        markers.hotels[markerId].set("labelContent", '');
                                    } else {
                                        markers.hotels[markerId].set("labelContent", LastMarkerlabelContent);
                                    }
                                }
                            });
                            markers.hotels[hotelid]['oldlabelContent'] = markers.hotels[hotelid].get("labelContent");
                            markers.hotels[hotelid].set("labelContent", price_display);
                            markers.hotels[hotelid].set("draggable", false);
                            markers.hotels[hotelid].set("labelInBackground", true);
                            markers.hotels[hotelid]['oldicon'] = markers.hotels[hotelid].get("icon");
                            $("#hidLastMarkerIcon").val(JSON.stringify(markers.hotels[hotelid].get("icon")));
                            $("#hidLastMarkerlabelContent").val(markers.hotels[hotelid]['labelContent']);
                            $("#hidLastMarkerlabelAnchor").val(JSON.stringify(markers.hotels[hotelid]['labelAnchor']));
                            $("#hidLastMarkerlabelClass").val(markers.hotels[hotelid]['labelClass']);
                            var hotel_marker_redIcon = hotel_marker_red;
                            if (isDevice == "mobile" || isDevice == "tablet") {
                                var hotel_marker_redIcon = new google.maps.MarkerImage(hotel_marker_red, null, null, null, new google.maps.Size(8, 8));
                            }
                            markers.hotels[hotelid].set("icon", hotel_marker_redIcon);
                            markers.hotels[hotelid]['oldlabelAnchor'] = markers.hotels[hotelid].get("labelAnchor");
                            markers.hotels[hotelid].set("labelAnchor", new google.maps.Point(26, 31));
                            markers.hotels[hotelid]['oldlabelClass'] = markers.hotels[hotelid].get("labelClass");
                            markers.hotels[hotelid].set("labelClass", "map-marker-price-red");
                        }
                    });
                    markers.hotels[hotelid] = F;
                    if (document.getElementById("hotel_ids").value.length > 0) {
                        document.getElementById("hotel_ids").value = document.getElementById("hotel_ids").value + ',' + hotelid;
                    } else {
                        document.getElementById("hotel_ids").value = hotelid;
                    }
                };
                for (var k = 0; k < coordinates.hotels.length; k++) {
                    add_hotel_marker(k);
                }
            } else {
                if (mapCustomChanges != 1) {
                    alert("No Hotels available around selected region.");
                }
            }
        } else {
            if (mapCustomChanges != 1) {
                alert("No Hotels available around selected region.");
            }
        }
        showMarkerIcons(markers, map);
    }


    var initializeListener = function () {

        console.log('search js is initialised');

        InitializeSearchResult();
        initMap();
        initSkillAutoComplete();
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
            //mapGeocoding('add');
        },
        handleAction: function () {
            handleAction(1);
        }
    };
}();
